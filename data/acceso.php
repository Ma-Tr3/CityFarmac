<?php
require_once __DIR__ . '/sesion.php';
$errorAcceso = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!tokenSesionValido()) throw new RuntimeException('Recargá la página e intentá nuevamente.');
        $email = trim((string)($_POST['email'] ?? ''));
        $password = (string)($_POST['password'] ?? '');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password)>1024) throw new RuntimeException('Revisá el email y la contraseña.');
        if ($modoAcceso === 'registro') {
            $nombre = trim((string)($_POST['nombre'] ?? ''));
            if ($nombre === '' || strlen($nombre)>240 || strlen($password)<8 || $password !== (string)($_POST['password2'] ?? '')) throw new RuntimeException('Completá el nombre y usá contraseñas iguales de al menos 8 caracteres.');
            actualizarDatos(function (&$datos) use ($nombre,$email,$password) {
                foreach ($datos['usuarios'] as $u) if (strcasecmp($u['email'], $email)===0) throw new RuntimeException('El email ya está registrado.');
                $datos['usuarios'][]=['id'=>max(array_merge([0],array_column($datos['usuarios'],'id')))+1,'estado'=>1,'nombre'=>$nombre,'email'=>$email,'perfil'=>'Usuario','password'=>password_hash($password,PASSWORD_DEFAULT)];
            });
            header('Location: '.urlCityFarmac('login.php?registrado=1')); exit;
        }
        if (($_SESSION['acceso_bloqueado_hasta'] ?? 0)>time()) throw new RuntimeException('Esperá un minuto antes de volver a intentar.');
        $usuario = null;
        foreach (cargarDatos()['usuarios'] as $u) if (strcasecmp($u['email'],$email)===0) { $usuario=$u; break; }
        if (!$usuario || empty($usuario['estado']) || empty($usuario['password']) || !password_verify($password,$usuario['password'])) {
            $_SESSION['acceso_fallos'] = ($_SESSION['acceso_fallos'] ?? 0)+1;
            if ($_SESSION['acceso_fallos']>=5) { $_SESSION['acceso_bloqueado_hasta']=time()+60; $_SESSION['acceso_fallos']=0; }
            throw new RuntimeException('Email o contraseña incorrectos.');
        }
        unset($_SESSION['acceso_fallos'], $_SESSION['acceso_bloqueado_hasta']);
        iniciarSesionUsuario($usuario);
        header('Location: '.urlCityFarmac(permisosUsuario($usuario) ? 'views/admin/panel-inicio.php' : 'cuenta.php')); exit;
    } catch (Throwable $e) { $errorAcceso=$e->getMessage(); }
}
