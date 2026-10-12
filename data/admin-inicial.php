<?php
// Cuenta inicial: se guarda con hash, sin comandos ni formulario de instalación.
$emailAdminInicial = 'admin@cityfarmac.com';
$passwordAdminInicial = 'Admin12345!';
$datosAdminInicial = cargarDatos();
$adminInicialExiste = false;
foreach ($datosAdminInicial['usuarios'] as $usuarioInicial) {
    if ($usuarioInicial['perfil'] === 'Administrador' && !empty($usuarioInicial['estado']) && !empty($usuarioInicial['password'])) {
        $adminInicialExiste = true;
        break;
    }
}
if (!$adminInicialExiste) {
    actualizarDatos(function (&$datos) use ($emailAdminInicial, $passwordAdminInicial) {
        foreach ($datos['usuarios'] as $usuario) {
            if ($usuario['perfil'] === 'Administrador' && !empty($usuario['estado']) && !empty($usuario['password'])) return;
        }
        $encontrado = false;
        foreach ($datos['usuarios'] as &$usuario) {
            if (strcasecmp($usuario['email'], $emailAdminInicial) === 0) {
                $usuario['estado'] = 1;
                $usuario['perfil'] = 'Administrador';
                $usuario['password'] = password_hash($passwordAdminInicial, PASSWORD_DEFAULT);
                $encontrado = true;
                break;
            }
        }
        unset($usuario);
        if (!$encontrado) {
            $datos['usuarios'][] = [
                'id' => max(array_merge([0], array_column($datos['usuarios'], 'id'))) + 1,
                'estado' => 1,
                'nombre' => 'Administrador',
                'email' => $emailAdminInicial,
                'perfil' => 'Administrador',
                'password' => password_hash($passwordAdminInicial, PASSWORD_DEFAULT),
            ];
        }
        $perfilExiste = false;
        foreach ($datos['perfiles'] as &$perfil) {
            if ($perfil['nombre'] === 'Administrador') {
                $perfil['estado'] = 1;
                $perfilExiste = true;
                break;
            }
        }
        unset($perfil);
        if (!$perfilExiste) $datos['perfiles'][] = [
            'id' => max(array_merge([0], array_column($datos['perfiles'], 'id'))) + 1,
            'estado' => 1,
            'nombre' => 'Administrador',
            'secciones' => 'Productos, Categorías, Marcas, Comentarios, Usuarios, Perfiles',
        ];
    });
}
unset($emailAdminInicial, $passwordAdminInicial, $datosAdminInicial, $usuarioInicial, $adminInicialExiste);
