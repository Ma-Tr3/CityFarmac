<?php

declare(strict_types=1);

require_once __DIR__ . '/../../data/sesion.php';
exigirPanel('categorias');

require_once __DIR__ . '/../../controladores/catalogo.php';
require_once __DIR__ . '/../layouts/rutas.php';

$busqueda = $_GET['q'] ?? '';
$busqueda = is_string($busqueda) ? $busqueda : '';

$filtro = filter_input(INPUT_GET, 'padre', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1],
]);

$categorias = buscarArray(listarCatalogo('categorias'), $busqueda);
$categorias = array_filter($categorias, function (array $categoria) use ($filtro): bool {
    return $filtro
        ? (int) $categoria['padre_id'] === $filtro
        : $categoria['padre_id'] === null;
});

$urlAlta = rutaCityFarmac('views/admin/alta-categorias.php');
if ($filtro) {
    $urlAlta .= '?padre=' . $filtro;
}

$css = '<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/panel-categorias.css') . '">
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/header-footer.css') . '">';

require_once __DIR__ . '/../layouts/admin-head.php';
require_once __DIR__ . '/../layouts/admin-header.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="<?= rutaCityFarmac('views/admin/panel-inicio.php') ?>">Panel</a>
        <span>/</span>
        <?php if ($filtro): ?>
            <a href="<?= rutaCityFarmac('views/admin/panel-categorias.php') ?>">Categorías</a>
            <span>/</span>
            <span>Subcategorías</span>
        <?php else: ?>
            <span>Categorías</span>
        <?php endif; ?>
    </nav>

    <div class="section-heading">
        <div>
            <h1><?= $filtro ? 'Subcategorías' : 'Categorías' ?></h1>
            <p class="muted">Gestioná categorías y su disponibilidad.</p>
        </div>
        <a class="button primary" href="<?= $urlAlta ?>">+ Nuevo registro</a>
    </div>

    <?php require_once __DIR__ . '/../partials/mensajes.php'; ?>

    <form method="get" class="table-filters">
        <?php if ($filtro): ?>
            <input type="hidden" name="padre" value="<?= $filtro ?>">
        <?php endif; ?>

        <label>Buscar
            <input name="q" value="<?= escaparDato($busqueda) ?>" placeholder="Nombre, ID u otro dato">
        </label>
        <button class="button primary" type="submit">Buscar</button>
    </form>

    <div class="table-wrap" tabindex="0" role="region" aria-label="Tabla de categorías (desplazable)">
        <table>
            <caption class="sr-only">Listado de categorías</caption>
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Categoría padre</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $registro): ?>
                    <tr data-record data-state="<?= (int) $registro['estado'] ?>">
                        <td><?= escaparDato($registro['nombre']) ?></td>
                        <td><?= escaparDato($registro['padre']) ?></td>
                        <td>
                            <span class="badge <?= $registro['estado'] ? 'state-active' : 'state-inactive' ?>" data-state-badge>
                                <?= $registro['estado'] ? 'Activo' : 'Inactivo' ?>
                            </span>
                        </td>
                        <td>
                            <div class="row-actions">
                                <a href="<?= rutaCityFarmac('views/admin/editar-categorias.php') ?>?id=<?= (int) $registro['id'] ?>">
                                    Modificar<span class="sr-only"> <?= escaparDato($registro['nombre']) ?></span>
                                </a>
                                <form method="post" action="<?= rutaCityFarmac('views/admin/estado.php') ?>" style="display:inline">
                                    <?= camposFormulario() ?>
                                    <input type="hidden" name="entidad" value="categorias">
                                    <input type="hidden" name="id" value="<?= (int) $registro['id'] ?>">
                                    <?php if ($filtro): ?>
                                        <input type="hidden" name="padre" value="<?= $filtro ?>">
                                    <?php endif; ?>
                                    <button class="text-button" type="submit">
                                        <?= $registro['estado'] ? 'Inactivar' : 'Activar' ?>
                                    </button>
                                </form>
                                <?php if ($registro['padre_id'] === null): ?>
                                    <a href="<?= rutaCityFarmac('views/admin/panel-categorias.php') ?>?padre=<?= (int) $registro['id'] ?>">
                                        Ver subcategorías
                                    </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <tr data-empty-row <?= $categorias ? 'hidden' : '' ?>>
                    <td colspan="4" class="table-empty">No hay registros para mostrar.</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
<script src="<?= rutaCityFarmac('assets/js/formulario.js') ?>" defer></script>
</body>
</html>