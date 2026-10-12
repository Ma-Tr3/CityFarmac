<?php require_once __DIR__ . '/rutas.php';
require_once __DIR__ . '/../../data/sesion.php';
$esAdminCityFarmac = strpos($relativoCityFarmac, '/views/admin/') === 0;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CityFarmac</title>
    <link rel="stylesheet" href="<?= rutaCityFarmac('assets/css/styles.css') ?>">
    <?php
    // Normaliza también los enlaces definidos por cada vista.
    echo preg_replace_callback('~(?:\.\./)+assets/|/CityFarmac/assets/~', function () {
        return rutaCityFarmac('assets/');
    }, $css ?? '');
    ?>
    <link rel="stylesheet" href="<?= rutaCityFarmac('assets/css/header-footer.css') ?>">
    <?php if ($esAdminCityFarmac): ?>
        <link rel="stylesheet" href="<?= rutaCityFarmac('assets/css/admin-layout.css') ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?= rutaCityFarmac('assets/css/ajustes-interfaz.css') ?>?v=<?= filemtime(__DIR__ . '/../../assets/css/ajustes-interfaz.css') ?>">
</head>

<?php if ($esAdminCityFarmac): ?>

    <body class="admin-page">
    <?php endif; ?>