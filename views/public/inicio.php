<?php

$css = '<link rel="stylesheet" href="../../assets/css/public.css">
        <link rel="stylesheet" href="../../assets/css/header-footer.css">';

require_once __DIR__ . '/../layouts/head.php';

$destacados = [
    ['id' => 1, 'marca' => 'Dermacare', 'nombre' => 'Protector solar FPS 50',  'puntaje' => 5, 'precio' => 18900, 'tono' => 'azul'],
    ['id' => 2, 'marca' => 'Hydra Lab', 'nombre' => 'Crema hidratante facial', 'puntaje' => 4, 'precio' => 12400, 'tono' => ''],
    ['id' => 3, 'marca' => 'Dermacare', 'nombre' => 'Gel de limpieza suave',   'puntaje' => 5, 'precio' => 9800,  'tono' => 'durazno'],
    ['id' => 4, 'marca' => 'Botánica',  'nombre' => 'Shampoo reparación',      'puntaje' => 4, 'precio' => 7600,  'tono' => ''],
    ['id' => 5, 'marca' => 'Aura',      'nombre' => 'Perfume floral 50 ml',    'puntaje' => 5, 'precio' => 32500, 'tono' => 'durazno'],
    ['id' => 6, 'marca' => 'Hydra Lab', 'nombre' => 'Loción corporal',         'puntaje' => 4, 'precio' => 11200, 'tono' => 'azul'],
];
?>
<body>
<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="cf-contenedor">

    <section class="cf-hero">
        <div class="cf-hero-texto">
            <p class="cf-etiqueta">Tu rutina, tu bienestar</p>
            <h1>Cuidarte se siente bien.</h1>
            <p>Descubrí productos de farmacia y perfumería para acompañarte en cada momento del día.</p>
            <a href="catalogo.php" class="cf-boton">Explorar productos →</a>
        </div>
        <div class="cf-hero-frascos">
            <div class="cf-frasco">
                <span>Hydra Lab</span><strong>Daily Moisture</strong><span>50 ml</span>
            </div>
            <div class="cf-frasco cf-frasco--azul">
                <span>Dermacare</span><strong>Solar Protect</strong><span>50 ml</span>
            </div>
            <div class="cf-frasco cf-frasco--durazno">
                <span>Dermacare</span><strong>Pure Skin</strong><span>50 ml</span>
            </div>
        </div>
    </section>

    <section>
        <div class="cf-destacados-cabecera">
            <div>
                <p class="cf-etiqueta">Seleccionados para vos</p>
                <h2>Productos destacados</h2>
            </div>
            <a href="catalogo.php">Ver todos →</a>
        </div>

        <div class="cf-grilla">
            <?php foreach ($destacados as $p): ?>
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

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>