<?php
require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<link rel="stylesheet" href="../../assets/css/panel-comentarios.css">


<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="/views/admin/panel-inicio.php">Panel</a>
        <span>/</span>
        <span>Comentarios</span>
    </nav>
    <div class="section-heading">
        <div>
            <h1>Comentarios</h1>
            <p class="muted">Gestioná comentarios y su disponibilidad.</p>
        </div>
    </div>
    <div id="admin-feedback" class="form-feedback" aria-live="polite"></div>
    <div class="table-filters">
        <div>
            <label for="filter-state">Estado</label>
            <select id="filter-state" data-filter-state>
                <option value="">Todos</option>
                <option value="1">Activos / aprobados</option>
                <option value="0">Inactivos / pendientes</option>
            </select>
        </div>
    </div>
    <div
        class="table-wrap"
        tabindex="0"
        role="region"
        aria-label="Tabla de comentarios (desplazable)">
        <table>
            <caption class="sr-only">
                Listado de comentarios
            </caption>
            <thead>
                <tr>
                    <th scope="col">Comentario</th>
                    <th scope="col">Ranking</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr data-record data-state="1">
                    <td class="comment-cell">
                        Muy buena textura. Lo incorporé a mi rutina diaria.
                        <small class="muted">lucia@ejemplo.com</small>
                    </td>
                    <td class="nowrap">
                        <span class="rating" aria-label="5 de 5"> ★★★★★ </span>
                    </td>
                    <td class="nowrap">03/10/2026</td>
                    <td>Protector solar FPS 50</td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="1">
                                Desaprobar
                            </button>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="1">
                    <td class="comment-cell">
                        Buen producto, cumple con lo esperado.
                        <small class="muted">martin@ejemplo.com</small>
                    </td>
                    <td class="nowrap">
                        <span class="rating" aria-label="5 de 5"> ★★★★★ </span>
                    </td>
                    <td class="nowrap">04/10/2026</td>
                    <td>Protector solar FPS 50</td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="1">
                                Desaprobar
                            </button>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="1">
                    <td class="comment-cell">
                        Es suave y se absorbe rápido.
                        <small class="muted">ana@ejemplo.com</small>
                    </td>
                    <td class="nowrap">
                        <span class="rating" aria-label="4 de 5"> ★★★★☆ </span>
                    </td>
                    <td class="nowrap">04/10/2026</td>
                    <td>Crema hidratante facial</td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="1">
                                Desaprobar
                            </button>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="0">
                    <td class="comment-cell">
                        Me gustó el aroma, lo volvería a elegir.
                        <small class="muted">pedro@ejemplo.com</small>
                    </td>
                    <td class="nowrap">
                        <span class="rating" aria-label="5 de 5"> ★★★★★ </span>
                    </td>
                    <td class="nowrap">05/10/2026</td>
                    <td>Perfume floral 50 ml</td>
                    <td>
                        <span class="badge state-inactive" data-state-badge>
                            Inactivo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="1">
                                Aprobar
                            </button>
                        </div>
                    </td>
                </tr>
                <tr data-empty-row hidden>
                    <td colspan="6" class="table-empty">
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