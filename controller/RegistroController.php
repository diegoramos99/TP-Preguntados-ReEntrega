<?php

class RegistroController
{
    private $presenter;
    private $registroModel;
    private $senderEmailPHPMailer;


    public function __construct($presenter, $registroModel,$senderEmailPHPMailer)
    {
        $this->presenter = $presenter;
        $this->registroModel = $registroModel;
        $this->senderEmailPHPMailer = $senderEmailPHPMailer;

    }

    public function inicio()
    {
        // Renderizar la vista del inicio
        echo $this->presenter->render('registro');
    }

    public function register($data)
    {
        $errors = [];

        // Validar email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) || strpos($data['email'], '@gmail.com') === false) {
            $errors[] = 'El email debe ser un Gmail válido.';
        }

        // Validar que el usuario sea unico
        if ($this->registroModel->verificarNombreUsuario($data['nombre_usuario'])){
            $errors[] = 'El nombre de usuario ya existe.';
        }

        // Validar contraseña
        if (strlen($data['contrasenia']) < 5 || !preg_match('/[A-Za-z]/', $data['contrasenia']) || !preg_match('/[0-9]/', $data['contrasenia'])) {
            $errors[] = 'La contraseña debe tener al menos 5 caracteres, incluyendo al menos 1 letra y 1 número.';
        }

        // Verificar que la contraseña y la repetición coincidan
        if ($data['contrasenia'] !== $data['repeatPassword']) {
            $errors[] = 'Las contraseñas no coinciden.';
        }

        // mostrar los errores,si es que hay
        if (!empty($errors)) {
            echo $this->presenter->render('registro', ['errors' => $errors]);
            return;
        }
        //En el tp dice de hascodear la contraseña como lo hicimos con la pokedex
        //El tema es que para loguearte hay que ver en la tabla usuario y obtener el codigo por que no se por que no puedo usar la contraseña que creas
        // Hashear la contraseña
        $data['contrasenia'] = password_hash($data['contrasenia'], PASSWORD_DEFAULT);
        // Generar un token antes de crear el usuario
        $token = bin2hex(random_bytes(16));
        $userID =  $this->registroModel->createUser($data,$token); // Pasar el token aquí
        if ($userID['affected_rows']) {
            // Aquí ya no necesitas validar el token porque el usuario se creó
            // Activar el usuario (si es necesario, según tu lógica)
           // $this->registroModel->activarUsuario($userID[1]); // O maneja la activación según sea necesario
            $this->senderEmailPHPMailer->sendActivationEmail($userID['user_id'], $data['email'], $token);
        } else {
            echo "Error al registrar el usuario.";
        }
        echo $this->presenter->render('login', ['success' => 'Revisa tu correo para activar tu cuenta.']);
    }
    public function  activarCuenta()
    {
       $token=isset($_GET['token'])?$_GET['token']:null;
        $idUser=isset( $_GET['id'])?$_GET['id']:null;
        if ($idUser!=null){
        $this->registroModel->activarUsuario($idUser,$token);

        }
        echo $this->presenter->render('login');

    }
}
