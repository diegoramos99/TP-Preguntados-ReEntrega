<?php

class ManejoSesiones
{

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function limpiarCache()
    {
        $_SESSION = [];
    }

    public function iniciarSesion($usuario)
    {
        /*   if (session_status() === PHP_SESSION_NONE) {
               session_start();
           }
           */// Limpia posibles datos anteriores en $_SESSION
        $this->limpiarCache();

        $_SESSION['usuario'] = [
            'id' => $usuario['id'] ?? null,
            'nombre_usuario' => $usuario['nombre_usuario'] ?? '',
            'pais' => $usuario['pais'] ?? '',
            'ciudad' => $usuario['ciudad'] ?? '',
            'rol' => $usuario['rol'] ?? '',
            'activo' => $usuario['activo'] ?? '',
            'enLinea' => 1
        ];
    }

    public function obtenerUsuario()
    {
        return $_SESSION['usuario'] ?? null;
    }

    public function obtenerUsuarioID()
    {
        $id = $_SESSION['usuario']['id'] ?? null;
        error_log("ID de usuario obtenido: " . print_r($id, true));
        return $id;
    }

    public function cerrarSesion()
    {
        error_log("Cerrando sesión: " . print_r($_SESSION, true));
        session_unset();
        session_destroy();
    }

    public function usuarioAutenticado()
    {
        return isset($_SESSION['usuario']);
    }
}
