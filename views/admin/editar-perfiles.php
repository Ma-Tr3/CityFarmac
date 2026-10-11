<?php
$datosFormulario = require __DIR__ . '/../../data/admin.php';
$idFormulario = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$registroFormulario = null;
foreach ($datosFormulario['perfiles'] as $itemFormulario) {
    if ($itemFormulario['id'] === $idFormulario) {
        $registroFormulario = $itemFormulario;
        break;
    }
}
if ($registroFormulario === null) {
    http_response_code(404);
    echo 'Registro no encontrado. <a href="panel-perfiles.php">Volver al listado</a>';
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
        <a href="panel-perfiles.php">Perfiles</a>
        <span>/</span>
        <span>Modificar</span>
    </nav>
    <div class="page-heading">
        <h1>Modificar perfil</h1>
        <p class="muted">
            Completá los campos. Los datos se usan solamente como demostración.
        </p>
    </div>
    <form class="surface admin-form admin-form--perfiles" data-demo-form="admin">
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
            <fieldset class="span-all">
                <legend>Secciones permitidas</legend>
                <p class="muted small">
                    Seleccioná las secciones a las que podrá acceder este perfil.
                </p>
                <div class="permissions-grid">
                    <label class="check" for="permiso-productos">
                        <input
                            id="permiso-productos"
                            name="secciones[]"
                            type="checkbox"
                            value="productos"
                            <?= in_array('Productos', array_map('trim', explode(',', $registroFormulario['secciones'])), true) ? 'checked' : '' ?> />
                        Productos
                    </label>
                    <label class="check" for="permiso-categorias">
                        <input
                            id="permiso-categorias"
                            name="secciones[]"
                            type="checkbox"
                            value="categorias"
                            <?= in_array('Categorías', array_map('trim', explode(',', $registroFormulario['secciones'])), true) ? 'checked' : '' ?> />
                        Categorías
                    </label>
                    <label class="check" for="permiso-marcas">
                        <input
                            id="permiso-marcas"
                            name="secciones[]"
                            type="checkbox"
                            value="marcas"
                            <?= in_array('Marcas', array_map('trim', explode(',', $registroFormulario['secciones'])), true) ? 'checked' : '' ?> />
                        Marcas
                    </label>
                    <label class="check" for="permiso-comentarios">
                        <input
                            id="permiso-comentarios"
                            name="secciones[]"
                            type="checkbox"
                            value="comentarios"
                            <?= in_array('Comentarios', array_map('trim', explode(',', $registroFormulario['secciones'])), true) ? 'checked' : '' ?> />
                        Comentarios
                    </label>
                    <label class="check" for="permiso-usuarios">
                        <input
                            id="permiso-usuarios"
                            name="secciones[]"
                            type="checkbox"
                            value="usuarios"
                            <?= in_array('Usuarios', array_map('trim', explode(',', $registroFormulario['secciones'])), true) ? 'checked' : '' ?> />
                        Usuarios
                    </label>
                    <label class="check" for="permiso-perfiles">
                        <input
                            id="permiso-perfiles"
                            name="secciones[]"
                            type="checkbox"
                            value="perfiles"
                            <?= in_array('Perfiles', array_map('trim', explode(',', $registroFormulario['secciones'])), true) ? 'checked' : '' ?> />
                        Perfiles
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="form-feedback" aria-live="polite"></div>
        <div class="form-actions">
            <a class="button outline" href="panel-perfiles.php"> Cancelar </a>
            <button class="button primary" type="submit">Guardar perfil</button>
        </div>
    </form>
</main>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>
