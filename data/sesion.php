<?php

require_once __DIR__ . '/../views/layouts/rutas.php';
require_once __DIR__ . '/almacen.php';
require_once __DIR__ . '/admin-inicial.php';

if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.use_strict_mode', '1');

    session_set_cookie_params([
        'httponly' => true,
        'secure' => !empty($_SERVER['HTTPS'])
            && $_SERVER['HTTPS'] !== 'off',
        'samesite' => 'Lax',
        'path' => urlCityFarmac(''),
    ]);

    session_start();
}

if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

function usuarioActual(): ?array
{
    $datos = cargarDatos();

    $usuario = buscarPorId(
        $datos['usuarios'],
        (int) ($_SESSION['usuario_id'] ?? 0)
    );

    if (!$usuario || empty($usuario['estado'])) {
        return null;
    }

    return $usuario;
}

function permisosUsuario(?array $usuario): array
{
    if (!$usuario || $usuario['perfil'] === 'Usuario') {
        return [];
    }

    $datos = cargarDatos();

    foreach ($datos['perfiles'] as $perfil) {
        if (
            $perfil['nombre'] === $usuario['perfil']
            && !empty($perfil['estado'])
        ) {
            if ($usuario['perfil'] === 'Administrador') {
                return [
                    'productos',
                    'categorias',
                    'marcas',
                    'comentarios',
                    'usuarios',
                    'perfiles',
                ];
            }

            $mapa = [
                'Productos' => 'productos',
                'Categorías' => 'categorias',
                'Marcas' => 'marcas',
                'Comentarios' => 'comentarios',
                'Usuarios' => 'usuarios',
                'Perfiles' => 'perfiles',
            ];

            $secciones = array_map(
                'trim',
                explode(',', $perfil['secciones'])
            );

            return array_values(
                array_intersect_key(
                    $mapa,
                    array_flip($secciones)
                )
            );
        }
    }

    return [];
}

function exigirPanel(string $seccion = ''): void
{
    $usuario = usuarioActual();

    // Sin sesión: ir al login.
    if (!$usuario) {
        header('Location: ' . urlCityFarmac('login.php'));
        exit;
    }

    $permisos = permisosUsuario($usuario);

    // Usuario común: ir a su cuenta.
    if (!$permisos) {
        header('Location: ' . urlCityFarmac('cuenta.php'));
        exit;
    }

    // Personal sin permiso para esa sección: volver al panel.
    if (
        $seccion !== ''
        && !in_array($seccion, $permisos, true)
    ) {
        header(
            'Location: '
                . urlCityFarmac('views/admin/panel-inicio.php')
        );
        exit;
    }

    header('Cache-Control: no-store');
}

function tokenSesionValido(): bool
{
    return hash_equals(
        $_SESSION['csrf'],
        (string) ($_POST['csrf'] ?? '')
    );
}

function iniciarSesionUsuario(array $usuario): void
{
    session_regenerate_id(true);

    $_SESSION['usuario_id'] = (int) $usuario['id'];
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
