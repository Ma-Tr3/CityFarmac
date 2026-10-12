<?php if (!empty($esAdminCityFarmac)): ?>
    </div><!-- Cierre del panel: sidebar y contenido -->
<?php endif; ?>

<?php require_once __DIR__ . '/rutas.php'; ?>

<footer class="site-footer">
    <div class="site-footer-inner">
        <div class="site-footer-brand">
            <a href="<?= rutaCityFarmac('views/public/inicio.php') ?>">
                CityFarmac
            </a>

            <p>
                Productos para acompañar tu bienestar<br>
                y tu cuidado de todos los días.
            </p>
        </div>

        <nav aria-label="Enlaces del pie">
            <h2>Explorá</h2>

            <a href="<?= rutaCityFarmac('views/public/inicio.php') ?>">
                Inicio
            </a>

            <a href="<?= rutaCityFarmac('views/public/catalogo.php') ?>">
                Productos
            </a>

            <a href="<?= rutaCityFarmac('views/public/contacto.php') ?>">
                Contacto
            </a>
        </nav>

        <div class="site-footer-help">
            <h2>Estamos para ayudarte</h2>
            <p>Consultanos sobre nuestros productos.</p>

            <a href="<?= rutaCityFarmac('views/public/contacto.php') ?>">
                Hacé tu consulta →
            </a>
        </div>
    </div>

    <div class="site-footer-bottom">
        <span>
            © <?= date('Y') ?> CityFarmac.
            Todos los derechos reservados.
        </span>

        <?php if (
            function_exists('usuarioActual')
            && function_exists('permisosUsuario')
            && permisosUsuario(usuarioActual())
        ): ?>
            <a href="<?= rutaCityFarmac('views/admin/panel-inicio.php') ?>">
                Panel de administración
            </a>
        <?php endif; ?>
    </div>
</footer>