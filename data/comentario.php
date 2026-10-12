<?php
require_once __DIR__ . '/formulario.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        validarToken();
        actualizarDatos(function (&$datos) {
            $id = (int)($_GET['id'] ?? 0);
            $p = buscarPorId($datos['productos'], $id);
            $email = trim((string)($_POST['email'] ?? ''));
            $texto = trim((string)($_POST['comentario'] ?? ''));
            $ranking = (int)($_POST['valoracion'] ?? 0);
            if (!$p || !$p['estado'] || !filter_var($email, FILTER_VALIDATE_EMAIL) || $texto === '' || strlen($texto) > 4000 || $ranking < 1 || $ranking > 5) throw new RuntimeException('Revisá los datos del comentario.');
            $datos['comentarios'][] = ['id' => max(array_merge([0], array_column($datos['comentarios'], 'id'))) + 1, 'estado' => 1, 'comentario' => $texto, 'email' => $email, 'ranking' => $ranking, 'fecha' => date('d/m/Y'), 'producto_id' => $id, 'producto' => $p['nombre']];
        });
        header('Location: detalle.php?id=' . (int)($_GET['id'] ?? 0));
        exit;
    } catch (Throwable $e) {
        $GLOBALS['errorFormulario'] = $e->getMessage();
    }
}
