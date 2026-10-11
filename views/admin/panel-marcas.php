<?php
require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>
<link rel="stylesheet" href="../../assets/css/panel-marcas.css">
<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="/views/admin/panel-inicio.php">Panel</a>
        <span>/</span>
        <span>Marcas</span>
    </nav>
    <div class="section-heading">
        <div>
            <h1>Marcas</h1>
            <p class="muted">Gestioná marcas y su disponibilidad.</p>
        </div>
        <a class="button primary" href="/views/admin/alta-marcas.php"> + Nuevo registro </a>
    </div>
    <div id="admin-feedback" class="form-feedback" aria-live="polite"></div>
    <div
        class="table-wrap"
        tabindex="0"
        role="region"
        aria-label="Tabla de marcas (desplazable)">
        <table>
            <caption class="sr-only">
                Listado de marcas
            </caption>
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr data-record data-state="1">
                    <td>Dermacare</td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-marcas.php">
                                Modificar
                                <span class="sr-only">Dermacare</span>
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
                    <td>Hydra Lab</td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-marcas-2.php">
                                Modificar
                                <span class="sr-only">Hydra Lab</span>
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
                    <td>Botánica</td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-marcas-3.php">
                                Modificar
                                <span class="sr-only">Botánica</span>
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
                    <td>Aura</td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-marcas-4.php">
                                Modificar
                                <span class="sr-only">Aura</span>
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
                    <td colspan="3" class="table-empty">
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