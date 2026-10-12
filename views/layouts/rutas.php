<?php
// Base URL calculada desde el archivo ejecutado, sin fijar el nombre de carpeta.
$raizCityFarmac = str_replace('\\', '/', dirname(__DIR__, 2));
$scriptCityFarmac = str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME'] ?? '');
$urlCityFarmac = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$relativoCityFarmac = substr($scriptCityFarmac, strlen($raizCityFarmac));
$baseCityFarmac = $relativoCityFarmac !== '' && substr($urlCityFarmac, -strlen($relativoCityFarmac)) === $relativoCityFarmac
    ? substr($urlCityFarmac, 0, -strlen($relativoCityFarmac)) : '';

function urlCityFarmac(string $ruta): string
{
    global $baseCityFarmac;
    $ruta = preg_replace('~^(?:\.\./|\./)+~', '', $ruta);
    return rtrim($baseCityFarmac, '/') . '/' . ltrim($ruta, '/');
}
function rutaCityFarmac(string $ruta): string
{
    return htmlspecialchars(urlCityFarmac($ruta), ENT_QUOTES, 'UTF-8');
}
