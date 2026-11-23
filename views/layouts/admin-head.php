<?php
require_once __DIR__ . '/rutas.php';
require_once __DIR__ . '/../../data/sesion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administración - CityFarmac</title>
    <link rel="stylesheet" href="<?= rutaCityFarmac('assets/css/styles.css') ?>">
    <?= $css ?? '' ?>
    <link rel="stylesheet" href="<?= rutaCityFarmac('assets/css/header-footer.css') ?>">
    <link rel="stylesheet" href="<?= rutaCityFarmac('assets/css/admin-layout.css') ?>">
    <link rel="stylesheet" href="<?= rutaCityFarmac('assets/css/ajustes-interfaz.css') ?>?v=<?= filemtime(__DIR__ . '/../../assets/css/ajustes-interfaz.css') ?>">
</head>
<body class="admin-page">