<?php
require_once __DIR__ . '/../layouts/rutas.php';
$css = '
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/public.css') . '">
<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/header-footer.css') . '">
';

require_once __DIR__ . '/../layouts/head.php';

$datos = require __DIR__ . '/../../data/admin.php';
$productos = productosPublicos($datos);
$marcas = array_unique(array_column($productos, 'marca'));
$categorias = [];
foreach ($datos['categorias'] as $c) if (!isset($c['padre_id']) && $c['estado']) $categorias[$c['nombre']] = [$c['nombre']];
foreach ($datos['categorias'] as $c) if (isset($c['padre_id']) && $c['estado']) {
    $padre = buscarPorId($datos['categorias'], $c['padre_id']);
    if ($padre && isset($categorias[$padre['nombre']])) $categorias[$padre['nombre']][] = $c['nombre'];
}
$productos = buscarArray($productos, (string)($_GET['q'] ?? ''));
$productos = array_values(array_filter($productos, function ($p) {
    $c = (string)($_GET['categoria'] ?? '');
    $m = (string)($_GET['marca'] ?? '');
    return ($c === '' || $p['categoria'] === $c || $p['subcategoria'] === $c) && ($m === '' || $p['marca'] === $m);
}));
$orden = (string)($_GET['orden'] ?? 'Destacados');
usort($productos, function ($a, $b) use ($orden) {
    if ($orden === 'Menor precio') return $a['precio'] <=> $b['precio'];
    if ($orden === 'Mayor precio') return $b['precio'] <=> $a['precio'];
    if ($orden === 'Mejor puntaje') return $b['puntaje'] <=> $a['puntaje'];
    return $b['destacado'] <=> $a['destacado'];
});
sort($marcas);
?>

<body>
    <?php require_once __DIR__ . '/../layouts/header.php'; ?>

    <main class="cf-contenedor">

        <p class="cf-migas"><a href="<?= rutaCityFarmac('views/public/inicio.php') ?>">Inicio</a> / Productos</p>
        <h1 class="cf-titulo-pagina">Encontrá tu próximo favorito.</h1>

        <div class="cf-catalogo">

            <aside class="cf-filtros">
                <h2>Categorías</h2>
                <a href="<?= rutaCityFarmac('views/public/catalogo.php') ?>" class="cf-filtro-link">Todos los productos</a>

                <?php foreach ($categorias as $grupo => $items): ?>
                    <p class="cf-filtro-grupo">▾ <?= htmlspecialchars($grupo) ?></p>
                    <?php foreach ($items as $item): ?>
                        <a href="<?= rutaCityFarmac('views/public/catalogo.php') ?>?categoria=<?= urlencode($item) ?>" class="cf-filtro-link">
                            <?= htmlspecialchars($item) ?>
                        </a>
                    <?php endforeach; ?>
                <?php endforeach; ?>

                <form method="get"><input name="q" placeholder="Buscar productos" value="<?= escaparDato($_GET['q'] ?? '') ?>"><input type="hidden" name="categoria" value="<?= escaparDato($_GET['categoria'] ?? '') ?>"><label for="marca" class="cf-filtro-etiqueta">Marca</label>
                    <select id="marca" name="marca" class="cf-select">
                        <option value="">Todas</option>
                        <?php foreach ($marcas as $m): ?>
                            <option <?= ($_GET['marca'] ?? '') === $m ? 'selected' : '' ?>><?= htmlspecialchars($m) ?></option>
                        <?php endforeach; ?>
                    </select><label>Ordenar <select name="orden"><?php foreach (['Destacados', 'Menor precio', 'Mayor precio', 'Mejor puntaje'] as $o): ?><option <?= $orden === $o ? 'selected' : '' ?>><?= $o ?></option><?php endforeach; ?></select></label><button class="cf-boton">Buscar</button>
                </form>
            </aside>

            <section>
                <div class="cf-catalogo-barra">
                    <span class="cf-cantidad"><?= count($productos) ?> productos</span>

                </div>

                <?php if (!$productos): ?><p>No se encontraron productos.</p><?php endif; ?><div class="cf-grilla">
                    <?php foreach ($productos as $p): ?>
                        <article class="cf-tarjeta">
                            <div class="cf-tarjeta-imagen">
                                <img src="<?= escaparDato(imagenUrl($p['imagen'])) ?>" alt="<?= escaparDato($p['nombre']) ?>">
                            </div>
                            <p class="cf-marca"><?= htmlspecialchars($p['marca']) ?></p>
                            <h3 class="cf-nombre"><?= htmlspecialchars($p['nombre']) ?></h3>
                            <p class="cf-puntaje">
                                <?= str_repeat('★', $p['puntaje']) . str_repeat('☆', 5 - $p['puntaje']) ?>
                                (<?= number_format($p['puntaje'], 1) ?>)
                            </p>
                            <div class="cf-tarjeta-pie">
                                <span class="cf-precio">$ <?= number_format($p['precio'], 0, ',', '.') ?></span>
                                <a href="<?= rutaCityFarmac('views/public/detalle.php') ?>?id=<?= $p['id'] ?>" class="cf-boton-detalle">Ver detalle ↗</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

        </div>
    </main>

    <?php require_once __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>