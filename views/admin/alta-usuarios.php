<?php
require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<link rel="stylesheet" href="../../assets/css/alta-usuarios.css">

<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="/views/admin/panel-inicio.php">Panel</a>
        <span>/</span>
        <a href="/views/admin/panel-usuarios.php">Usuarios</a>
        <span>/</span>
        <span>Nuevo registro</span>
    </nav>
    <div class="page-heading">
        <h1>Nuevo usuario</h1>
        <p class="muted">
            Completá los campos. Los datos se usan solamente como demostración.
        </p>
    </div>
    <form class="surface admin-form" data-demo-form="admin">
        <div class="form-grid">
            <div class="span-all">
                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" required maxlength="120" value="" />
            </div>
            <div>
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
            <div>
                <label for="perfil">Perfil</label>
                <select id="perfil" name="perfil" required>
                    <option value="">Seleccioná un perfil</option>
                    <option>Administrador</option>
                    <option>Editor</option>
                    <option>Moderador</option>
                </select>
            </div>
            <div class="span-all">
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
            <a class="button outline" href="/views/admin/panel-usuarios.php"> Cancelar </a>
            <button class="button primary" type="submit">Guardar usuario</button>
        </div>
    </form>
</main>