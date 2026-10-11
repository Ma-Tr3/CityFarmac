<?php
$datosFormulario = require __DIR__ . '/../../data/admin.php';
$idFormulario = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$registroFormulario = null;
foreach ($datosFormulario['categorias'] as $itemFormulario) {
    if ($itemFormulario['id'] === $idFormulario) {
        $registroFormulario = $itemFormulario;
        break;
    }
}
if ($registroFormulario === null) {
    http_response_code(404);
    echo 'Registro no encontrado. <a href="panel-categorias.php">Volver al listado</a>';
    exit;
}
function escaparFormulario($valor): string
{
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
        <a href="panel-categorias.php">Categorías</a>
        <span>/</span>
        <span>Modificar</span>
    </nav>
    <div class="page-heading">
        <h1>Modificar categoría</h1>
        <p class="muted">
            Completá los campos. Los datos se usan solamente como demostración.
        </p>
    </div>
    <form class="surface admin-form admin-form--categorias" data-demo-form="admin">
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
            <div class="span-all">
                <label for="padre">Categoría padre (opcional)</label>
                <select id="padre" name="padre">
                    <option value="">Sin padre · Categoría principal</option>
                    <?php foreach ($datosFormulario['categorias'] as $categoriaPadre): ?>
                        <?php if (!isset($categoriaPadre['padre_id']) && $categoriaPadre['id'] !== $registroFormulario['id']): ?>
                            <option value="<?= escaparFormulario($categoriaPadre['id']) ?>" <?= (int) ($registroFormulario['padre_id'] ?? 0) === $categoriaPadre['id'] ? 'selected' : '' ?>><?= escaparFormulario($categoriaPadre['nombre']) ?></option>
                    <?php endif;
                    endforeach; ?>
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
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>