<?php
$css = '
<link rel="stylesheet" href="../../assets/css/public.css">
<link rel="stylesheet" href="../../assets/css/header-footer.css">
';
// Esta página está en la raíz, así que los archivos (CSS, etc.) se buscan desde acá
$base = '';

require_once __DIR__ . '/views/layouts/head.php';
require_once __DIR__ . '/views/layouts/header.php';

?>


<main class="cf-auth">
    <div class="cf-auth-tarjeta">
        <p class="cf-etiqueta">City Farmac · Administración</p>
        <h1 class="cf-auth-titulo">Creá tu cuenta.</h1>
        <p class="cf-auth-texto">Completá tus datos para registrarte.</p>

        <form method="post" action="registro.php">
            <div class="cf-campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" autocomplete="name" required>
            </div>
            <div class="cf-campo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" autocomplete="email" required>
            </div>
            <div class="cf-campo">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" minlength="8" autocomplete="new-password" required>
            </div>
            <div class="cf-campo">
                <label for="password2">Confirmar contraseña</label>
                <input type="password" id="password2" name="password2" minlength="8" autocomplete="new-password" required>
            </div>

            <button type="submit" class="cf-boton cf-boton--bloque">Registrarme</button>
            <p class="cf-auth-pie"><a href="login.php">Ya tengo una cuenta</a></p>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/views/layouts/footer.php'; ?>
</body>
</html>