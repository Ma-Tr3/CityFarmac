<?php
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
    echo 'Registro no encontrado. <a href="panel-productos.php">Volver al listado</a>';
    exit;
}
function escaparFormulario($valor): string {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$css = '<link rel="stylesheet" href="../../assets/css/admin-formularios.css">
<link rel="stylesheet" href="../../assets/css/header-footer.css">';
require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main id="contenido" class="admin-main admin-form-page">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="panel-inicio.php">Panel</a>
        <span>/</span>
        <a href="panel-productos.php">Productos</a>
        <span>/</span>
        <span>Modificar</span>
    </nav>
    <div class="page-heading">
        <h1>Modificar producto</h1>
        <p class="muted">
            Completá los campos. Los datos se usan solamente como demostración.
        </p>
    </div>
    <form class="surface admin-form admin-form--productos" data-demo-form="admin">
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
                <select id="categoria" name="categoria" required data-form-category>
                    <option value="">Seleccioná una categoría</option>
                    <option value="1" <?= (string) ($registroFormulario['categoria_id'] ?? '') === '1' ? 'selected' : '' ?>>Dermocosmética</option>
                    <option value="2" <?= (string) ($registroFormulario['categoria_id'] ?? '') === '2' ? 'selected' : '' ?>>Cuidado personal</option>
                    <option value="3" <?= (string) ($registroFormulario['categoria_id'] ?? '') === '3' ? 'selected' : '' ?>>Perfumería</option>
                </select>
            </div>
            <div class="field-subcategoria">
                <label for="subcategoria">Subcategoría</label>
                <select
                    id="subcategoria"
                    name="subcategoria"
                    required
                    data-form-subcategory>
                    <option value="">Seleccioná una subcategoría</option>
                    <option value="11" data-parent="1" <?= (string) ($registroFormulario['subcategoria_id'] ?? '') === '11' ? 'selected' : '' ?>>
                        Protección solar
                    </option>
                    <option value="12" data-parent="1" <?= (string) ($registroFormulario['subcategoria_id'] ?? '') === '12' ? 'selected' : '' ?>>Cuidado facial</option>
                    <option value="21" data-parent="2" <?= (string) ($registroFormulario['subcategoria_id'] ?? '') === '21' ? 'selected' : '' ?>>Cabello</option>
                    <option value="22" data-parent="2" <?= (string) ($registroFormulario['subcategoria_id'] ?? '') === '22' ? 'selected' : '' ?>>Cuerpo</option>
                    <option value="31" data-parent="3" <?= (string) ($registroFormulario['subcategoria_id'] ?? '') === '31' ? 'selected' : '' ?>>Fragancias</option>
                </select>
            </div>
            <div class="field-marca">
                <label for="marca">Marca</label>
                <select id="marca" name="marca" required>
                    <option value="">Seleccioná una marca</option>
                    <option <?= (string) ($registroFormulario['marca'] ?? '') === 'Dermacare' ? 'selected' : '' ?>>Dermacare</option>
                    <option <?= (string) ($registroFormulario['marca'] ?? '') === 'Hydra Lab' ? 'selected' : '' ?>>Hydra Lab</option>
                    <option <?= (string) ($registroFormulario['marca'] ?? '') === 'Botánica' ? 'selected' : '' ?>>Botánica</option>
                    <option <?= (string) ($registroFormulario['marca'] ?? '') === 'Aura' ? 'selected' : '' ?>>Aura</option>
                </select>
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
                    accept="image/png,image/jpeg,image/webp,image/svg+xml"
                    data-image-input
                    aria-describedby="image-help" />
                <small id="image-help" class="muted">
                    JPG, PNG, WebP o SVG. Opcional: conserva la imagen de ejemplo.
                </small>
            </div>
            <div class="span-all image-preview">
                <img
                    data-image-preview
                    src="../../assets/img/products/<?= escaparFormulario($registroFormulario['imagen']) ?>"
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
            <a class="button outline" href="panel-productos.php"> Cancelar </a>
            <button class="button primary" type="submit">Guardar producto</button>
        </div>
    </form>
</main>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>
