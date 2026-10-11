<?php

$css = '<link rel="stylesheet" href="../../assets/css/public.css">
        <link rel="stylesheet" href="../../assets/css/header-footer.css">';


function estrellas(int $n): string
{
    return str_repeat('★', $n) . str_repeat('☆', 5 - $n);
}

$productos = [
    ['id' => 1, 'marca' => 'Dermacare', 'nombre' => 'Protector solar FPS 50',  'modelo' => 'Solar Protect',  'categoria' => 'Dermocosmética', 'linea' => 'Cuidado diario',    'puntaje' => 5, 'precio' => 18900, 'tono' => 'azul',
     'descripcion' => 'Una fórmula pensada para acompañar tu rutina de cuidado diario. Textura suave, fácil aplicación y una experiencia de bienestar para tu piel.'],
    ['id' => 2, 'marca' => 'Hydra Lab', 'nombre' => 'Crema hidratante facial', 'modelo' => 'Daily Moisture', 'categoria' => 'Cuidado facial',  'linea' => 'Bienestar esencial', 'puntaje' => 4, 'precio' => 12400, 'tono' => '',
     'descripcion' => 'Hidratación liviana para usar todos los días, de rápida absorción y sin sensación grasosa.'],
    ['id' => 3, 'marca' => 'Dermacare', 'nombre' => 'Gel de limpieza suave',   'modelo' => 'Pure Skin',      'categoria' => 'Cuidado facial',  'linea' => 'Bienestar esencial', 'puntaje' => 5, 'precio' => 9800,  'tono' => 'durazno',
     'descripcion' => 'Limpia en profundidad sin resecar. Ideal para el uso diario, mañana y noche.'],
    ['id' => 4, 'marca' => 'Botánica',  'nombre' => 'Shampoo reparación',      'modelo' => 'Repair',         'categoria' => 'Cabello',         'linea' => 'Bienestar esencial', 'puntaje' => 4, 'precio' => 7600,  'tono' => '',
     'descripcion' => 'Ayuda a recuperar la suavidad y el brillo del cabello con cada lavado.'],
    ['id' => 5, 'marca' => 'Aura',      'nombre' => 'Perfume floral 50 ml',    'modelo' => 'Bloom',          'categoria' => 'Fragancias',      'linea' => 'Bienestar esencial', 'puntaje' => 5, 'precio' => 32500, 'tono' => 'durazno',
     'descripcion' => 'Una fragancia floral fresca y delicada para acompañarte durante todo el día.'],
    ['id' => 6, 'marca' => 'Hydra Lab', 'nombre' => 'Loción corporal',         'modelo' => 'Body Soft',      'categoria' => 'Cuerpo',          'linea' => 'Cuidado diario',    'puntaje' => 4, 'precio' => 11200, 'tono' => 'azul',
     'descripcion' => 'Nutre y suaviza la piel del cuerpo, con una textura cremosa que se absorbe rápido.'],
];

$opiniones = [
    1 => [
        ['autor' => 'Lucía M.',  'puntaje' => 5, 'texto' => 'Muy buena textura. Lo incorporé a mi rutina diaria.'],
        ['autor' => 'Martín R.', 'puntaje' => 4, 'texto' => 'Buen producto, cumple con lo esperado.'],
    ],
];

$valoraciones = [5 => 'Excelente', 4 => 'Muy bueno', 3 => 'Bueno', 2 => 'Regular', 1 => 'Malo'];

// Buscar el producto que pidió la URL (detalle.php?id=1)
$id = (int) ($_GET['id'] ?? 0);
$producto = null;
foreach ($productos as $item) {
    if ($item['id'] === $id) {
        $producto = $item;
        break;
    }
}

if ($producto === null) {
    http_response_code(404);
}

$opinionesProducto = $opiniones[$id] ?? [];

require_once __DIR__ . '/../layouts/head.php';
?>
<body>
<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="cf-contenedor">

<?php if ($producto === null): ?>

    <h1 class="cf-titulo-pagina">Producto no encontrado</h1>
    <p>El producto que buscás no existe o fue retirado del catálogo.</p>
    <a href="catalogo.php" class="cf-boton">← Volver al catálogo</a>

<?php else: ?>

    <p class="cf-migas">
        <a href="catalogo.php">Productos</a> /
        <a href="catalogo.php?categoria=<?= urlencode($producto['categoria']) ?>"><?= htmlspecialchars($producto['categoria']) ?></a> /
        <?= htmlspecialchars($producto['nombre']) ?>
    </p>

    <section class="cf-detalle">
        <div class="cf-detalle-imagen">
            <div class="cf-frasco cf-frasco--grande <?= $producto['tono'] ? 'cf-frasco--' . $producto['tono'] : '' ?>">
                <span><?= htmlspecialchars($producto['marca']) ?></span>
                <strong><?= htmlspecialchars($producto['modelo']) ?></strong>
                <span><?= htmlspecialchars($producto['linea']) ?></span>
                <span>50 ml</span>
            </div>
        </div>

        <div class="cf-detalle-info">
            <p class="cf-marca"><?= htmlspecialchars($producto['marca']) ?></p>
            <h1><?= htmlspecialchars($producto['nombre']) ?></h1>
            <p class="cf-detalle-puntaje">
                <?= estrellas($producto['puntaje']) ?>
                <?= number_format($producto['puntaje'], 1) ?> · <?= count($opinionesProducto) ?> opiniones
            </p>
            <p class="cf-detalle-precio">$ <?= number_format($producto['precio'], 0, ',', '.') ?></p>
            <span class="cf-chip"><?= htmlspecialchars($producto['categoria']) ?></span>
            <p class="cf-detalle-texto"><?= htmlspecialchars($producto['descripcion']) ?></p>
            <p class="cf-detalle-datos">
                Marca: <?= htmlspecialchars($producto['marca']) ?><br>
                Modelo: <?= htmlspecialchars($producto['modelo']) ?>
            </p>
            <a href="catalogo.php" class="cf-boton-claro">← Volver al catálogo</a>
        </div>
    </section>

    <section>
        <h2 class="cf-seccion-titulo">Opiniones de nuestros clientes</h2>
        <div class="cf-panel">
            <?php if (empty($opinionesProducto)): ?>
                <p class="cf-sin-opiniones">Todavía no hay opiniones para este producto.</p>
            <?php else: ?>
                <?php foreach ($opinionesProducto as $o): ?>
                    <div class="cf-opinion">
                        <div class="cf-opinion-cabecera">
                            <span><?= htmlspecialchars($o['autor']) ?></span>
                            <span class="cf-opinion-estrellas"><?= estrellas($o['puntaje']) ?></span>
                        </div>
                        <p><?= htmlspecialchars($o['texto']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="cf-panel">
            <h2 class="cf-panel-titulo">Compartí tu experiencia</h2>
            <form method="post" action="detalle.php?id=<?= $producto['id'] ?>">
                <div class="cf-form-fila">
                    <div class="cf-campo">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="cf-campo">
                        <label for="valoracion">Valoración</label>
                        <select id="valoracion" name="valoracion">
                            <?php foreach ($valoraciones as $numero => $texto): ?>
                                <option value="<?= $numero ?>"><?= $numero ?> · <?= $texto ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="cf-campo">
                    <label for="comentario">Comentario</label>
                    <textarea id="comentario" name="comentario" required></textarea>
                </div>
                <div class="cf-form-acciones">
                    <button type="reset" class="cf-boton-claro">Cancelar</button>
                    <button type="submit" class="cf-boton">Enviar comentario</button>
                </div>
            </form>
        </div>
    </section>

<?php endif; ?>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>