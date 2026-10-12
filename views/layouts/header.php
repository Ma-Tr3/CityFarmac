<?php require_once __DIR__ . '/rutas.php';
$cuentaHeader = usuarioActual(); ?>

<header class="site-header">
    <div class="site-header-inner">
        <a class="site-brand" href="<?= rutaCityFarmac('views/public/inicio.php') ?>">
            <span class="site-brand-icon" aria-hidden="true">✚</span>
            <span>
                City<span class="site-brand-accent">Farmac</span>
                <small>Farmacia y perfumería</small>
            </span>
        </a>

        <nav class="site-navigation" aria-label="Navegación principal">
            <a href="<?= rutaCityFarmac('views/public/inicio.php') ?>">Inicio</a>
            <a href="<?= rutaCityFarmac('views/public/catalogo.php') ?>">Productos</a>
            <a href="<?= rutaCityFarmac('views/public/contacto.php') ?>">Contacto</a>
        </nav>

        <?php if ($cuentaHeader): ?>
            <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap">
                <a class="site-account" href="<?= rutaCityFarmac('cuenta.php') ?>">Mi cuenta</a>
                <?php if (permisosUsuario($cuentaHeader)): ?><a class="site-account" href="<?= rutaCityFarmac('views/admin/panel-inicio.php') ?>">Panel</a><?php endif; ?>
                <form method="post" action="<?= rutaCityFarmac('salir.php') ?>" style="margin:0">
                    <input type="hidden" name="csrf" value="<?= escaparDato($_SESSION['csrf']) ?>">
                    <button class="site-account" style="font:inherit;background:white;cursor:pointer" type="submit">Cerrar sesión</button>
                </form>
            </div>
        <?php else: ?>
            <div style="display:flex;gap:12px"><a class="site-account" href="<?= rutaCityFarmac('login.php') ?>">Ingresar</a><a class="site-account" href="<?= rutaCityFarmac('registro.php') ?>">Crear cuenta ↗</a></div>
        <?php endif; ?>
    </div>
</header>