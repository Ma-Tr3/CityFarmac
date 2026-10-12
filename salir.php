<?php
require_once __DIR__ . '/data/sesion.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}
if (!tokenSesionValido()) {
    http_response_code(403);
    exit('Formulario vencido.');
}
$_SESSION = [];
$params = session_get_cookie_params();
setcookie(session_name(), '', ['expires' => time() - 3600, 'path' => $params['path'], 'secure' => $params['secure'], 'httponly' => true, 'samesite' => 'Lax']);
session_destroy();
header('Location: ' . urlCityFarmac('login.php'));
exit;
