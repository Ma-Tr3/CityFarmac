<?php
require_once __DIR__ . '/data/sesion.php';
$usuarioCuenta = usuarioActual();
if (!$usuarioCuenta) {
    header('Location: ' . urlCityFarmac('login.php'));
    exit;
}
header('Cache-Control: no-store');
$css = '<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/public.css') . '">';
require_once __DIR__ . '/views/layouts/head.php';
?>

<body>
    <?php require_once __DIR__ . '/views/layouts/header.php'; ?>
    <main class="cf-contenedor">
        <section class="cf-panel">
            <h1>Mi cuenta</h1>
            <p>Hola, <?= escaparDato($usuarioCuenta['nombre']) ?>.</p>
            <p>Email: <?= escaparDato($usuarioCuenta['email']) ?></p>
            <a class="cf-boton" href="<?= rutaCityFarmac('views/public/catalogo.php') ?>">Ver productos</a>
            <?php if (permisosUsuario($usuarioCuenta)): ?><a class="cf-boton-claro" href="<?= rutaCityFarmac('views/admin/panel-inicio.php') ?>">Ir al panel</a><?php endif; ?>
        </section>
    </main>
    <?php require_once __DIR__ . '/views/layouts/footer.php'; ?>
</body>

</html>