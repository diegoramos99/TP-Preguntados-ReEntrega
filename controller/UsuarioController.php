<?php

class UsuarioController
{

    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function mostrarInicio()
    {
        echo $this->presenter->render('inicio'); // Asume que 'inicio' es tu vista Mustache
    }

    public function auth()
    {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $validation = $this->model->validate($user, $pass);
        if ($validation) {
            if (!$validation['activo']) { // Aquí agregas la verificación de si está activo
                header('Location: /app/index.php?login&error=not_activated');
                exit();
            }
            $_SESSION['user'] = $user;
            header('location: /inicio' );
            exit();
        } else {
            header('Location: /app/index.php?login&error=invalid_credentials');
            exit();
        }
    }

    public function validar($params)
    {
        $userId = $params['id'] ?? null;
        $token = $params['token'] ?? null;
        // Verificar el usuario y el token en la base de datos
        $usuarioModel = new UsuarioModel($this->database);
        $usuario = $usuarioModel->getUserByIdAndToken($userId, $token);
        if ($usuario && !$usuario['activo']) {
            // Activar al usuario
            $usuarioModel->activateUser($userId);
            // Redirigir al login con mensaje de éxito
            header("Location: /app/index.php?login&activated=true");
            exit();
        } else {
            // Redirigir al login con mensaje de error
            header("Location: /app/index.php?login&error=activation_failed");
            exit();
        }
    }
}