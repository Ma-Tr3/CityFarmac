<?php
require_once __DIR__ . '/../../data/formulario.php';
procesarFormulario('productos');
$datosFormulario = require __DIR__ . '/../../data/admin.php';
$idFormulario = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$registroFormulario = null;
foreach ($datosFormulario['productos'] as $itemFormulario) {
    if ($itemFormulario['id'] === $idFormulario) {
        $registroFormulario = $itemFormulario;
        break;
    }
}
if ($registroFormulario === null) {
    http_response_code(404);
    echo 'Registro no encontrado. <a href="' . rutaCityFarmac('views/admin/panel-productos.php') . '">Volver al listado</a>';
    exit;
}
function escaparFormulario($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

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
        <a href="<?= rutaCityFarmac('views/admin/panel-productos.php') ?>">Productos</a>
        <span>/</span>
        <span>Modificar</span>
    </nav>
    <div class="page-heading">
        <h1>Modificar producto</h1>
        <p class="muted">
            Completá los campos. Los cambios se guardan al confirmar el formulario.
        </p>
    </div>
    <form class="surface admin-form admin-form--productos" method="post" enctype="multipart/form-data">
        <?= camposFormulario() ?>
        <div class="form-grid">
            <div class="field-nombre">
                <label for="nombre">Nombre</label>
                <input
                    id="nombre"
                    name="nombre"
                    required
                    maxlength="120"
                    value="<?= escaparFormulario($registroFormulario['nombre']) ?>" />
            </div>
            <div class="field-descripcion">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" required maxlength="2000"><?= escaparFormulario($registroFormulario['descripcion']) ?></textarea>
            </div>
            <div class="field-precio">
                <label for="precio">Precio ($)</label>
                <input
                    id="precio"
                    name="precio"
                    type="number"
                    required
                    min="0.01"
                    max="99999999"
                    step="0.01"
                    value="<?= escaparFormulario($registroFormulario['precio']) ?>" />
            </div>
            <div class="field-categoria">
                <label for="categoria">Categoría</label>
                <select id="categoria" name="categoria" required data-form-category><?= opcionesFormulario('categoria', 'categorias', $registroFormulario ?? []) ?></select>
            </div>
            <div class="field-subcategoria">
                <label for="subcategoria">Subcategoría</label>
                <select
                    id="subcategoria"
                    name="subcategoria"
                    required
                    data-form-subcategory><?= opcionesFormulario('subcategoria', 'categorias', $registroFormulario ?? []) ?></select>
            </div>
            <div class="field-marca">
                <label for="marca">Marca</label>
                <select id="marca" name="marca" required><?= opcionesFormulario('marca', 'marcas', $registroFormulario ?? []) ?></select>
            </div>
            <div class="field-modelo">
                <label for="modelo">Modelo</label>
                <input
                    id="modelo"
                    name="modelo"
                    required
                    maxlength="100"
                    value="<?= escaparFormulario($registroFormulario['modelo']) ?>" />
            </div>
            <div class="field-imagen">
                <label for="imagen">Imagen del producto</label>
                <input
                    id="imagen"
                    name="imagen"
                    type="file"
                    accept="image/png,image/jpeg,image/webp"
                    data-image-input
                    aria-describedby="image-help" />
                <small id="image-help" class="muted">
                    JPG, PNG o WebP (máximo 5 MB). Opcional: conserva la imagen actual.
                </small>
            </div>
            <div class="span-all image-preview">
                <img
                    data-image-preview
                    src="<?= escaparDato(imagenUrl($registroFormulario['imagen'])) ?>"
                    alt="Vista previa del producto"
                    width="90"
                    height="110" />
            </div>
            <label class="check span-all" for="destacado">
                <input id="destacado" name="destacado" type="checkbox" <?= $registroFormulario['destacado'] ? 'checked' : '' ?> />
                Marcar como producto destacado
            </label>
        </div>
        <div class="form-feedback" aria-live="polite"></div>
        <div class="form-actions">
            <a class="button outline" href="<?= rutaCityFarmac('views/admin/panel-productos.php') ?>"> Cancelar </a>
            <button class="button primary" type="submit">Guardar producto</button>
        </div>
    </form>
</main>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>
<script src="<?= rutaCityFarmac('assets/js/formulario.js') ?>" defer></script>