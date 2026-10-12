<?php

$raizCityFarmac = str_replace(
    '\\',
    '/',
    dirname(__DIR__, 2)
);

$scriptCityFarmac = str_replace(
    '\\',
    '/',
    $_SERVER['SCRIPT_FILENAME'] ?? ''
);

$urlScriptCityFarmac = str_replace(
    '\\',
    '/',
    $_SERVER['SCRIPT_NAME'] ?? ''
);

$relativoCityFarmac = substr(
    $scriptCityFarmac,
    strlen($raizCityFarmac)
);

$baseCityFarmac = '';

if (
    $relativoCityFarmac !== ''
    && substr(
        $urlScriptCityFarmac,
        -strlen($relativoCityFarmac)
    ) === $relativoCityFarmac
) {
    $baseCityFarmac = substr(
        $urlScriptCityFarmac,
        0,
        -strlen($relativoCityFarmac)
    );
}

// URL para redirecciones y cookies.
function urlCityFarmac(string $ruta): string
{
    global $baseCityFarmac;

    $ruta = preg_replace(
        '~^(?:\.\./|\./)+~',
        '',
        $ruta
    );

    return rtrim($baseCityFarmac, '/')
        . '/'
        . ltrim($ruta, '/');
}

// URL escapada para enlaces y atributos HTML.
function rutaCityFarmac(string $ruta): string
{
    return htmlspecialchars(
        urlCityFarmac($ruta),
        ENT_QUOTES,
        'UTF-8'
    );
}
