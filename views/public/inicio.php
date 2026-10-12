<?php

require_once __DIR__ . '/../layouts/rutas.php';
$css = '<link rel="stylesheet" href="' . rutaCityFarmac('assets/css/public.css') . '">
        <link rel="stylesheet" href="' . rutaCityFarmac('assets/css/header-footer.css') . '">';

require_once __DIR__ . '/../layouts/head.php';

$datos = require __DIR__ . '/../../data/admin.php';
$destacados = array_values(array_filter(productosPublicos($datos), function ($p) {
    return !empty($p['destacado']);
}));
?>

<body>
    <?php require_once __DIR__ . '/../layouts/header.php'; ?>

    <main class="cf-contenedor">

        <section class="cf-hero">
            <div class="cf-hero-texto">
                <p class="cf-etiqueta">Tu rutina, tu bienestar</p>
                <h1>Cuidarte se siente bien.</h1>
                <p>Descubrí productos de farmacia y perfumería para acompañarte en cada momento del día.</p>
                <a href="<?= rutaCityFarmac('views/public/catalogo.php') ?>" class="cf-boton">Explorar productos →</a>
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
                <a href="<?= rutaCityFarmac('views/public/catalogo.php') ?>">Ver todos →</a>
            </div>

            <div class="cf-grilla">
                <?php foreach ($destacados as $p): ?>
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

    </main>

    <?php require_once __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>