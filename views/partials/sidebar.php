<?php
require_once __DIR__ . '/../layouts/rutas.php';

$paginaSidebar = basename($_SERVER['SCRIPT_NAME'] ?? '');
$seccionSidebar = preg_replace('/^(alta|editar)-/', 'panel-', $paginaSidebar);
?>

<div class="admin-layout">
    <aside class="sidebar">
        <span>ADMINISTRACIÓN</span>

        <nav aria-label="Menú de administración">
            <a href="<?= rutaCityFarmac('views/admin/panel-inicio.php') ?>"
                <?= $seccionSidebar === 'panel-inicio.php' ? 'aria-current="page"' : '' ?>>
                Inicio
            </a>

            <a href="<?= rutaCityFarmac('views/admin/panel-productos.php') ?>"
                <?= $seccionSidebar === 'panel-productos.php' ? 'aria-current="page"' : '' ?>>
                Productos
            </a>

            <a href="<?= rutaCityFarmac('views/admin/panel-categorias.php') ?>"
                <?= $seccionSidebar === 'panel-categorias.php' ? 'aria-current="page"' : '' ?>>
                Categorías
            </a>

            <a href="<?= rutaCityFarmac('views/admin/panel-marcas.php') ?>"
                <?= $seccionSidebar === 'panel-marcas.php' ? 'aria-current="page"' : '' ?>>
                Marcas
            </a>

            <a href="<?= rutaCityFarmac('views/admin/panel-comentarios.php') ?>"
                <?= $seccionSidebar === 'panel-comentarios.php' ? 'aria-current="page"' : '' ?>>
                Comentarios
            </a>

            <a href="<?= rutaCityFarmac('views/admin/panel-usuarios.php') ?>"
                <?= $seccionSidebar === 'panel-usuarios.php' ? 'aria-current="page"' : '' ?>>
                Usuarios
            </a>

            <a href="<?= rutaCityFarmac('views/admin/panel-perfiles.php') ?>"
                <?= $seccionSidebar === 'panel-perfiles.php' ? 'aria-current="page"' : '' ?>>
                Perfiles
            </a>
        </nav>

        <a href="<?= rutaCityFarmac('views/public/inicio.php') ?>">
            ↗ Ver sitio público
        </a>
    </aside>