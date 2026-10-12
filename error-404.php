<?php
require_once __DIR__ . '/views/layouts/rutas.php';
http_response_code(404); ?>
<?php
$css = '
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/public.css') . '">
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/header-footer.css') . '">
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/login-error.css') . '">
';
require_once __DIR__ . '/views/layouts/head.php';
require_once __DIR__ . '/views/layouts/header.php';
?>

<main class="cf-error">
    <p class="cf-etiqueta">Página no encontrada</p>
    <p class="cf-error-numero">404</p>
    <h1>Por acá no era.</h1>
    <p class="cf-error-texto">La página que buscás no existe o cambió de dirección.</p>
    <a class="cf-boton" href="<?= rutaCityFarmac('views/public/inicio.php') ?>">Volver al inicio</a>
</main>

<?php require_once __DIR__ . '/views/layouts/footer.php'; ?>

</body>

</html>