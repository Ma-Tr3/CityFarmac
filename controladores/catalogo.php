<?php

require_once __DIR__ . '/../data/formulario.php';
require_once __DIR__ . '/../modelos/catalogo.php';

function listarCatalogo(string $entidad): array
{
    try {
        return match ($entidad) {
            'categorias' => categoriasCatalogo(),
            'marcas' => marcasCatalogo(),
            'productos' => productosCatalogo(),
            'comentarios' => comentariosCatalogo(),
        };
    } catch (PDOException $error) {
        error_log($error->getMessage());
        $GLOBALS['errorFormulario'] = 'No se pudo cargar el catálogo. Revisá la conexión a MySQL.';
        return [];
    }
}

function prepararFormularioCatalogo(string $entidad, bool $editar): array
{
    $categorias = $entidad !== 'marcas' ? listarCatalogo('categorias') : [];
    $marcas = $entidad !== 'categorias' ? listarCatalogo('marcas') : [];
    $registro = [];
    $id = null;

    if ($editar) {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1],
        ]);

        $registros = match ($entidad) {
            'categorias' => $categorias,
            'marcas' => $marcas,
            'productos' => listarCatalogo('productos'),
        };

        $registro = $id ? buscarPorId($registros, $id) : null;

        if ($registro === null) {
            http_response_code(isset($GLOBALS['errorFormulario']) ? 503 : 404);
            require __DIR__ . '/../error-404.php';
            exit;
        }
    } elseif ($entidad === 'categorias') {
        $registro['padre_id'] = filter_input(INPUT_GET, 'padre', FILTER_VALIDATE_INT);
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return [$registro, $categorias, $marcas];
    }

    $campos = match ($entidad) {
        'categorias' => ['nombre' => 'nombre', 'padre' => 'padre_id'],
        'marcas' => ['nombre' => 'nombre'],
        'productos' => [
            'nombre' => 'nombre',
            'descripcion' => 'descripcion',
            'precio' => 'precio',
            'modelo' => 'modelo',
            'categoria' => 'categoria_id',
            'subcategoria' => 'subcategoria_id',
            'marca' => 'marca_id',
        ],
    };

    foreach ($campos as $entrada => $campo) {
        $valor = $_POST[$entrada] ?? '';
        $registro[$campo] = is_string($valor) ? trim($valor) : '';
    }

    $registro['destacado'] = isset($_POST['destacado']) ? 1 : 0;
    $imagenNueva = null;
    $padre = null;

    try {
        validarToken();

        $nombre = textoCatalogo(
            $registro['nombre'],
            $entidad === 'productos' ? 180 : 120,
            'nombre'
        );

        if ($entidad === 'categorias') {
            if ($registro['padre_id'] !== '') {
                $padre = idCatalogo($registro['padre_id'], 'categoría padre');
                $categoriaPadre = buscarPorId($categorias, $padre);

                if (!$categoriaPadre || $categoriaPadre['padre_id'] !== null || $id === $padre) {
                    throw new DomainException('Elegí otra categoría principal como padre.');
                }

                foreach ($categorias as $categoria) {
                    if ($id !== null && (int) $categoria['padre_id'] === $id) {
                        throw new DomainException(
                            'Una categoría con subcategorías debe seguir siendo principal.'
                        );
                    }
                }
            }

            guardarCategoriaCatalogo($id, $nombre, $padre);
        } elseif ($entidad === 'marcas') {
            guardarMarcaCatalogo($id, $nombre);
        } else {
            $descripcion = textoCatalogo($registro['descripcion'], 2000, 'descripción');
            $modelo = textoCatalogo($registro['modelo'], 120, 'modelo');
            $precio = $registro['precio'];

            if (!preg_match('/^\d{1,10}(?:\.\d{1,2})?$/D', $precio) || (float) $precio <= 0) {
                throw new DomainException('Ingresá un precio mayor a cero con hasta dos decimales.');
            }

            $categoriaId = idCatalogo($registro['categoria_id'], 'categoría');
            $categoria = buscarPorId($categorias, $categoriaId);

            if (!$categoria || $categoria['padre_id'] !== null) {
                throw new DomainException('Seleccioná una categoría principal existente.');
            }

            if ($registro['subcategoria_id'] !== '') {
                $subcategoriaId = idCatalogo($registro['subcategoria_id'], 'subcategoría');
                $subcategoria = buscarPorId($categorias, $subcategoriaId);

                if (!$subcategoria || (int) $subcategoria['padre_id'] !== $categoriaId) {
                    throw new DomainException('La subcategoría debe pertenecer a la categoría elegida.');
                }

                $categoriaId = $subcategoriaId;
            }

            $marcaId = idCatalogo($registro['marca_id'], 'marca');

            if (!buscarPorId($marcas, $marcaId)) {
                throw new DomainException('Seleccioná una marca existente.');
            }

            $imagenNueva = subirImagenCatalogo();
            $imagen = $imagenNueva ?? $registro['imagen'] ?? null;

            if (!$imagen) {
                throw new DomainException('Seleccioná una imagen para el producto.');
            }

            guardarProductoCatalogo($id, [
                $nombre, $descripcion, $precio, $modelo, $categoriaId,
                $marcaId, $imagen, $registro['destacado'],
            ]);
        }

        $_SESSION['mensaje_exito'] = 'Registro guardado correctamente.';
        $destino = 'views/admin/panel-' . $entidad . '.php';

        if ($padre !== null) {
            $destino .= '?padre=' . $padre;
        }

        header('Location: ' . urlCityFarmac($destino), true, 303);
        exit;
    } catch (PDOException $error) {
        error_log($error->getMessage());

        $GLOBALS['errorFormulario'] = (int) ($error->errorInfo[1] ?? 0) === 1062
            ? 'Ese nombre ya está registrado.'
            : 'No se pudo guardar el registro. Revisá la conexión y los datos.';
    } catch (DomainException | RuntimeException $error) {
        $GLOBALS['errorFormulario'] = $error->getMessage();
    }

    if ($imagenNueva !== null) {
        unlink(__DIR__ . '/../' . $imagenNueva);
    }

    return [$registro, $categorias, $marcas];
}

