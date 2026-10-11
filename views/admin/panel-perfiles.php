<?php
require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<link rel="stylesheet" href="../../assets/css/panel-perfiles.css">

<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="/views/admin/panel-inicio.php">Panel</a>
        <span>/</span>
        <span>Perfiles</span>
    </nav>
    <div class="section-heading">
        <div>
            <h1>Perfiles</h1>
            <p class="muted">Gestioná perfiles y su disponibilidad.</p>
        </div>
        <a class="button primary" href="/views/admin/alta-perfiles.php"> + Nuevo registro </a>
    </div>
    <div id="admin-feedback" class="form-feedback" aria-live="polite"></div>
    <div
        class="table-wrap"
        tabindex="0"
        role="region"
        aria-label="Tabla de perfiles (desplazable)">
        <table>
            <caption class="sr-only">
                Listado de perfiles
            </caption>
            <thead>
                <tr>
                    <th scope="col">Perfil</th>
                    <th scope="col">Secciones permitidas</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr data-record data-state="1">
                    <td>Administrador</td>
                    <td>
                        Productos, Categorías, Marcas, Comentarios, Usuarios, Perfiles
                    </td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-perfiles.php">
                                Modificar
                                <span class="sr-only">Administrador</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Inactivar
                            </button>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="1">
                    <td>Editor</td>
                    <td>Productos, Categorías, Marcas</td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-perfiles-2.php">
                                Modificar
                                <span class="sr-only">Editor</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Inactivar
                            </button>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="1">
                    <td>Moderador</td>
                    <td>Comentarios</td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-perfiles-3.php">
                                Modificar
                                <span class="sr-only">Moderador</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Inactivar
                            </button>
                        </div>
                    </td>
                </tr>
                <tr data-empty-row hidden>
                    <td colspan="4" class="table-empty">
                        No hay registros para mostrar.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="muted small table-help">
        Las acciones son simuladas. En pantallas pequeñas podés deslizar la tabla para
        ver todas las columnas.
    </p>
</main>