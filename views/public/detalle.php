<?php

require_once __DIR__ . '/../../data/comentario.php';
require_once __DIR__ . '/../layouts/rutas.php';

$css = '<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/public.css') . '">
        <link rel="stylesheet" href="' . rutaCityFarmac('assets/css/header-footer.css') . '">';

function estrellas(int $n): string
{
    return str_repeat('★', $n) . str_repeat('☆', 5 - $n);
}

$valoraciones = [
    5 => 'Excelente',
    4 => 'Muy bueno',
    3 => 'Bueno',
    2 => 'Regular',
    1 => 'Malo',
];

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1],
]);

$producto = null;
$opinionesProducto = [];
$promedio = 0.0;
$errorCatalogo = false;

try {
    $producto = $id ? productoPublicoPorId($id) : null;

    if ($producto === null) {
        http_response_code(404);
    } else {
        procesarComentarioProducto($id);

        $opinionesProducto = opinionesPublicasPorProducto($id);

        if ($opinionesProducto) {
            $promedio = array_sum(array_column($opinionesProducto, 'puntaje'))
                / count($opinionesProducto);
        }
    }
} catch (PDOException $error) {
    error_log($error->getMessage());
    http_response_code(503);
    $errorCatalogo = true;
}

$emailIngresado = $_POST['email'] ?? '';
$emailIngresado = is_string($emailIngresado) ? $emailIngresado : '';

$comentarioIngresado = $_POST['comentario'] ?? '';
$comentarioIngresado = is_string($comentarioIngresado) ? $comentarioIngresado : '';

$valoracionIngresada = $_POST['valoracion'] ?? '5';

require_once __DIR__ . '/../layouts/head.php';
?>

<body>
    <?php require_once __DIR__ . '/../layouts/header.php'; ?>

    <main class="cf-contenedor">

        <?php if ($errorCatalogo): ?>

            <h1 class="cf-titulo-pagina">El catálogo no está disponible</h1>
            <p>Intentá nuevamente en unos minutos.</p>

        <?php elseif ($producto === null): ?>

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
                    <img src="<?= rutaCityFarmac($producto['imagen'] ?: 'assets/img/products/solar.svg') ?>"
                    alt="<?= escaparDato($producto['nombre']) ?>"
                    style="max-width:100%;max-height:380px;object-fit:contain">
                </div>

                <div class="cf-detalle-info">
                    <p class="cf-marca"><?= htmlspecialchars($producto['marca']) ?></p>
                    <h1><?= htmlspecialchars($producto['nombre']) ?></h1>
                    <p class="cf-detalle-puntaje">
                        <?= estrellas((int) round($promedio)) ?>
                        <?= number_format($promedio, 1, ',', '.') ?> · <?= count($opinionesProducto) ?> opiniones    
                    </p>
                    <p class="cf-detalle-precio">$ <?= number_format($producto['precio'], 2, ',', '.') ?></p>
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
                                    <span class="cf-opinion-estrellas"><?= estrellas((int) $o['puntaje']) ?></span>
                                </div>
                                <p><?= htmlspecialchars($o['texto']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="cf-panel" id="comentar">
                    <h2 class="cf-panel-titulo">Compartí tu experiencia</h2>

                    <?php require __DIR__ . '/../partials/mensajes.php'; ?>

                    <form method="post"
                        action="<?= rutaCityFarmac('views/public/detalle.php') ?>?id=<?= (int) $producto['id'] ?>#comentar">
                        <?= camposFormulario() ?>

                        <div class="cf-form-fila">
                            <div class="cf-campo">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required
                                    maxlength="254" value="<?= escaparDato($emailIngresado) ?>">
                            </div>

                            <div class="cf-campo">
                                <label for="valoracion">Valoración</label>
                                <select id="valoracion" name="valoracion" required>
                                    <?php foreach ($valoraciones as $numero => $texto): ?>
                                        <option value="<?= $numero ?>"
                                            <?= (string) $numero === $valoracionIngresada ? 'selected' : '' ?>>
                                            <?= $numero ?> · <?= escaparDato($texto) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="cf-campo">
                            <label for="comentario">Comentario</label>
                            <textarea id="comentario" name="comentario" maxlength="4000"
                                    required><?= escaparDato($comentarioIngresado) ?></textarea>
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