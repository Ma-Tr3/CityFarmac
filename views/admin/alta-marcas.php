<?php
require_once __DIR__ . '/../../data/sesion.php';
exigirPanel('marcas');

require_once __DIR__ . '/../../data/formulario.php';
procesarFormulario('marcas');
require_once __DIR__ . '/../layouts/rutas.php';
$css = '<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/admin-formularios.css') . '">
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/header-footer.css') . '">';
require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main id="contenido" class="admin-main admin-form-page">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="<?= rutaCityFarmac('views/admin/panel-inicio.php') ?>">Panel</a>
        <span>/</span>
        <a href="<?= rutaCityFarmac('views/admin/panel-marcas.php') ?>">Marcas</a>
        <span>/</span>
        <span>Nuevo registro</span>
    </nav>
    <div class="page-heading">
        <h1>Nuevo marca</h1>
        <p class="muted">
            Completá los campos. Los cambios se guardan al confirmar el formulario.
        </p>
    </div>
    <form class="surface admin-form admin-form--marcas" method="post" enctype="multipart/form-data">
        <?= camposFormulario() ?>
        <div class="form-grid">
            <div class="field-nombre">
                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" required maxlength="120" value="" />
            </div>
        </div>
        <div class="form-feedback" aria-live="polite"></div>
        <div class="form-actions">
            <a class="button outline" href="<?= rutaCityFarmac('views/admin/panel-marcas.php') ?>"> Cancelar </a>
            <button class="button primary" type="submit">Guardar marca</button>
        </div>
    </form>
</main>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>
<script src="<?= rutaCityFarmac('assets/js/formulario.js') ?>" defer></script>