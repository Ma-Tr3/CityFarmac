<?php
require_once __DIR__ . '/../../data/sesion.php';
exigirPanel('categorias');

require_once __DIR__ . '/../../controladores/catalogo.php';
require_once __DIR__ . '/../partials/opciones-catalogo.php';

[$registroFormulario, $categoriasFormulario] =
    prepararFormularioCatalogo('categorias', true);

require_once __DIR__ . '/../layouts/rutas.php';
$css = '<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/admin-formularios.css') . '">
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/header-footer.css') . '">';
require_once __DIR__ . '/../layouts/admin-head.php';
require_once __DIR__ . '/../layouts/admin-header.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main id="contenido" class="admin-main admin-form-page">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="<?= rutaCityFarmac('views/admin/panel-inicio.php') ?>">Panel</a>
        <span>/</span>
        <a href="<?= rutaCityFarmac('views/admin/panel-categorias.php') ?>">Categorías</a>
        <span>/</span>
        <span>Modificar</span>
    </nav>

    <div class="page-heading">
        <h1>Modificar categoría</h1>
        <p class="muted">Completá los campos. Los cambios se guardan al confirmar el formulario.</p>
    </div>

    <form class="surface admin-form admin-form--categorias" method="post">
        <?= camposFormulario() ?>
        <?php require_once __DIR__ . '/../partials/mensajes.php'; ?>

        <div class="form-grid">
            <div class="field-nombre">
                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" required maxlength="120"
                    value="<?= escaparDato($registroFormulario['nombre'] ?? '') ?>">
            </div>

            <div class="span-all">
                <label for="padre">Categoría padre (opcional)</label>
                <select id="padre" name="padre">
                    <?= opcionesCatalogo($categoriasFormulario, 'padre', $registroFormulario) ?>
                </select>
                <small class="muted">Seleccioná un padre para convertirla en subcategoría.</small>
            </div>
        </div>

        <div class="form-actions">
            <a class="button outline" href="<?= rutaCityFarmac('views/admin/panel-categorias.php') ?>">Cancelar</a>
            <button class="button primary" type="submit">Guardar categoría</button>
        </div>
    </form>
</main>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
<script src="<?= rutaCityFarmac('assets/js/formulario.js') ?>" defer></script>
</body>
</html>