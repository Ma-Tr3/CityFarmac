<?php

declare(strict_types=1);
require_once __DIR__ . '/../../data/sesion.php';
exigirPanel('categorias');


require_once __DIR__ . '/../../data/formulario.php';
$datos = require __DIR__ . '/../../data/admin.php';

function escapar($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$datos['categorias'] = buscarArray($datos['categorias'], (string)($_GET['q'] ?? ''));
require_once __DIR__ . '/../layouts/rutas.php';
$css = '<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/panel-categorias.css') . '">
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/header-footer.css') . '">';

$filtro = filter_input(INPUT_GET, 'padre', FILTER_VALIDATE_INT);
if ($filtro) {
    $datos['categorias'] = array_values(array_filter(
        $datos['categorias'],
        fn($registro) => ($registro['padre_id'] ?? null) === $filtro
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
        <span>Categorías</span>
    </nav>
    <div class="section-heading">
        <div>
            <h1>Categorías</h1>
            <p class="muted">Gestioná categorías y su disponibilidad.</p>
        </div>
        <a class="button primary" href="<?= rutaCityFarmac('views/admin/alta-categorias.php') ?>"> + Nuevo registro </a>
    </div>
    <div id="admin-feedback" class="form-feedback" aria-live="polite"><?php if (isset($_GET['guardado'])): ?>Registro guardado correctamente.<?php endif; ?></div>
    <form method="get" class="table-filters"><label>Buscar <input name="q" value="<?= escaparDato($_GET['q'] ?? '') ?>" placeholder="Nombre, ID u otro dato"></label><button class="button primary">Buscar</button></form>
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
                <?php foreach ($datos['categorias'] as $registro): ?>
                    <tr data-record data-state="<?= escapar($registro['estado']) ?>">
                        <td><?= escapar($registro['nombre']) ?></td>
                        <td><?= escapar($registro['padre']) ?></td>
                        <td><span class="badge <?= $registro['estado'] ? 'state-active' : 'state-inactive' ?>" data-state-badge><?= $registro['estado'] ? 'Activo' : 'Inactivo' ?></span></td>
                        <td>
                            <div class="row-actions"><a href="<?= rutaCityFarmac('views/admin/editar-categorias.php') ?>?id=<?= escapar($registro['id']) ?>">Modificar<span class="sr-only"> <?= escapar($registro['nombre']) ?></span></a>
                                <form method="post" action="<?= rutaCityFarmac('views/admin/estado.php') ?>" style="display:inline"><?= camposFormulario() ?><input type="hidden" name="entidad" value="categorias"><input type="hidden" name="id" value="<?= escaparDato($registro['id']) ?>"><button class="text-button"><?= $registro['estado'] ? 'Inactivar' : 'Activar' ?></button></form>
                                <a href="<?= rutaCityFarmac('views/admin/panel-categorias.php') ?>?padre=<?= escapar($registro['id']) ?>">Ver subcategorías</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr data-empty-row <?= count($datos['categorias']) > 0 ? 'hidden' : '' ?>>
                    <td colspan="4" class="table-empty">No hay registros para mostrar.</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>
<script src="<?= rutaCityFarmac('assets/js/formulario.js') ?>" defer></script>