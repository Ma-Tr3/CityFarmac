<?php
$css = '<link rel="stylesheet" href="../../assets/css/admin-formularios.css">';
require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>
<main id="contenido" class="admin-main admin-form-page">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="panel-inicio.php">Panel</a>
        <span>/</span>
        <a href="panel-categorias.php">Categorías</a>
        <span>/</span>
        <span>Nuevo registro</span>
    </nav>
    <div class="page-heading">
        <h1>Nuevo categoría</h1>
        <p class="muted">
            Completá los campos. Los datos se usan solamente como demostración.
        </p>
    </div>
    <form class="surface admin-form admin-form--categorias" data-demo-form="admin">
        <div class="form-grid">
            <div class="field-nombre">
                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" required maxlength="120" value="" />
            </div>
            <div class="span-all">
                <label for="padre">Categoría padre (opcional)</label>
                <select id="padre" name="padre">
                    <option value="">Sin padre · Categoría principal</option>
                    <option value="1">Dermocosmética</option>
                    <option value="2">Cuidado personal</option>
                    <option value="3">Perfumería</option>
                </select>
                <small class="muted">Seleccioná un padre para crear una subcategoría.</small>
            </div>
        </div>
        <div class="form-feedback" aria-live="polite"></div>
        <div class="form-actions">
            <a class="button outline" href="panel-categorias.php"> Cancelar </a>
            <button class="button primary" type="submit">Guardar categoría</button>
        </div>
    </form>
</main>
<?php
require_once __DIR__ . '/../layouts/footer.php'; 