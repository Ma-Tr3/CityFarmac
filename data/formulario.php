<?php
require_once __DIR__ . '/almacen.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
function camposFormulario(): string
{
    $error = $GLOBALS['errorFormulario'] ?? '';
    return '<input type="hidden" name="csrf" value="' . escaparDato($_SESSION['csrf']) . '"><p role="status">' . escaparDato($error) . '</p>';
}
function validarToken(): void
{
    if (!hash_equals($_SESSION['csrf'], (string)($_POST['csrf'] ?? ''))) throw new RuntimeException('El formulario venció. Recargá la página.');
}
function opcionesFormulario(string $campo, string $coleccion, array $registro): string
{
    $datos = cargarDatos();
    $html = '<option value="">Seleccioná una opción</option>';
    $seleccionado = $registro[$campo . '_id'] ?? $registro[$campo] ?? '';
    foreach ($datos[$coleccion] as $r) {
        if (empty($r['estado'])) continue;
        if (in_array($campo, ['categoria', 'padre']) && isset($r['padre_id'])) continue;
        if ($campo === 'padre' && ($registro['id'] ?? 0) == $r['id']) continue;
        if ($campo === 'subcategoria' && !isset($r['padre_id'])) continue;
        $valor = in_array($campo, ['marca', 'perfil']) ? $r['nombre'] : $r['id'];
        $html .= '<option value="' . escaparDato($valor) . '" ' . ((string)$valor === (string)$seleccionado ? 'selected' : '') . (isset($r['padre_id']) ? ' data-parent="' . (int)$r['padre_id'] . '"' : '') . '>' . escaparDato($r['nombre']) . '</option>';
    }
    return $html;
}
function procesarFormulario(string $entidad): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
    $imagenNueva = null;
    try {
        validarToken();
        actualizarDatos(function (&$datos) use ($entidad, &$imagenNueva) {
            $id = (int)($_GET['id'] ?? 0);
            $viejo = $id ? buscarPorId($datos[$entidad], $id) : null;
            if ($id && !$viejo) throw new RuntimeException('Registro no encontrado.');
            $r = $viejo ?? ['id' => max(array_merge([0], array_column($datos[$entidad], 'id'))) + 1, 'estado' => 1];
            $r['nombre'] = trim((string)($_POST['nombre'] ?? ''));
            if ($r['nombre'] === '' || strlen($r['nombre']) > 240) throw new RuntimeException('Ingresá un nombre válido.');
            if ($entidad === 'usuarios') {
                $r['email'] = trim((string)($_POST['email'] ?? ''));
                if (!filter_var($r['email'], FILTER_VALIDATE_EMAIL)) throw new RuntimeException('Email inválido.');
                foreach ($datos['usuarios'] as $u) if ($u['id'] != $r['id'] && strcasecmp($u['email'], $r['email']) === 0) throw new RuntimeException('El email ya existe.');
                $r['perfil'] = (string)($_POST['perfil'] ?? '');
                if (!in_array($r['perfil'], array_column($datos['perfiles'], 'nombre'), true)) throw new RuntimeException('Perfil inválido.');
                $password = (string)($_POST['password'] ?? '');
                if (!$viejo || $password !== '') {
                    if (strlen($password) < 8) throw new RuntimeException('La contraseña debe tener al menos 8 caracteres.');
                    $r['password'] = password_hash($password, PASSWORD_DEFAULT);
                }
            }
            if ($entidad === 'perfiles') {
                $permitidas = ['productos' => 'Productos', 'categorias' => 'Categorías', 'marcas' => 'Marcas', 'comentarios' => 'Comentarios', 'usuarios' => 'Usuarios', 'perfiles' => 'Perfiles'];
                $r['secciones'] = implode(', ', array_values(array_intersect_key($permitidas, array_flip((array)($_POST['secciones'] ?? [])))));
            }
            if ($entidad === 'categorias') {
                $padre = (int)($_POST['padre'] ?? 0);
                unset($r['padre_id']);
                $r['padre'] = 'Principal';
                if ($padre) {
                    $c = buscarPorId($datos['categorias'], $padre);
                    if (!$c || isset($c['padre_id']) || $padre === $r['id']) throw new RuntimeException('Categoría padre inválida.');
                    foreach ($datos['categorias'] as $cHija) if (($cHija['padre_id'] ?? 0) == $r['id']) throw new RuntimeException('Una categoría con subcategorías debe permanecer principal.');
                    $r['padre_id'] = $padre;
                    $r['padre'] = $c['nombre'];
                }
            }
            if ($entidad === 'productos') {
                foreach (['descripcion', 'modelo'] as $campo) {
                    $r[$campo] = trim((string)($_POST[$campo] ?? ''));
                    if ($r[$campo] === '' || strlen($r[$campo]) > ($campo === 'modelo' ? 200 : 4000)) throw new RuntimeException('Completá descripción y modelo.');
                }
                $precio = filter_var($_POST['precio'] ?? '', FILTER_VALIDATE_FLOAT);
                if ($precio === false || $precio <= 0 || $precio > 99999999) throw new RuntimeException('Precio inválido.');
                $r['precio'] = $precio;
                $c = buscarPorId($datos['categorias'], (int)($_POST['categoria'] ?? 0));
                $sub = buscarPorId($datos['categorias'], (int)($_POST['subcategoria'] ?? 0));
                if (!$c || !$sub || isset($c['padre_id']) || ($sub['padre_id'] ?? 0) != $c['id']) throw new RuntimeException('Revisá categoría y subcategoría.');
                $r['categoria_id'] = $c['id'];
                $r['categoria'] = $c['nombre'];
                $r['subcategoria_id'] = $sub['id'];
                $r['subcategoria'] = $sub['nombre'];
                $r['marca'] = (string)($_POST['marca'] ?? '');
                if (!in_array($r['marca'], array_column($datos['marcas'], 'nombre'), true)) throw new RuntimeException('Marca inválida.');
                $r['destacado'] = isset($_POST['destacado']) ? 1 : 0;
                $f = $_FILES['imagen'] ?? ['error' => UPLOAD_ERR_NO_FILE];
                if ($f['error'] !== UPLOAD_ERR_NO_FILE) {
                    if ($f['error'] !== UPLOAD_ERR_OK || $f['size'] > 5 * 1024 * 1024) throw new RuntimeException('La imagen debe pesar hasta 5 MB.');
                    $tipos = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
                    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
                    if (!isset($tipos[$mime]) || !getimagesize($f['tmp_name'])) throw new RuntimeException('Subí una imagen JPG, PNG o WebP válida.');
                    $r['imagen'] = 'upload/imagenes/' . bin2hex(random_bytes(16)) . '.' . $tipos[$mime];
                    $imagenNueva = __DIR__ . '/../' . $r['imagen'];
                    if (!move_uploaded_file($f['tmp_name'], $imagenNueva)) throw new RuntimeException('No se pudo guardar la imagen.');
                } elseif (!$viejo) throw new RuntimeException('Seleccioná la imagen del producto.');
            }
            if ($viejo) {
                foreach ($datos[$entidad] as &$item) if ($item['id'] == $id) $item = $r;
                unset($item);
            } else $datos[$entidad][] = $r;
            // Mantener los nombres relacionados cuando se edita una marca, perfil o categoría.
            if ($viejo && $viejo['nombre'] !== $r['nombre']) {
                foreach ($datos['productos'] as &$producto) {
                    if ($entidad === 'marcas' && $producto['marca'] === $viejo['nombre']) $producto['marca'] = $r['nombre'];
                    foreach (['categoria', 'subcategoria'] as $campo) if ($entidad === 'categorias' && $producto[$campo . '_id'] == $id) $producto[$campo] = $r['nombre'];
                }
                unset($producto);
                foreach ($datos['usuarios'] as &$u) if ($entidad === 'perfiles' && $u['perfil'] === $viejo['nombre']) $u['perfil'] = $r['nombre'];
                unset($u);
                foreach ($datos['categorias'] as &$c) if ($entidad === 'categorias' && ($c['padre_id'] ?? 0) == $id) $c['padre'] = $r['nombre'];
                unset($c);
            }
        });
        header('Location: ' . urlCityFarmac('views/admin/panel-' . $entidad . '.php?guardado=1'));
        exit;
    } catch (Throwable $e) {
        if ($imagenNueva && is_file($imagenNueva)) unlink($imagenNueva);
        $GLOBALS['errorFormulario'] = $e->getMessage();
    }
}
