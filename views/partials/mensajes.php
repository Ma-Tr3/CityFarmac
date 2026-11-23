<?php
    $mensajeError = $GLOBALS['errorFormulario'] ?? ($_SESSION['mensaje_error'] ?? '');

    $mensajeExito = isset($_GET['guardado']) && $_GET['guardado'] === '1' ? 'Registro guardado correctamente' : ($_SESSION['mensaje_exito'] ?? '');

    unset($_SESSION['mensaje_error'], $_SESSION['mensaje_exito']);
?>

<?php if ($mensajeError !== ''): ?>
    <div class="admin-mensaje admin-mensaje--error" role="alert">
        <?= escaparDato($mensajeError) ?>
    </div>
<?php endif; ?>

<?php if ($mensajeExito !== ''): ?>
    <div class="admin-mensaje admin-mensaje--exito" role="status">
        <?= escaparDato($mensajeExito) ?>
    </div>
<?php endif; ?>