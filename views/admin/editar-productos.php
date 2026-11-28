<?php
require_once __DIR__ . '/../../data/sesion.php';
exigirPanel('productos');

require_once __DIR__ . '/../../controladores/catalogo.php';
require_once __DIR__ . '/../partials/opciones-catalogo.php';

[$registroFormulario, $categoriasFormulario, $marcasFormulario] =
    prepararFormularioCatalogo('productos', true);

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
        <a href="<?= rutaCityFarmac('views/admin/panel-productos.php') ?>">Productos</a>
        <span>/</span>
        <span>Modificar</span>
    </nav>

    <div class="page-heading">
        <h1>Modificar producto</h1>
        <p class="muted">Los cambios se guardan al confirmar el formulario.</p>
    </div>

    <form class="surface admin-form admin-form--productos" method="post" enctype="multipart/form-data">
        <?= camposFormulario() ?>
        <?php require_once __DIR__ . '/../partials/mensajes.php'; ?>

        <div class="form-grid">
            <div class="field-nombre">
                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" required maxlength="180"
                    value="<?= escaparDato($registroFormulario['nombre'] ?? '') ?>">
            </div>

            <div class="field-descripcion">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" required maxlength="2000"><?= escaparDato($registroFormulario['descripcion'] ?? '') ?></textarea>
            </div>

            <div class="field-precio">
                <label for="precio">Precio ($)</label>
                <input id="precio" name="precio" type="number" required
                    min="0.01" max="9999999999.99" step="0.01"
                    value="<?= escaparDato($registroFormulario['precio'] ?? '') ?>">
            </div>

            <div class="field-categoria">
                <label for="categoria">Categoría</label>
                <select id="categoria" name="categoria" required data-form-category>
                    <?= opcionesCatalogo($categoriasFormulario, 'categoria', $registroFormulario) ?>
                </select>
            </div>

            <div class="field-subcategoria">
                <label for="subcategoria">Subcategoría</label>
                <select id="subcategoria" name="subcategoria" data-form-subcategory>
                    <?= opcionesCatalogo($categoriasFormulario, 'subcategoria', $registroFormulario) ?>
                </select>
            </div>

            <div class="field-marca">
                <label for="marca">Marca</label>
                <select id="marca" name="marca" required>
                    <?= opcionesCatalogo($marcasFormulario, 'marca', $registroFormulario) ?>
                </select>
            </div>

            <div class="field-modelo">
                <label for="modelo">Modelo</label>
                <input id="modelo" name="modelo" required maxlength="120"
                    value="<?= escaparDato($registroFormulario['modelo'] ?? '') ?>">
            </div>

            <div class="field-imagen">
                <label for="imagen">Reemplazar imagen (opcional)</label>
                <input id="imagen" name="imagen" type="file"
                    accept="image/png,image/jpeg,image/webp"
                    data-image-input aria-describedby="image-help">
                <small id="image-help" class="muted">Elegí una imagen JPG, PNG o WebP de hasta 5 MB para reemplazar la actual.</small>
            </div>

            <div class="span-all image-preview">
                <img data-image-preview
                    src="<?= rutaCityFarmac(($registroFormulario['imagen'] ?? '') ?: 'assets/img/products/solar.svg') ?>"
                    alt="Vista previa del producto" width="90" height="110">
            </div>

            <label class="check span-all" for="destacado">
                <input id="destacado" name="destacado" type="checkbox"
                    <?= !empty($registroFormulario['destacado']) ? 'checked' : '' ?>>
                Marcar como producto destacado
            </label>
        </div>

        <div class="form-actions">
            <a class="button outline" href="<?= rutaCityFarmac('views/admin/panel-productos.php') ?>">Cancelar</a>
            <button class="button primary" type="submit">Guardar producto</button>
        </div>
    </form>
</main>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
<script src="<?= rutaCityFarmac('assets/js/formulario.js') ?>" defer></script>
</body>
</html>