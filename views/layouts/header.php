<?php require_once __DIR__ . '/rutas.php'; ?>
<body>
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

            <a class="site-account" href="<?= rutaCityFarmac('registro.php') ?>">
                Crear cuenta ↗
            </a>
        </div>
    </header>