<?php
$css = '<link rel="stylesheet" href="../../assets/css/admin-formularios.css">
<link rel="stylesheet" href="../../assets/css/header-footer.css">';
require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main id="contenido" class="admin-main admin-form-page">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="panel-inicio.php">Panel</a>
        <span>/</span>
        <a href="panel-usuarios.php">Usuarios</a>
        <span>/</span>
        <span>Nuevo registro</span>
    </nav>
    <div class="page-heading">
        <h1>Nuevo usuario</h1>
        <p class="muted">
            Completá los campos. Los datos se usan solamente como demostración.
        </p>
    </div>
    <form class="surface admin-form admin-form--usuarios" data-demo-form="admin">
        <div class="form-grid">
            <div class="field-nombre">
                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" required maxlength="120" value="" />
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
                    value="" />
            </div>
            <div class="field-perfil">
                <label for="perfil">Perfil</label>
                <select id="perfil" name="perfil" required>
                    <option value="">Seleccioná un perfil</option>
                    <option>Administrador</option>
                    <option>Editor</option>
                    <option>Moderador</option>
                </select>
            </div>
            <div class="field-password">
                <label for="password">Contraseña </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    minlength="8"
                    required
                    aria-describedby="password-help" />
                <small id="password-help" class="muted">
                    Mínimo 8 caracteres. Usá una contraseña ficticia para la demo.
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
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>