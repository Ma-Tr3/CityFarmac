<?php
require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>
<link rel="stylesheet" href="../../assets/css/panel-productos.css">
<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="/views/admin/panel-inicio.php">Panel</a>
        <span>/</span>
        <span>Productos</span>
    </nav>
    <div class="section-heading">
        <div>
            <h1>Productos</h1>
            <p class="muted">Gestioná productos y su disponibilidad.</p>
        </div>
        <a class="button primary" href="/views/admin/alta-productos.php"> + Nuevo registro </a>
    </div>
    <div id="admin-feedback" class="form-feedback" aria-live="polite"></div>
    <div class="table-filters">
        <div>
            <label for="filter-category">Categoría</label>
            <select id="filter-category" data-filter-category>
                <option value="">Todas las categorías</option>
                <option value="1">Dermocosmética</option>
                <option value="2">Cuidado personal</option>
                <option value="3">Perfumería</option>
            </select>
        </div>
        <div>
            <label for="filter-subcategory">Subcategoría</label>
            <select id="filter-subcategory" data-filter-subcategory>
                <option value="">Todas las subcategorías</option>
                <option value="11" data-parent="1">Protección solar</option>
                <option value="12" data-parent="1">Cuidado facial</option>
                <option value="21" data-parent="2">Cabello</option>
                <option value="22" data-parent="2">Cuerpo</option>
                <option value="31" data-parent="3">Fragancias</option>
            </select>
        </div>
    </div>
    <div
        class="table-wrap"
        tabindex="0"
        role="region"
        aria-label="Tabla de productos (desplazable)">
        <table>
            <caption class="sr-only">
                Listado de productos
            </caption>
            <thead>
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr data-record data-state="1" data-category="1" data-subcategory="11">
                    <td>
                        <div class="table-product">
                            <img
                                src="../../assets/img/products/solar.svg"
                                alt=""
                                width="36"
                                height="44" />
                            <span>
                                Protector solar FPS 50
                                <small class="muted">Destacado</small>
                            </span>
                        </div>
                    </td>
                    <td>Dermacare</td>
                    <td class="nowrap">$ 18.900</td>
                    <td>
                        Dermocosmética <small class="muted">Protección solar</small>
                    </td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-productos.php">
                                Modificar
                                <span class="sr-only">Protector solar FPS 50</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Inactivar
                            </button>
                            <a href="/views/admin/comentarios-producto-1.php">Ver comentarios</a>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="1" data-category="1" data-subcategory="12">
                    <td>
                        <div class="table-product">
                            <img
                                src="/assets/img/products/crema.svg"
                                alt=""
                                width="36"
                                height="44" />
                            <span>
                                Crema hidratante facial
                                <small class="muted">Destacado</small>
                            </span>
                        </div>
                    </td>
                    <td>Hydra Lab</td>
                    <td class="nowrap">$ 12.400</td>
                    <td>Dermocosmética <small class="muted">Cuidado facial</small></td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-productos-2.php">
                                Modificar
                                <span class="sr-only">Crema hidratante facial</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Inactivar
                            </button>
                            <a href="/views/admin/comentarios-producto-2.php">Ver comentarios</a>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="1" data-category="1" data-subcategory="12">
                    <td>
                        <div class="table-product">
                            <img
                                src="/assets/img/products/gel.svg"
                                alt=""
                                width="36"
                                height="44" />
                            <span>
                                Gel de limpieza suave
                                <small class="muted">Destacado</small>
                            </span>
                        </div>
                    </td>
                    <td>Dermacare</td>
                    <td class="nowrap">$ 9.800</td>
                    <td>Dermocosmética <small class="muted">Cuidado facial</small></td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-productos-3.php">
                                Modificar
                                <span class="sr-only">Gel de limpieza suave</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Inactivar
                            </button>
                            <a href="/views/admin/comentarios-producto-3.php">Ver comentarios</a>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="1" data-category="2" data-subcategory="21">
                    <td>
                        <div class="table-product">
                            <img
                                src="/assets/img/products/shampoo.svg"
                                alt=""
                                width="36"
                                height="44" />
                            <span>
                                Shampoo reparación
                                <small class="muted">Destacado</small>
                            </span>
                        </div>
                    </td>
                    <td>Botánica</td>
                    <td class="nowrap">$ 7.600</td>
                    <td>Cuidado personal <small class="muted">Cabello</small></td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-productos-4.php">
                                Modificar
                                <span class="sr-only">Shampoo reparación</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Inactivar
                            </button>
                            <a href="/views/admin/comentarios-producto-4.php">Ver comentarios</a>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="1" data-category="3" data-subcategory="31">
                    <td>
                        <div class="table-product">
                            <img
                                src="/assets/img/products/perfume.svg"
                                alt=""
                                width="36"
                                height="44" />
                            <span>
                                Perfume floral 50 ml
                                <small class="muted">Destacado</small>
                            </span>
                        </div>
                    </td>
                    <td>Aura</td>
                    <td class="nowrap">$ 32.500</td>
                    <td>Perfumería <small class="muted">Fragancias</small></td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-productos-5.php">
                                Modificar
                                <span class="sr-only">Perfume floral 50 ml</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Inactivar
                            </button>
                            <a href="/views/admin/comentarios-producto-5.php">Ver comentarios</a>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="1" data-category="2" data-subcategory="22">
                    <td>
                        <div class="table-product">
                            <img
                                src="/assets/img/products/locion.svg"
                                alt=""
                                width="36"
                                height="44" />
                            <span>
                                Loción corporal <small class="muted">Destacado</small>
                            </span>
                        </div>
                    </td>
                    <td>Hydra Lab</td>
                    <td class="nowrap">$ 11.200</td>
                    <td>Cuidado personal <small class="muted">Cuerpo</small></td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-productos-6.php">
                                Modificar
                                <span class="sr-only">Loción corporal</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Inactivar
                            </button>
                            <a href="/views/admin/comentarios-producto-6.php">Ver comentarios</a>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="0" data-category="2" data-subcategory="21">
                    <td>
                        <div class="table-product">
                            <img
                                src="/assets/img/products/shampoo.svg"
                                alt=""
                                width="36"
                                height="44" />
                            <span> Acondicionador nutritivo </span>
                        </div>
                    </td>
                    <td>Botánica</td>
                    <td class="nowrap">$ 8.100</td>
                    <td>Cuidado personal <small class="muted">Cabello</small></td>
                    <td>
                        <span class="badge state-inactive" data-state-badge>
                            Inactivo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="/views/admin/editar-productos-7.php">
                                Modificar
                                <span class="sr-only">Acondicionador nutritivo</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Activar
                            </button>
                            <a href="/views/admin/comentarios-producto-7.php">Ver comentarios</a>
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
</main>