<?php
require_once __DIR__ . '/../layouts/head.php';

$categorias = [
    'Dermocosmética'  => ['Dermocosmética', 'Cuidado facial', 'Protección solar'],
    'Cuidado personal' => ['Cuidado personal', 'Cabello', 'Cuerpo'],
    'Perfumería'      => ['Perfumería', 'Fragancias'],
];

$productos = [
    ['id' => 1, 'marca' => 'Dermacare', 'nombre' => 'Protector solar FPS 50',  'puntaje' => 5, 'precio' => 18900, 'tono' => 'azul'],
    ['id' => 2, 'marca' => 'Hydra Lab', 'nombre' => 'Crema hidratante facial', 'puntaje' => 4, 'precio' => 12400, 'tono' => ''],
    ['id' => 3, 'marca' => 'Dermacare', 'nombre' => 'Gel de limpieza suave',   'puntaje' => 5, 'precio' => 9800,  'tono' => 'durazno'],
    ['id' => 4, 'marca' => 'Botánica',  'nombre' => 'Shampoo reparación',      'puntaje' => 4, 'precio' => 7600,  'tono' => ''],
    ['id' => 5, 'marca' => 'Aura',      'nombre' => 'Perfume floral 50 ml',    'puntaje' => 5, 'precio' => 32500, 'tono' => 'durazno'],
    ['id' => 6, 'marca' => 'Hydra Lab', 'nombre' => 'Loción corporal',         'puntaje' => 4, 'precio' => 11200, 'tono' => 'azul'],
];

$marcas = array_unique(array_column($productos, 'marca'));
sort($marcas);
?>
<body>
<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="cf-contenedor">

    <p class="cf-migas"><a href="inicio.php">Inicio</a> / Productos</p>
    <h1 class="cf-titulo-pagina">Encontrá tu próximo favorito.</h1>

    <div class="cf-catalogo">

        <aside class="cf-filtros">
            <h2>Categorías</h2>
            <a href="catalogo.php" class="cf-filtro-link">Todos los productos</a>

            <?php foreach ($categorias as $grupo => $items): ?>
                <p class="cf-filtro-grupo">▾ <?= htmlspecialchars($grupo) ?></p>
                <?php foreach ($items as $item): ?>
                    <a href="catalogo.php?categoria=<?= urlencode($item) ?>" class="cf-filtro-link">
                        <?= htmlspecialchars($item) ?>
                    </a>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <label for="marca" class="cf-filtro-etiqueta">Marca</label>
            <select id="marca" class="cf-select">
                <option>Todas</option>
                <?php foreach ($marcas as $m): ?>
                    <option><?= htmlspecialchars($m) ?></option>
                <?php endforeach; ?>
            </select>
        </aside>

        <section>
            <div class="cf-catalogo-barra">
                <span class="cf-cantidad"><?= count($productos) ?> productos</span>
                <div class="cf-orden">
                    <label for="orden" class="cf-filtro-etiqueta">Ordenar por</label>
                    <select id="orden" class="cf-select">
                        <option>Destacados</option>
                        <option>Menor precio</option>
                        <option>Mayor precio</option>
                        <option>Mejor puntaje</option>
                    </select>
                </div>
            </div>

            <div class="cf-grilla">
                <?php foreach ($productos as $p): ?>
                    <article class="cf-tarjeta">
                        <div class="cf-tarjeta-imagen">
                            <div class="cf-frasco cf-frasco--mini <?= $p['tono'] ? 'cf-frasco--' . $p['tono'] : '' ?>">
                                <span><?= htmlspecialchars($p['marca']) ?></span>
                            </div>
                        </div>
                        <p class="cf-marca"><?= htmlspecialchars($p['marca']) ?></p>
                        <h3 class="cf-nombre"><?= htmlspecialchars($p['nombre']) ?></h3>
                        <p class="cf-puntaje">
                            <?= str_repeat('★', $p['puntaje']) . str_repeat('☆', 5 - $p['puntaje']) ?>
                            (<?= number_format($p['puntaje'], 1) ?>)
                        </p>
                        <div class="cf-tarjeta-pie">
                            <span class="cf-precio">$ <?= number_format($p['precio'], 0, ',', '.') ?></span>
                            <a href="detalle.php?id=<?= $p['id'] ?>" class="cf-boton-detalle">Ver detalle ↗</a>
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