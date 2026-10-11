<?php
require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>
<link rel="stylesheet" href="../../assets/css/panel-categorias.css">
<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="/views/admin/panel-inicio.php">Panel</a>
        <span>/</span>
        <span>Categorías</span>
    </nav>
    <div class="section-heading">
        <div>
            <h1>Categorías</h1>
            <p class="muted">Gestioná categorías y su disponibilidad.</p>
        </div>
        <a class="button primary" href="/views/admin/alta-categorias.php"> + Nuevo registro </a>
    </div>
    <div id="admin-feedback" class="form-feedback" aria-live="polite"></div>
    <div
        class="table-wrap"
        tabindex="0"
        role="region"
        aria-label="Tabla de categorias (desplazable)">
        <table>
            <caption class="sr-only">
                Listado de categorias
            </caption>
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Categoría padre</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr data-record data-state="1">
                    <td>Dermocosmética</td>
                    <td>Principal</td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-categorias.php">
                                Modificar
                                <span class="sr-only">Dermocosmética</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Inactivar
                            </button>
                            <a href="/views/admin/subcategorias-1.php">Ver subcategorías</a>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="1">
                    <td>Cuidado personal</td>
                    <td>Principal</td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-categorias-2.php">
                                Modificar
                                <span class="sr-only">Cuidado personal</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Inactivar
                            </button>
                            <a href="/views/admin/subcategorias-2.php">Ver subcategorías</a>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="1">
                    <td>Perfumería</td>
                    <td>Principal</td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-categorias-3.php">
                                Modificar
                                <span class="sr-only">Perfumería</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Inactivar
                            </button>
                            <a href="/views/admin/subcategorias-3.php">Ver subcategorías</a>
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