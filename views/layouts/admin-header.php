<?php require_once __DIR__ . '/rutas.php'; ?>

<header class="site-header">
    <div class="site-header-inner">
        <a class="site-brand" href="<?= rutaCityFarmac('views/admin/panel-inicio.php') ?>">
            <span class="site-brand-icon" aria-hidden="true">+</span>
            <span>City<span class="site-brand-accent">Farmac</span>
                <small>Panel de administración</small>
            </span>
        </a>
        <nav class="site-navigation" aria-label="Navegación del panel">
            <a href="<?= rutaCityFarmac('views/admin/panel-inicio.php') ?>">Panel</a>
            <a href="<?= rutaCityFarmac('views/public/inicio.php') ?>">Ver sitio</a>
        </nav>

        <form method="post" action="<?= rutaCityFarmac('salir.php') ?>" style="margin:0">
            <input type="hidden" name="csrf" value="<?= escaparDato($_SESSION['csrf']) ?>">
            <button class="site-account" style="font:inherit;background:white;cursor:pointer" type="submit">Salir</button>
        </form>
    </div>
</header>