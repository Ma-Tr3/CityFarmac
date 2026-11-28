<?php

declare(strict_types=1);

require_once __DIR__ . '/../../data/sesion.php';
exigirPanel('productos');

require_once __DIR__ . '/../../controladores/catalogo.php';
require_once __DIR__ . '/../layouts/rutas.php';

$busqueda = $_GET['q'] ?? '';
$busqueda = is_string($busqueda) ? $busqueda : '';

$productos = buscarArray(listarCatalogo('productos'), $busqueda);
$categorias = listarCatalogo('categorias');

$css = '<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/panel-productos.css') . '">
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/header-footer.css') . '">';

require_once __DIR__ . '/../layouts/admin-head.php';
require_once __DIR__ . '/../layouts/admin-header.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="<?= rutaCityFarmac('views/admin/panel-inicio.php') ?>">Panel</a>
        <span>/</span>
        <span>Productos</span>
    </nav>

    <div class="section-heading">
        <div>
            <h1>Productos</h1>
            <p class="muted">Gestioná productos y su disponibilidad.</p>
        </div>
        <a class="button primary" href="<?= rutaCityFarmac('views/admin/alta-productos.php') ?>">+ Nuevo registro</a>
    </div>

    <?php require_once __DIR__ . '/../partials/mensajes.php'; ?>

    <div class="table-filters">
        <div>
            <label for="filter-category">Categoría</label>
            <select id="filter-category" data-filter-category>
                <option value="">Todas las categorías</option>
                <?php foreach ($categorias as $opcion): ?>
                    <?php if ($opcion['padre_id'] === null): ?>
                        <option value="<?= (int) $opcion['id'] ?>"><?= escaparDato($opcion['nombre']) ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="filter-subcategory">Subcategoría</label>
            <select id="filter-subcategory" data-filter-subcategory>
                <option value="">Todas las subcategorías</option>
                <?php foreach ($categorias as $opcion): ?>
                    <?php if ($opcion['padre_id'] !== null): ?>
                        <option value="<?= (int) $opcion['id'] ?>" data-parent="<?= (int) $opcion['padre_id'] ?>">
                            <?= escaparDato($opcion['nombre']) ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <form method="get" class="table-filters">
        <label>Buscar
            <input name="q" value="<?= escaparDato($busqueda) ?>" placeholder="Nombre, ID u otro dato">
        </label>
        <button class="button primary" type="submit">Buscar</button>
    </form>

    <div class="table-wrap" tabindex="0" role="region" aria-label="Tabla de productos (desplazable)">
        <table>
            <caption class="sr-only">Listado de productos</caption>
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
                <?php foreach ($productos as $registro): ?>
                    <tr data-record
                        data-state="<?= (int) $registro['estado'] ?>"
                        data-category="<?= (int) $registro['categoria_id'] ?>"
                        data-subcategory="<?= escaparDato($registro['subcategoria_id'] ?? '') ?>">
                        <td>
                            <div class="table-product">
                                <img src="<?= rutaCityFarmac(($registro['imagen'] ?? '') ?: 'assets/img/products/solar.svg') ?>"
                                    alt="" width="36" height="44">
                                <span>
                                    <?= escaparDato($registro['nombre']) ?>
                                    <?php if ($registro['destacado']): ?>
                                        <small class="muted">Destacado</small>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </td>
                        <td><?= escaparDato($registro['marca']) ?></td>
                        <td class="nowrap">$ <?= number_format((float) $registro['precio'], 2, ',', '.') ?></td>
                        <td>
                            <?= escaparDato($registro['categoria']) ?>
                            <small class="muted"><?= escaparDato($registro['subcategoria']) ?></small>
                        </td>
                        <td>
                            <span class="badge <?= $registro['estado'] ? 'state-active' : 'state-inactive' ?>" data-state-badge>
                                <?= $registro['estado'] ? 'Activo' : 'Inactivo' ?>
                            </span>
                        </td>
                        <td>
                            <div class="row-actions">
                                <a href="<?= rutaCityFarmac('views/admin/editar-productos.php') ?>?id=<?= (int) $registro['id'] ?>">
                                    Modificar<span class="sr-only"> <?= escaparDato($registro['nombre']) ?></span>
                                </a>
                                <form method="post" action="<?= rutaCityFarmac('views/admin/estado.php') ?>" style="display:inline">
                                    <?= camposFormulario() ?>
                                    <input type="hidden" name="entidad" value="productos">
                                    <input type="hidden" name="id" value="<?= (int) $registro['id'] ?>">
                                    <button class="text-button" type="submit">
                                        <?= $registro['estado'] ? 'Inactivar' : 'Activar' ?>
                                    </button>
                                </form>
                                <a href="<?= rutaCityFarmac('views/admin/panel-comentarios.php') ?>?producto=<?= (int) $registro['id'] ?>">
                                    Ver comentarios
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <tr data-empty-row <?= $productos ? 'hidden' : '' ?>>
                    <td colspan="6" class="table-empty">No hay registros para mostrar.</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
<script src="<?= rutaCityFarmac('assets/js/formulario.js') ?>" defer></script>
</body>
</html>