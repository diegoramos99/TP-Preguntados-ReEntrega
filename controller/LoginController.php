<?php

class LoginController
{
    private $presenter;
    private $loginModel;

    public function __construct($presenter, $loginModel)
    {
        $this->presenter = $presenter;
        $this->loginModel = $loginModel;
    }

    public function inicio()
    {
        $sesion = new ManejoSesiones();
        // Limpio la cache por si el usuario va para atras ( <- ) y NO APRETO EL BOTON DE CERRAR SESION
        $sesion->limpiarCache();
        echo $this->presenter->render('login', []);
    }

    public function validarUsuario($data)
    {
        $nombre_usuario = $data['nombre_usuario'] ?? null;
        $contrasenia = $data['contrasenia'] ?? null;

        $user = $this->loginModel->loginUser($nombre_usuario, $contrasenia);

        if ($user && isset($user['activo']) && $user['activo'] == 1) {
            $sesion = new ManejoSesiones();
            $sesion->iniciarSesion($user);
            if ($user['rol'] == 2) {
                header("Location: /app/editor");
                exit;
            }
            elseif ($user['rol'] == 3) {
                header("Location: /app/admin");
                exit;
            } else {
                header("Location: /app/home/listarPartidas");
                exit;
            }
        } else {
            echo $this->presenter->render("login", [
                'error' => 'Nombre de usuario o contraseña incorrectos'
            ]);
        }
    }

    public function cerrarSesion()
    {
        $sesion = new ManejoSesiones();
        $sesion->cerrarSesion();
        header("Location: /app/login");
        exit;
    }

}


