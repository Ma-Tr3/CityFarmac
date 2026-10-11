<?php

declare(strict_types=1);

$datos = require __DIR__ . '/../../data/admin.php';

function escapar($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$css = '<link rel="stylesheet" href="../../assets/css/panel-usuarios.css">';

require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>


<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="/CityFarmac/views/admin/panel-inicio.php">Panel</a>
        <span>/</span>
        <span>Usuarios</span>
    </nav>
    <div class="section-heading">
        <div>
            <h1>Usuarios</h1>
            <p class="muted">Gestioná usuarios y su disponibilidad.</p>
        </div>
        <a class="button primary" href="/CityFarmac/views/admin/alta-usuarios.php"> + Nuevo registro </a>
    </div>
    <div id="admin-feedback" class="form-feedback" aria-live="polite"></div>
    <div
        class="table-wrap"
        tabindex="0"
        role="region"
        aria-label="Tabla de usuarios (desplazable)">
        <table>
            <caption class="sr-only">
                Listado de usuarios
            </caption>
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Perfil</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos['usuarios'] as $registro): ?>
                <tr data-record data-state="<?= escapar($registro['estado']) ?>">
                    <td><?= escapar($registro['nombre']) ?></td>
                    <td><?= escapar($registro['email']) ?></td>
                    <td><?= escapar($registro['perfil']) ?></td>
                    <td><span class="badge <?= $registro['estado'] ? 'state-active' : 'state-inactive' ?>" data-state-badge><?= $registro['estado'] ? 'Activo' : 'Inactivo' ?></span></td>
                    <td><div class="row-actions"><a href="editar-usuarios.php?id=<?= escapar($registro['id']) ?>">Modificar<span class="sr-only"> <?= escapar($registro['nombre']) ?></span></a>
                            <button type="button" class="text-button" data-toggle-state data-comments="0"><?= $registro['estado'] ? 'Inactivar' : 'Activar' ?></button></div></td>
                </tr>
                <?php endforeach; ?>
                <tr data-empty-row <?= count($datos['usuarios']) > 0 ? 'hidden' : '' ?>><td colspan="5" class="table-empty">No hay registros para mostrar.</td></tr>
            </tbody>
        </table>
    </div>
</main>