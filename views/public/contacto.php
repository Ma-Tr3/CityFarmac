<?php
$css = '<link rel="stylesheet" href="../../assets/css/public.css">';

$areas = ['Atención al cliente', 'Productos', 'Recursos humanos'];

require_once __DIR__ . '/../layouts/head.php';
?>
<body>
<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="cf-contenedor">

    <p class="cf-migas"><a href="inicio.php">Inicio</a> / Contáctenos</p>

    <div class="cf-contacto">

        <div>
            <p class="cf-etiqueta">Estamos para ayudarte</p>
            <h1 class="cf-titulo-pagina">Conversemos.</h1>
            <p class="cf-contacto-texto">Contanos en qué podemos ayudarte y dirigiremos tu consulta al área correspondiente.</p>

            <div class="cf-panel">
                <h2 class="cf-panel-titulo">Tu consulta es importante</h2>
                <p class="cf-panel-texto">Para consultas sobre productos, atención y oportunidades laborales, completá el formulario.</p>
            </div>
        </div>

        <div class="cf-panel">
            <form method="post" action="contacto.php">
                <div class="cf-form-fila cf-form-fila--iguales">
                    <div class="cf-campo">
                        <label for="nombre">Nombre y apellido</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="cf-campo">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>

                <div class="cf-form-fila cf-form-fila--iguales">
                    <div class="cf-campo">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono">
                    </div>
                    <div class="cf-campo">
                        <label for="area">Área de la empresa</label>
                        <select id="area" name="area">
                            <?php foreach ($areas as $area): ?>
                                <option><?= htmlspecialchars($area) ?></option>
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
                    <button type="submit" class="cf-boton">Enviar consulta</button>
                </div>
            </form>
        </div>

    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>