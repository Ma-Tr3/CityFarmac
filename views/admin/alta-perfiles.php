<?php
require_once __DIR__ . '/../../data/formulario.php';
procesarFormulario('perfiles');
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
        <a href="<?= rutaCityFarmac('views/admin/panel-perfiles.php') ?>">Perfiles</a>
        <span>/</span>
        <span>Nuevo registro</span>
    </nav>
    <div class="page-heading">
        <h1>Nuevo perfil</h1>
        <p class="muted">
            Completá los campos. Los cambios se guardan al confirmar el formulario.
        </p>
    </div>
    <form class="surface admin-form admin-form--perfiles" method="post" enctype="multipart/form-data">
        <?= camposFormulario() ?>
        <div class="form-grid">
            <div class="field-nombre">
                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" required maxlength="120" value="" />
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
                            value="productos" />
                        Productos
                    </label>
                    <label class="check" for="permiso-categorias">
                        <input
                            id="permiso-categorias"
                            name="secciones[]"
                            type="checkbox"
                            value="categorias" />
                        Categorías
                    </label>
                    <label class="check" for="permiso-marcas">
                        <input
                            id="permiso-marcas"
                            name="secciones[]"
                            type="checkbox"
                            value="marcas" />
                        Marcas
                    </label>
                    <label class="check" for="permiso-comentarios">
                        <input
                            id="permiso-comentarios"
                            name="secciones[]"
                            type="checkbox"
                            value="comentarios" />
                        Comentarios
                    </label>
                    <label class="check" for="permiso-usuarios">
                        <input
                            id="permiso-usuarios"
                            name="secciones[]"
                            type="checkbox"
                            value="usuarios" />
                        Usuarios
                    </label>
                    <label class="check" for="permiso-perfiles">
                        <input
                            id="permiso-perfiles"
                            name="secciones[]"
                            type="checkbox"
                            value="perfiles" />
                        Perfiles
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="form-feedback" aria-live="polite"></div>
        <div class="form-actions">
            <a class="button outline" href="<?= rutaCityFarmac('views/admin/panel-perfiles.php') ?>"> Cancelar </a>
            <button class="button primary" type="submit">Guardar perfil</button>
        </div>
    </form>
</main>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>
<script src="<?= rutaCityFarmac('assets/js/formulario.js') ?>" defer></script>