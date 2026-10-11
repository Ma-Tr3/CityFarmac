<?php

declare(strict_types=1);

$datos = require __DIR__ . '/../../data/admin.php';

function escapar($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$css = '<link rel="stylesheet" href="../../assets/css/panel-categorias.css">
<link rel="stylesheet" href="../../assets/css/header-footer.css">';

$filtro = filter_input(INPUT_GET, 'padre', FILTER_VALIDATE_INT);
if ($filtro) {
    $datos['categorias'] = array_values(array_filter(
        $datos['categorias'],
        fn($registro) => ($registro['padre_id'] ?? null) === $filtro
    ));
}

require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="panel-inicio.php">Panel</a>
        <span>/</span>
        <span>Categorías</span>
    </nav>
    <div class="section-heading">
        <div>
            <h1>Categorías</h1>
            <p class="muted">Gestioná categorías y su disponibilidad.</p>
        </div>
        <a class="button primary" href="alta-categorias.php"> + Nuevo registro </a>
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
                <?php foreach ($datos['categorias'] as $registro): ?>
                    <tr data-record data-state="<?= escapar($registro['estado']) ?>">
                        <td><?= escapar($registro['nombre']) ?></td>
                        <td><?= escapar($registro['padre']) ?></td>
                        <td><span class="badge <?= $registro['estado'] ? 'state-active' : 'state-inactive' ?>" data-state-badge><?= $registro['estado'] ? 'Activo' : 'Inactivo' ?></span></td>
                        <td>
                            <div class="row-actions"><a href="editar-categorias.php?id=<?= escapar($registro['id']) ?>">Modificar<span class="sr-only"> <?= escapar($registro['nombre']) ?></span></a>
                                <button type="button" class="text-button" data-toggle-state data-comments="0"><?= $registro['estado'] ? 'Inactivar' : 'Activar' ?></button>
                                <a href="panel-categorias.php?padre=<?= escapar($registro['id']) ?>">Ver subcategorías</a>
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