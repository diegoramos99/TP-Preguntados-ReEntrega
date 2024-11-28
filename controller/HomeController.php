<?php

class HomeController
{
    private $presenter;
    private $crearPartidaModel;
    private $homeModel;
    private $crearPreguntaModel;

    public function __construct($presenter, $homeModel, $crearPartidaModel, $crearPreguntaModel)
    {
        $this->presenter = $presenter;
        $this->crearPartidaModel = $crearPartidaModel;
        $this->homeModel = $homeModel;
        $this->crearPreguntaModel = $crearPreguntaModel;

    }

    public function inicio()
    {
        $sesion = new ManejoSesiones();
        $usuario = $sesion->obtenerUsuario();
        $username = $usuario['nombre_usuario'] ?? 'Invitado';
        $id_usuario = $sesion->obtenerUsuarioID();
        $id = $usuario['id'] ?? 'Invitado';

        // Valido que el usuario tenga la sesion iniciada, sino lo mando al login
        if ($username == 'Invitado')
            header("Location: /app/login");

        echo $this->presenter->render('home', [
            'nombre_usuario' => $username,
            'id' => $id
        ]);
    }

    public function listarPartidas()
    {
        $sesion = new ManejoSesiones();
        $user = $sesion->obtenerUsuario();
        $id_usuario = $sesion->obtenerUsuarioID();
        $id = $usuario['id'] ?? 'Invitado';
        $username = $user['nombre_usuario'] ?? 'Invitado';


        // Valido que el usuario tenga la sesion iniciada, sino lo mando al login
        if ($username == 'Invitado')
            header("Location: /app/login");

        $partidas = $this->crearPartidaModel->obtenerPartidas($user['id']);
        $mejoresPunutajesJugador = $this->homeModel->trearMejoresPuuntajesJugadores();

        echo $this->presenter->render('home', ['partidas' => $partidas,
            'puntajes' => $mejoresPunutajesJugador,
            'nombre_usuario' => $user['nombre_usuario'],
            'id' => $id_usuario

        ]);
    }

    public function usuarioSugerirPregunta()
    {
        // Inicializa la sesión y obtiene al usuario
        $sesion = new ManejoSesiones();
        $id_usuario = $sesion->obtenerUsuarioID();

        $data = [
            'Pregunta' => $_POST['pregunta'] ?? '',
            'OpcionA' => $_POST['optionA'] ?? '',
            'OpcionB' => $_POST['optionB'] ?? '',
            'OpcionC' => $_POST['optionC'] ?? '',
            'OpcionD' => $_POST['optionD'] ?? '',
            'OpcionCorrecta' => $_POST['opcionCorrecta'] ?? '',
            'Categoria' => $_POST['categoriaElegida'] ?? ''
        ];

        // Llamar al modelo para crear la sugerencia de pregunta
        $this->crearPreguntaModel->crearSugerenciaPregunta($data, $id_usuario);
        $partidas = $this->crearPartidaModel->obtenerPartidas($id_usuario);
        $mejoresPunutajesJugador = $this->homeModel->trearMejoresPuuntajesJugadores();
        $user = $sesion->obtenerUsuario();
        echo $this->presenter->render('home', [
            'partidas' => $partidas,
            'puntajes' => $mejoresPunutajesJugador,
            'nombre_usuario' => $user['nombre_usuario']
        ]);
        // Redirigir a la vista home
        //header('Location: index.php?page=home');
        /* header("Location: home");
         exit();*/
    }
}


