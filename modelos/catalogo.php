<?php

require_once __DIR__ . '/../config/conexion.php';

function consultarCatalogo(string $sql, array $parametros = []): PDOStatement
{
    $consulta = conexionCatalogo()->prepare($sql);
    $consulta->execute($parametros);

    return $consulta;
}

function categoriasCatalogo(): array
{
    return consultarCatalogo(
        "SELECT c.id, c.nombre, c.activo AS estado,
                c.categoria_padre_id AS padre_id,
                COALESCE(p.nombre, 'Principal') AS padre
         FROM categorias c
         LEFT JOIN categorias p ON p.id = c.categoria_padre_id
         ORDER BY c.nombre"
    )->fetchAll();
}

function marcasCatalogo(): array
{
    return consultarCatalogo(
        'SELECT id, nombre, activo AS estado FROM marcas ORDER BY nombre'
    )->fetchAll();
}

function productosCatalogo(): array
{
    return consultarCatalogo(
        "SELECT p.id, p.nombre, p.descripcion, p.modelo, p.precio,
                p.imagen, p.destacado, p.marca_id, p.activo AS estado,
                COALESCE(c.categoria_padre_id, c.id) AS categoria_id,
                CASE WHEN padre.id IS NOT NULL THEN c.id END AS subcategoria_id,
                COALESCE(padre.nombre, c.nombre) AS categoria,
                CASE WHEN padre.id IS NOT NULL THEN c.nombre ELSE '' END AS subcategoria,
                m.nombre AS marca
         FROM productos p
         JOIN categorias c ON c.id = p.categoria_id
         LEFT JOIN categorias padre ON padre.id = c.categoria_padre_id
         JOIN marcas m ON m.id = p.marca_id
         ORDER BY p.nombre"
    )->fetchAll();
}

function comentariosCatalogo(): array
{
    return consultarCatalogo(
        "SELECT c.id, c.producto_id, c.email, c.comentario, c.ranking,
                c.aprobado AS estado,
                DATE_FORMAT(c.fecha_creacion, '%d/%m/%Y') AS fecha,
                p.nombre AS producto
         FROM comentarios c
         JOIN productos p ON p.id = c.producto_id
         ORDER BY c.fecha_creacion DESC, c.id DESC"
    )->fetchAll();
}

function guardarCategoriaCatalogo(?int $id, string $nombre, ?int $padre): void
{
    if ($id === null) {
        consultarCatalogo(
            'INSERT INTO categorias (nombre, categoria_padre_id) VALUES (?, ?)',
            [$nombre, $padre]
        );
        return;
    }

    consultarCatalogo(
        'UPDATE categorias SET nombre = ?, categoria_padre_id = ? WHERE id = ?',
        [$nombre, $padre, $id]
    );
}

function guardarMarcaCatalogo(?int $id, string $nombre): void
{
    if ($id === null) {
        consultarCatalogo('INSERT INTO marcas (nombre) VALUES (?)', [$nombre]);
        return;
    }

    consultarCatalogo(
        'UPDATE marcas SET nombre = ? WHERE id = ?',
        [$nombre, $id]
    );
}

function guardarProductoCatalogo(?int $id, array $valores): void
{
    if ($id === null) {
        consultarCatalogo(
            'INSERT INTO productos
                (nombre, descripcion, precio, modelo, categoria_id, marca_id, imagen, destacado)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
            $valores
        );
        return;
    }

    $valores[] = $id;

    consultarCatalogo(
        'UPDATE productos
         SET nombre = ?, descripcion = ?, precio = ?, modelo = ?,
             categoria_id = ?, marca_id = ?, imagen = ?, destacado = ?
         WHERE id = ?',
        $valores
    );
}

function cambiarEstadoCatalogo(string $entidad, int $id): void
{
    $sql = match ($entidad) {
        'categorias' => 'UPDATE categorias SET activo = IF(activo, 0, 1) WHERE id = ?',
        'marcas' => 'UPDATE marcas SET activo = IF(activo, 0, 1) WHERE id = ?',
        'productos' => 'UPDATE productos SET activo = IF(activo, 0, 1) WHERE id = ?',
        'comentarios' => 'UPDATE comentarios SET aprobado = IF(aprobado, 0, 1) WHERE id = ?',
        default => throw new DomainException('Entidad inválida.'),
    };

    if (consultarCatalogo($sql, [$id])->rowCount() !== 1) {
        throw new DomainException('Registro no encontrado.');
    }
}

function productoPublicoPorId(int $id): ?array
{
    $producto = consultarCatalogo(
        'SELECT p.id, p.nombre, p.descripcion, p.modelo, p.precio, p.imagen,
                m.nombre AS marca,
                COALESCE(padre.nombre, categoria.nombre) AS categoria
         FROM productos p
         INNER JOIN marcas m ON m.id = p.marca_id
         INNER JOIN categorias categoria ON categoria.id = p.categoria_id
         LEFT JOIN categorias padre ON padre.id = categoria.categoria_padre_id
         WHERE p.id = ?
           AND p.activo = 1
           AND m.activo = 1
           AND categoria.activo = 1
           AND (padre.id IS NULL OR padre.activo = 1)',
        [$id]
    )->fetch();

    return $producto === false ? null : $producto;
}

function opinionesPublicasPorProducto(int $id): array
{
    return consultarCatalogo(
        "SELECT 'Cliente' AS autor, ranking AS puntaje, comentario AS texto
         FROM comentarios
         WHERE producto_id = ? AND aprobado = 1
         ORDER BY fecha_creacion DESC, id DESC",
        [$id]
    )->fetchAll();
}

function guardarComentarioPendiente(
    int $productoId,
    string $email,
    string $comentario,
    int $ranking,
    string $ip
): void {
    consultarCatalogo(
        'INSERT INTO comentarios
            (producto_id, email, comentario, ranking, ip, aprobado)
         VALUES (?, ?, ?, ?, ?, 0)',
        [$productoId, $email, $comentario, $ranking, $ip]
    );
}