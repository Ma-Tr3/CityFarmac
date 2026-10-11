<?php

declare(strict_types=1);

$datos = require __DIR__ . '/../../data/admin.php';

function escapar($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$css = '<link rel="stylesheet" href="../../assets/css/panel-productos.css">';

require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="panel-inicio.php">Panel</a>
        <span>/</span>
        <span>Productos</span>
    </nav>
    <div class="section-heading">
        <div>
            <h1>Productos</h1>
            <p class="muted">Gestioná productos y su disponibilidad.</p>
        </div>
        <a class="button primary" href="alta-productos.php"> + Nuevo registro </a>
    </div>
    <div id="admin-feedback" class="form-feedback" aria-live="polite"></div>
    <div class="table-filters">
        <div>
            <label for="filter-category">Categoría</label>
            <select id="filter-category" data-filter-category>
                <option value="">Todas las categorías</option>
                <?php foreach ($datos['categorias'] as $opcion): ?>
                    <?php if (!isset($opcion['padre_id'])): ?>
                        <option value="<?= escapar($opcion['id']) ?>"><?= escapar($opcion['nombre']) ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="filter-subcategory">Subcategoría</label>
            <select id="filter-subcategory" data-filter-subcategory>
                <option value="">Todas las subcategorías</option>
                <?php foreach ($datos['categorias'] as $opcion): ?>
                    <?php if (isset($opcion['padre_id'])): ?>
                        <option value="<?= escapar($opcion['id']) ?>" data-parent="<?= escapar($opcion['padre_id']) ?>"><?= escapar($opcion['nombre']) ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
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
                <?php foreach ($datos['productos'] as $registro): ?>
                    <tr data-record data-state="<?= escapar($registro['estado']) ?>" data-category="<?= escapar($registro['categoria_id']) ?>" data-subcategory="<?= escapar($registro['subcategoria_id']) ?>">
                        <td>
                            <div class="table-product"><img src="../../assets/img/products/<?= escapar($registro['imagen']) ?>" alt="" width="36" height="44"><span><?= escapar($registro['nombre']) ?><?php if ($registro['destacado']): ?><small class="muted">Destacado</small><?php endif; ?></span></div>
                        </td>
                        <td><?= escapar($registro['marca']) ?></td>
                        <td class="nowrap">$ <?= number_format($registro['precio'], 0, ',', '.') ?></td>
                        <td><?= escapar($registro['categoria']) ?><small class="muted"><?= escapar($registro['subcategoria']) ?></small></td>
                        <td><span class="badge <?= $registro['estado'] ? 'state-active' : 'state-inactive' ?>" data-state-badge><?= $registro['estado'] ? 'Activo' : 'Inactivo' ?></span></td>
                        <td>
                            <div class="row-actions"><a href="editar-productos.php?id=<?= escapar($registro['id']) ?>">Modificar<span class="sr-only"> <?= escapar($registro['nombre']) ?></span></a>
                                <button type="button" class="text-button" data-toggle-state data-comments="0"><?= $registro['estado'] ? 'Inactivar' : 'Activar' ?></button>
                                <a href="panel-comentarios.php?producto=<?= escapar($registro['id']) ?>">Ver comentarios</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr data-empty-row <?= count($datos['productos']) > 0 ? 'hidden' : '' ?>>
                    <td colspan="6" class="table-empty">No hay registros para mostrar.</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>