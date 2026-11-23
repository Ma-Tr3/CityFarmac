<?php
require_once __DIR__ . '/../../data/sesion.php';

$entidad = (string)($_POST['entidad'] ?? '');

exigirPanel($entidad);

require_once __DIR__ . '/../../data/formulario.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }

    validarToken();

    
    if (!in_array($entidad, ['productos', 'usuarios', 'categorias', 'marcas', 'perfiles', 'comentarios'], true)) throw new RuntimeException('Entidad inválida.');
    
    actualizarDatos(function (&$datos) use ($entidad) {
        $id = (int)($_POST['id'] ?? 0);
        $encontrado = false;

        foreach ($datos[$entidad] as &$registro) {
            if ((int)$registro['id'] === $id) {
                $registro['estado'] = empty($registro['estado']) ? 1 : 0;
                $encontrado = true;
                break;
            }
        }
        if (!$encontrado) throw new RuntimeException('Registro no encontrado.');
    });

    $_SESSION['mensaje_exito'] = $entidad === 'comentarios' ? 'Estado del comentario actualizado' : 'Estado actualizado correctamente';

    header('Location: ' . urlCityFarmac('views/admin/panel-' . $entidad . '.php'));
    exit;
} catch (Throwable $e) {
    if(in_array($entidad, ['productos', 'usuarios', 'categorias', 'marcas', 'perfiles', 'comentarios'], true)) {
        $_SESSION['mensaje_error'] = $e->getMessage();
        header('Location: ' . urlCityFarmac('views/admin/panel-' . $entidad . '.php'));
        exit;
    }

    http_response_code(400);
    echo escaparDato($e->getMessage());
}
?>
