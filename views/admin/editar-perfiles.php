<?php
require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<link rel="stylesheet" href="../../assets/css/editar-perfiles.css">

<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="/views/admin/panel-inicio.php">Panel</a>
        <span>/</span>
        <a href="/views/admin/panel-perfiles.php">Perfiles</a>
        <span>/</span>
        <span>Modificar</span>
    </nav>
    <div class="page-heading">
        <h1>Modificar perfil</h1>
        <p class="muted">
            Completá los campos. Los datos se usan solamente como demostración.
        </p>
    </div>
    <form class="surface admin-form" data-demo-form="admin">
        <div class="form-grid">
            <div class="span-all">
                <label for="nombre">Nombre</label>
                <input
                    id="nombre"
                    name="nombre"
                    required
                    maxlength="120"
                    value="Administrador" />
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
                            checked />
                        Productos
                    </label>
                    <label class="check" for="permiso-categorias">
                        <input
                            id="permiso-categorias"
                            name="secciones[]"
                            type="checkbox"
                            value="categorias"
                            checked />
                        Categorías
                    </label>
                    <label class="check" for="permiso-marcas">
                        <input
                            id="permiso-marcas"
                            name="secciones[]"
                            type="checkbox"
                            value="marcas"
                            checked />
                        Marcas
                    </label>
                    <label class="check" for="permiso-comentarios">
                        <input
                            id="permiso-comentarios"
                            name="secciones[]"
                            type="checkbox"
                            value="comentarios"
                            checked />
                        Comentarios
                    </label>
                    <label class="check" for="permiso-usuarios">
                        <input
                            id="permiso-usuarios"
                            name="secciones[]"
                            type="checkbox"
                            value="usuarios"
                            checked />
                        Usuarios
                    </label>
                    <label class="check" for="permiso-perfiles">
                        <input
                            id="permiso-perfiles"
                            name="secciones[]"
                            type="checkbox"
                            value="perfiles"
                            checked />
                        Perfiles
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="form-feedback" aria-live="polite"></div>
        <div class="form-actions">
            <a class="button outline" href="/views/admin/panel-perfiles.php"> Cancelar </a>
            <button class="button primary" type="submit">Guardar perfil</button>
        </div>
    </form>
</main>