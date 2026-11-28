<?php

require_once __DIR__ . '/../../data/sesion.php';
require_once __DIR__ . '/../../data/formulario.php';
require_once __DIR__ . '/../../modelos/catalogo.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$entidad = $_POST['entidad'] ?? '';
$entidadesCatalogo = ['categorias', 'marcas', 'productos', 'comentarios'];
$entidadesPermitidas = [...$entidadesCatalogo, 'usuarios', 'perfiles'];

if (!in_array($entidad, $entidadesPermitidas, true)) {
    http_response_code(400);
    exit('Entidad inválida.');
}

exigirPanel($entidad);

$destino = 'views/admin/panel-' . $entidad . '.php';
$campoFiltro = match ($entidad) {
    'categorias' => 'padre',
    'comentarios' => 'producto',
    default => null,
};

if ($campoFiltro !== null) {
    $filtro = filter_input(INPUT_POST, $campoFiltro, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1],
    ]);

    if ($filtro) {
        $destino .= '?' . $campoFiltro . '=' . $filtro;
    }
}

try {
    validarToken();

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1],
    ]);

    if (!$id) {
        throw new DomainException('Registro inválido.');
    }

    if (in_array($entidad, $entidadesCatalogo, true)) {
        cambiarEstadoCatalogo($entidad, $id);
    } else {
        actualizarDatos(function (&$datos) use ($entidad, $id) {
            foreach ($datos[$entidad] as &$registro) {
                if ((int) $registro['id'] === $id) {
                    $registro['estado'] = empty($registro['estado']) ? 1 : 0;
                    return;
                }
            }

            throw new DomainException('Registro no encontrado.');
        });
    }

    $_SESSION['mensaje_exito'] = $entidad === 'comentarios'
        ? 'Estado del comentario actualizado.'
        : 'Estado actualizado correctamente.';
} catch (PDOException $error) {
    error_log($error->getMessage());
    $_SESSION['mensaje_error'] = 'No se pudo actualizar el estado en la base de datos.';
} catch (DomainException | RuntimeException $error) {
    $_SESSION['mensaje_error'] = $error->getMessage();
}

header('Location: ' . urlCityFarmac($destino), true, 303);
exit;