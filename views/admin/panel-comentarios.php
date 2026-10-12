<?php

declare(strict_types=1);
require_once __DIR__ . '/../../data/sesion.php';
exigirPanel('comentarios');


require_once __DIR__ . '/../../data/formulario.php';
$datos = require __DIR__ . '/../../data/admin.php';

function escapar($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$datos['comentarios'] = buscarArray($datos['comentarios'], (string)($_GET['q'] ?? ''));
require_once __DIR__ . '/../layouts/rutas.php';
$css = '<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/panel-comentarios.css') . '">
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/header-footer.css') . '">';

$filtro = filter_input(INPUT_GET, 'producto', FILTER_VALIDATE_INT);
if ($filtro) {
    $datos['comentarios'] = array_values(array_filter(
        $datos['comentarios'],
        fn($registro) => ($registro['producto_id'] ?? null) === $filtro
    ));
}

require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../layouts/header.php';
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
    <div id="admin-feedback" class="form-feedback" aria-live="polite"><?php if (isset($_GET['guardado'])): ?>Registro guardado correctamente.<?php endif; ?></div>
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
    <form method="get" class="table-filters"><label>Buscar <input name="q" value="<?= escaparDato($_GET['q'] ?? '') ?>" placeholder="Nombre, ID u otro dato"></label><button class="button primary">Buscar</button></form>
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
                <?php foreach ($datos['comentarios'] as $registro): ?>
                    <tr data-record data-state="<?= escapar($registro['estado']) ?>">
                        <td class="comment-cell"><?= escapar($registro['comentario']) ?><small class="muted"><?= escapar($registro['email']) ?></small></td>
                        <td class="nowrap"><span class="rating" aria-label="<?= escapar($registro['ranking']) ?> de 5"><?= str_repeat('★', $registro['ranking']) . str_repeat('☆', 5 - $registro['ranking']) ?></span></td>
                        <td class="nowrap"><?= escapar($registro['fecha']) ?></td>
                        <td><?= escapar($registro['producto']) ?></td>
                        <td><span class="badge <?= $registro['estado'] ? 'state-active' : 'state-inactive' ?>" data-state-badge><?= $registro['estado'] ? 'Activo' : 'Inactivo' ?></span></td>
                        <td>
                            <div class="row-actions">
                                <form method="post" action="<?= rutaCityFarmac('views/admin/estado.php') ?>" style="display:inline"><?= camposFormulario() ?><input type="hidden" name="entidad" value="comentarios"><input type="hidden" name="id" value="<?= escaparDato($registro['id']) ?>"><button class="text-button"><?= $registro['estado'] ? 'Inactivar' : 'Activar' ?></button></form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr data-empty-row <?= count($datos['comentarios']) > 0 ? 'hidden' : '' ?>>
                    <td colspan="6" class="table-empty">No hay registros para mostrar.</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>
<script src="<?= rutaCityFarmac('assets/js/formulario.js') ?>" defer></script>