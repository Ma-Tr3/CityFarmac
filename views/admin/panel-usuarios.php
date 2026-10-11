<?php
declare(strict_types=1);

$datos = require_once __DIR__ . '/../../data/admin.php';

function escapar($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$css = '<link rel="stylesheet" href="../../assets/css/panel-usuarios.css">';

require_once __DIR__ . '/../layouts/head.php';
require_once __DIR__ . '/../partials/sidebar.php';
?>

<<<<<<< HEAD
<link rel="stylesheet" href="../../assets/css/panel-usuarios.css">

<main id="contenido" class="admin-main admin-panel-usuarios">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="panel-inicio.php">Panel</a>
=======
<main id="contenido" class="admin-main">
    <nav class="breadcrumb" aria-label="Ubicación">
        <a href="/CityFarmac/views/admin/panel-inicio.php">Panel</a>
>>>>>>> d766bb0 (Maquetado y estilos del panel de administración arreglos de codigo)
        <span>/</span>
        <span>Usuarios</span>
    </nav>
    <div class="section-heading">
        <div>
            <h1>Usuarios</h1>
            <p class="muted">Gestioná usuarios y su disponibilidad.</p>
        </div>
<<<<<<< HEAD
        <a class="button primary" href="formulario-usuarios.php"> + Nuevo registro </a>
=======
        <a class="button primary" href="/CityFarmac/views/admin/alta-usuarios.php"> + Nuevo registro </a>
>>>>>>> d766bb0 (Maquetado y estilos del panel de administración arreglos de codigo)
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
<<<<<<< HEAD
                <tr data-record data-state="1">
                    <td>Marcelo Tremari</td>
                    <td>marcelo@ejemplo.com</td>
                    <td>Administrador</td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="formulario-usuarios.php?id=1">
                                Modificar
                                <span class="sr-only">Marcelo Tremari</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Inactivar
                            </button>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="1">
                    <td>Lucía Pérez</td>
                    <td>lucia@ejemplo.com</td>
                    <td>Editor</td>
                    <td>
                        <span class="badge state-active" data-state-badge> Activo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="formulario-usuarios.php?id=2">
                                Modificar
                                <span class="sr-only">Lucía Pérez</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Inactivar
                            </button>
                        </div>
                    </td>
                </tr>
                <tr data-record data-state="0">
                    <td>Martín Rojas</td>
                    <td>martin@ejemplo.com</td>
                    <td>Moderador</td>
                    <td>
                        <span class="badge state-inactive" data-state-badge>
                            Inactivo</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="formulario-usuarios.php?id=3">
                                Modificar
                                <span class="sr-only">Martín Rojas</span>
                            </a>
                            <button
                                type="button"
                                class="text-button"
                                data-toggle-state
                                data-comments="0">
                                Activar
                            </button>
                        </div>
                    </td>
                </tr>
=======
                <?php foreach ($datos['usuarios'] as $registro): ?>
                    <tr data-record data-state="<?= escapar($registro['estado']) ?>">
                        <td><?= escapar($registro['nombre']) ?></td>
                        <td><?= escapar($registro['email']) ?></td>
                        <td><?= escapar($registro['perfil']) ?></td>
                        <td><span class="badge <?= $registro['estado'] ? 'state-active' : 'state-inactive' ?>" data-state-badge><?= $registro['estado'] ? 'Activo' : 'Inactivo' ?></span></td>
                        <td>
                            <div class="row-actions"><a href="editar-usuarios.php?id=<?= escapar($registro['id']) ?>">Modificar<span class="sr-only"> <?= escapar($registro['nombre']) ?></span></a>
                                <button type="button" class="text-button" data-toggle-state data-comments="0"><?= $registro['estado'] ? 'Inactivar' : 'Activar' ?></button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
>>>>>>> d766bb0 (Maquetado y estilos del panel de administración arreglos de codigo)
                <tr data-empty-row hidden>
                    <td colspan="5" class="table-empty">No hay registros para mostrar.</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>