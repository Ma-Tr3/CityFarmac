<?php

declare(strict_types=1);

require_once __DIR__ . '/../../data/sesion.php';
exigirPanel('comentarios');

require_once __DIR__ . '/../../controladores/catalogo.php';
require_once __DIR__ . '/../layouts/rutas.php';

$busqueda = $_GET['q'] ?? '';
$busqueda = is_string($busqueda) ? $busqueda : '';

$estadoFiltro = $_GET['estado'] ?? '';
$estadoFiltro = in_array($estadoFiltro, ['0', '1'], true) ? $estadoFiltro : '';

$filtro = filter_input(INPUT_GET, 'producto', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1],
]);

$comentarios = buscarArray(listarCatalogo('comentarios'), $busqueda);
$comentarios = array_filter($comentarios, function (array $registro) use ($estadoFiltro, $filtro): bool {
    $coincideEstado = $estadoFiltro === '' || (int) $registro['estado'] === (int) $estadoFiltro;
    $coincideProducto = !$filtro || (int) $registro['producto_id'] === $filtro;

    return $coincideEstado && $coincideProducto;
});

$css = '<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/panel-comentarios.css') . '">
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/header-footer.css') . '">';

require_once __DIR__ . '/../layouts/admin-head.php';
require_once __DIR__ . '/../layouts/admin-header.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="<?= rutaCityFarmac('views/admin/panel-inicio.php') ?>">Panel</a>
        <span>/</span>
        <span>Comentarios</span>
    </nav>

    <div class="section-heading">
        <div>
            <h1>Comentarios</h1>
            <p class="muted">Gestioná comentarios y su disponibilidad.</p>
        </div>
    </div>

    <?php require_once __DIR__ . '/../partials/mensajes.php'; ?>

    <form method="get" class="table-filters">
        <?php if ($filtro): ?>
            <input type="hidden" name="producto" value="<?= $filtro ?>">
        <?php endif; ?>

        <div>
            <label for="filter-state">Estado</label>
            <select id="filter-state" name="estado">
                <option value="" <?= $estadoFiltro === '' ? 'selected' : '' ?>>Todos</option>
                <option value="1" <?= $estadoFiltro === '1' ? 'selected' : '' ?>>Aprobados</option>
                <option value="0" <?= $estadoFiltro === '0' ? 'selected' : '' ?>>Pendientes</option>
            </select>
        </div>

        <label for="buscar-comentario">Buscar</label>
        <input id="buscar-comentario" name="q" value="<?= escaparDato($busqueda) ?>"
            placeholder="Comentario, email u otro dato">
        <button class="button primary" type="submit">Filtrar</button>
    </form>

    <div class="table-wrap" tabindex="0" role="region" aria-label="Tabla de comentarios (desplazable)">
        <table>
            <caption class="sr-only">Listado de comentarios</caption>
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
                <?php foreach ($comentarios as $registro): ?>
                    <?php $ranking = max(0, min(5, (int) $registro['ranking'])); ?>
                    <tr data-record data-state="<?= (int) $registro['estado'] ?>">
                        <td class="comment-cell">
                            <?= escaparDato($registro['comentario']) ?>
                            <small class="muted"><?= escaparDato($registro['email']) ?></small>
                        </td>
                        <td class="nowrap">
                            <span class="rating" aria-label="<?= $ranking ?> de 5">
                                <?= str_repeat('★', $ranking) . str_repeat('☆', 5 - $ranking) ?>
                            </span>
                        </td>
                        <td class="nowrap"><?= escaparDato($registro['fecha']) ?></td>
                        <td><?= escaparDato($registro['producto']) ?></td>
                        <td>
                            <span class="badge <?= $registro['estado'] ? 'state-active' : 'state-inactive' ?>" data-state-badge>
                                <?= $registro['estado'] ? 'Aprobado' : 'Pendiente' ?>
                            </span>
                        </td>
                        <td>
                            <div class="row-actions">
                                <form method="post" action="<?= rutaCityFarmac('views/admin/estado.php') ?>" style="display:inline">
                                    <?= camposFormulario() ?>
                                    <input type="hidden" name="entidad" value="comentarios">
                                    <input type="hidden" name="id" value="<?= (int) $registro['id'] ?>">
                                    <?php if ($filtro): ?>
                                        <input type="hidden" name="producto" value="<?= $filtro ?>">
                                    <?php endif; ?>
                                    <button class="text-button" type="submit">
                                        <?= $registro['estado'] ? 'Desaprobar' : 'Aprobar' ?>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <tr data-empty-row <?= $comentarios ? 'hidden' : '' ?>>
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