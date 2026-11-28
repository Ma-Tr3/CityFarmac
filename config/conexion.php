<?php

function conexionCatalogo(): PDO {
    static $conexion = null;

    if ($conexion === null) {

        $host = getenv('DB_HOST') ?: '127.0.0.1';
        $port = getenv('DB_PORT') ?: '3307';
        $dbname = getenv('DB_NAME') ?: 'cityfarmac';
        $user = getenv('DB_USER') ?: 'root';
        $password = getenv('DB_PASSWORD') ?: '';

        $conexion = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", 
            $user, 
            $password === false ? '' : $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }
    return $conexion;
}