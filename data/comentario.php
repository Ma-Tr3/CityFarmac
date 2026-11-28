<?php

require_once __DIR__ . '/formulario.php';
require_once __DIR__ . '/../modelos/catalogo.php';

function procesarComentarioProducto(int $productoId): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    $email = $_POST['email'] ?? '';
    $texto = $_POST['comentario'] ?? '';
    $email = is_string($email) ? trim($email) : '';
    $texto = is_string($texto) ? trim($texto) : '';

    $ranking = filter_input(INPUT_POST, 'valoracion', FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1, 'max_range' => 5],
    ]);

    try {
        validarToken();

        if (strlen($email) > 254 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new DomainException('Ingresá un email válido.');
        }

        $longitud = preg_match_all('/./us', $texto);

        if (!$longitud || $longitud > 4000) {
            throw new DomainException('Ingresá un comentario de hasta 4000 caracteres.');
        }

        if (!$ranking) {
            throw new DomainException('Elegí una valoración del 1 al 5.');
        }

        $ip = $_SERVER['REMOTE_ADDR'] ?? '';

        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new RuntimeException('No se pudo registrar el comentario.');
        }

        guardarComentarioPendiente($productoId, $email, $texto, $ranking, $ip);
    } catch (PDOException $error) {
        error_log($error->getMessage());
        $GLOBALS['errorFormulario'] = 'No se pudo guardar el comentario. Intentá nuevamente.';
        return;
    } catch (DomainException | RuntimeException $error) {
        $GLOBALS['errorFormulario'] = $error->getMessage();
        return;
    }

    $_SESSION['mensaje_exito'] = 'Tu comentario quedó pendiente de aprobación.';

    header(
        'Location: ' . urlCityFarmac('views/public/detalle.php?id=' . $productoId) . '#comentar',
        true,
        303
    );
    exit;
}