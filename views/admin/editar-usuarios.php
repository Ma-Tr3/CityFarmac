<?php
$datosFormulario = require __DIR__ . '/../../data/admin.php';
$idFormulario = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$registroFormulario = null;
foreach ($datosFormulario['usuarios'] as $itemFormulario) {
    if ($itemFormulario['id'] === $idFormulario) {
        $registroFormulario = $itemFormulario;
        break;
    }
}
if ($registroFormulario === null) {
    http_response_code(404);
    echo 'Registro no encontrado. <a href="panel-usuarios.php">Volver al listado</a>';
    exit;
}
function escaparFormulario($valor): string {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$css = '<link rel="stylesheet" href="../../assets/css/admin-formularios.css">';
require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';

?>

<main id="contenido" class="admin-main admin-form-page">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="panel-inicio.php">Panel</a>
        <span>/</span>
        <a href="panel-usuarios.php">Usuarios</a>
        <span>/</span>
        <span>Modificar</span>
    </nav>
    <div class="page-heading">
        <h1>Modificar usuario</h1>
        <p class="muted">
            Completá los campos. Los datos se usan solamente como demostración.
        </p>
    </div>
    <form class="surface admin-form admin-form--usuarios" data-demo-form="admin">
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
            <div class="field-email">
                <label for="email">Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    maxlength="150"
                    autocomplete="off"
                    value="<?= escaparFormulario($registroFormulario['email']) ?>" />
            </div>
            <div class="field-perfil">
                <label for="perfil">Perfil</label>
                <select id="perfil" name="perfil" required>
                    <option value="">Seleccioná un perfil</option>
                    <option <?= (string) ($registroFormulario['perfil'] ?? '') === 'Administrador' ? 'selected' : '' ?>>Administrador</option>
                    <option <?= (string) ($registroFormulario['perfil'] ?? '') === 'Editor' ? 'selected' : '' ?>>Editor</option>
                    <option <?= (string) ($registroFormulario['perfil'] ?? '') === 'Moderador' ? 'selected' : '' ?>>Moderador</option>
                </select>
            </div>
            <div class="field-password">
                <label for="password">Contraseña (opcional)</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    minlength="8"
                    aria-describedby="password-help" />
                <small id="password-help" class="muted">
                    Mínimo 8 caracteres. Dejá vacío para conservar la contraseña de
                    ejemplo.
                </small>
            </div>
        </div>
        <div class="form-feedback" aria-live="polite"></div>
        <div class="form-actions">
            <a class="button outline" href="panel-usuarios.php"> Cancelar </a>
            <button class="button primary" type="submit">Guardar usuario</button>
        </div>
    </form>
</main>
<?php require_once __DIR__ . "/../layouts/footer.php"; ?>
