<?php
require_once __DIR__ . '/../../data/comentario.php';


require_once __DIR__ . '/../layouts/rutas.php';
$css = '<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/public.css') . '">
        <link rel="stylesheet" href="' . rutaCityFarmac('assets/css/header-footer.css') . '">';


function estrellas(int $n): string
{
    return str_repeat('★', $n) . str_repeat('☆', 5 - $n);
}

$datos = require __DIR__ . '/../../data/admin.php';
$productos = productosPublicos($datos);
$opiniones = [];
foreach ($datos['comentarios'] as $c) if ($c['estado']) $opiniones[$c['producto_id']][] = ['autor' => 'Cliente', 'puntaje' => (int)$c['ranking'], 'texto' => $c['comentario']];
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
            <a href="<?= rutaCityFarmac('views/public/catalogo.php') ?>" class="cf-boton">← Volver al catálogo</a>

        <?php else: ?>

            <p class="cf-migas">
                <a href="<?= rutaCityFarmac('views/public/catalogo.php') ?>">Productos</a> /
                <a href="<?= rutaCityFarmac('views/public/catalogo.php') ?>?categoria=<?= urlencode($producto['categoria']) ?>"><?= htmlspecialchars($producto['categoria']) ?></a> /
                <?= htmlspecialchars($producto['nombre']) ?>
            </p>

            <section class="cf-detalle">
                <div class="cf-detalle-imagen">
                    <img src="<?= escaparDato(imagenUrl($producto['imagen'])) ?>" alt="<?= escaparDato($producto['nombre']) ?>" style="max-width:100%;max-height:380px;object-fit:contain">
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
                    <a href="<?= rutaCityFarmac('views/public/catalogo.php') ?>" class="cf-boton-claro">← Volver al catálogo</a>
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
                    <form method="post" action="<?= rutaCityFarmac('views/public/detalle.php') ?>?id=<?= $producto['id'] ?>"><?= camposFormulario() ?>
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