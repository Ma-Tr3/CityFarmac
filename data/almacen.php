<?php
// Los JSON se convierten a arrays asociativos. La búsqueda recorre esos arrays.
function escaparDato($v): string
{
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}
function buscarPorId(array $registros, int $id): ?array
{
    foreach ($registros as $registro) {
        if ((int)$registro['id'] === $id) return $registro;
    }
    return null;
}
function normalizarBusqueda(string $texto): string
{
    return strtolower(strtr($texto, ['Á' => 'a', 'É' => 'e', 'Í' => 'i', 'Ó' => 'o', 'Ú' => 'u', 'Ü' => 'u', 'Ñ' => 'n', 'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u', 'ñ' => 'n']));
}
function buscarArray(array $registros, string $texto): array
{
    return array_values(array_filter($registros, function ($r) use ($texto) {
        foreach ($r as $campo => $valor) {
            if ($campo !== 'password' && is_scalar($valor) && strpos(normalizarBusqueda((string)$valor), normalizarBusqueda($texto)) !== false) return true;
        }
        return $texto === '';
    }));
}
function cargarDatos(): array
{
    $archivo = __DIR__ . '/../upload/datos/cityfarmac.json';
    if (!is_file($archivo)) return require __DIR__ . '/semilla.php';
    $datos = json_decode(file_get_contents($archivo), true);
    if (!is_array($datos) || json_last_error() !== JSON_ERROR_NONE) throw new RuntimeException('No se pudo leer el archivo de datos.');
    return $datos;
}
function actualizarDatos(callable $cambio): void
{
    $dir = __DIR__ . '/../upload/datos';
    if (!is_dir($dir) && !mkdir($dir, 0775, true)) throw new RuntimeException('No se pudo crear upload/datos.');
    $lock = fopen($dir . '/cityfarmac.lock', 'c');
    if (!$lock || !flock($lock, LOCK_EX)) throw new RuntimeException('No se pudo bloquear el archivo.');
    try {
        $datos = cargarDatos();
        $cambio($datos);
        $json = json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        $tmp = tempnam($dir, 'datos-');
        if ($tmp === false) throw new RuntimeException('No se pudo crear el archivo temporal.');
        if (file_put_contents($tmp, $json) === false || !rename($tmp, $dir . '/cityfarmac.json')) {
            @unlink($tmp);
            throw new RuntimeException('No se pudieron guardar los datos. Revisá los permisos de upload.');
        }
    } finally {
        flock($lock, LOCK_UN);
        fclose($lock);
    }
}
function imagenUrl(string $imagen): string
{
    return '../../' . (strpos($imagen, 'upload/imagenes/') === 0 ? $imagen : 'assets/img/products/' . basename($imagen));
}
function productosPublicos(array $datos): array
{
    $productos = array_values(array_filter($datos['productos'], function ($p) {
        return !empty($p['estado']);
    }));
    foreach ($productos as &$p) {
        $opiniones = array_filter($datos['comentarios'], function ($c) use ($p) {
            return $c['producto_id'] == $p['id'] && !empty($c['estado']);
        });
        $p['puntaje'] = count($opiniones) ? (int)round(array_sum(array_column($opiniones, 'ranking')) / count($opiniones)) : 0;
        $p['tono'] = '';
        $p['linea'] = $p['subcategoria'];
    }
    return $productos;
}
