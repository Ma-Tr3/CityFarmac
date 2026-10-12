<?php
require_once __DIR__ . '/../../data/sesion.php';
exigirPanel((string)($_POST['entidad'] ?? ''));

require_once __DIR__ . '/../../data/formulario.php';
try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }
    validarToken();
    $entidad = (string)($_POST['entidad'] ?? '');
    if (!in_array($entidad, ['productos', 'usuarios', 'categorias', 'marcas', 'perfiles', 'comentarios'], true)) throw new RuntimeException('Entidad inválida.');
    actualizarDatos(function (&$datos) use ($entidad) {
        $id = (int)($_POST['id'] ?? 0);
        $encontrado = false;
        foreach ($datos[$entidad] as &$r) if ($r['id'] == $id) {
            $r['estado'] = empty($r['estado']) ? 1 : 0;
            $encontrado = true;
        }
        if (!$encontrado) throw new RuntimeException('Registro no encontrado.');
    });
    header('Location: ' . urlCityFarmac('views/admin/panel-' . $entidad . '.php'));
} catch (Throwable $e) {
    http_response_code(400);
    echo escaparDato($e->getMessage());
}