function textoCatalogo(string $texto, int $maximo, string $campo): string
{
    $longitud = preg_match_all('/./us', $texto);

    if (!$longitud || $longitud > $maximo) {
        throw new DomainException("Completá el campo $campo con hasta $maximo caracteres.");
    }

    return $texto;
}

function idCatalogo(string $valor, string $campo): int
{
    $id = filter_var($valor, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1],
    ]);

    if ($id === false) {
        throw new DomainException("Seleccioná una opción válida para $campo.");
    }

    return $id;
}

function subirImagenCatalogo(): ?string
{
    $archivo = $_FILES['imagen'] ?? null;

    if ($archivo === null || ($archivo['error'] ?? null) === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if (($archivo['error'] ?? null) !== UPLOAD_ERR_OK
        || !is_string($archivo['tmp_name'] ?? null)
        || !is_int($archivo['size'] ?? null)
        || $archivo['size'] > 5 * 1024 * 1024) {
        throw new DomainException('La imagen debe pesar hasta 5 MB.');
    }

    $formatos = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
    ];

    $tipo = (new finfo(FILEINFO_MIME_TYPE))->file($archivo['tmp_name']);

    if (!isset($formatos[$tipo]) || !getimagesize($archivo['tmp_name'])) {
        throw new DomainException('Subí una imagen JPG, PNG o WebP válida.');
    }

    $carpeta = __DIR__ . '/../upload/imagenes';

    if (!is_dir($carpeta) && !mkdir($carpeta, 0775, true) && !is_dir($carpeta)) {
        throw new RuntimeException('No se pudo crear la carpeta de imágenes.');
    }

    $nombre = bin2hex(random_bytes(16)) . '.' . $formatos[$tipo];

    if (!move_uploaded_file($archivo['tmp_name'], $carpeta . '/' . $nombre)) {
        throw new RuntimeException('No se pudo guardar la imagen.');
    }

    return 'upload/imagenes/' . $nombre;
}