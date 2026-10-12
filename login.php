<?php
require_once __DIR__ . '/views/layouts/rutas.php';

$css = '
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/public.css') . '">
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/header-footer.css') . '">
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/login-error.css') . '">
';

require_once __DIR__ . '/views/layouts/head.php';
require_once __DIR__ . '/views/layouts/header.php';
?>

<main class="cf-auth cf-login">
    <div class="cf-auth-tarjeta">
        <p class="cf-etiqueta">City Farmac · Administración</p>
        <h1 class="cf-auth-titulo">Bienvenido de nuevo.</h1>
        <p class="cf-auth-texto">Ingresá tus datos para acceder al panel.</p>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <p class="login-aviso" role="status">El acceso todavía no está conectado al sistema de usuarios.</p>
        <?php endif; ?>
        <form method="post" action="<?= rutaCityFarmac('login.php') ?>">
            <div class="cf-campo"><label for="email">Email</label><input type="email" id="email" name="email" autocomplete="username" required></div>
            <div class="cf-campo"><label for="password">Contraseña</label><input type="password" id="password" name="password" autocomplete="current-password" required></div>
            <button type="submit" class="cf-boton cf-boton--bloque">Ingresar</button>
            <p class="cf-auth-pie"><a href="<?= rutaCityFarmac('registro.php') ?>">Crear una cuenta</a></p>
        </form>
    </div>
</main>
<?php require_once __DIR__ . '/views/layouts/footer.php'; ?>
</body>

</html>