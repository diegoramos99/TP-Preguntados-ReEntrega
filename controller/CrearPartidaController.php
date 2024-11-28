<?php

class CrearPartidaController
{

    private $presenter;
    private $crearPartidaModel;
    private $homeModel;
    public function __construct($presenter,$crearPartidaModel,$homeModel)
    {
        $this->presenter = $presenter;
        $this->crearPartidaModel = $crearPartidaModel;
        $this->homeModel=$homeModel;

    }

    public function inicio()
    {
        $sesion = new ManejoSesiones();
        $usuario = $sesion->obtenerUsuario();
        $id_usuario = $sesion->obtenerUsuarioID();
        $username = $usuario['nombre_usuario'] ?? 'Invitado';
        $id = $usuario['id'] ?? 'Invitado';

        if($username=='Invitado')
            header("Location: /app/login");

        echo $this->presenter->render('crearPartida',[
            'nombre_usuario' => $username,
            'id' => $id,


        ]);
    }

    public function obtenerDatosDePartida() {
        $sesion = new ManejoSesiones();
        $id_usuario = $sesion->obtenerUsuarioID();
        $descripcion = $_POST['descripcion'];
        echo ($id_usuario);
        if(!$id_usuario){
            header("Location: index.php?page=login");
            exit();
        }
        else{
            $descripcion = $_POST['descripcion'];
            $this->crearPartidaModel->crearPartida($descripcion, $id_usuario);
            header("Location: index.php?page=home");
            exit();

        }

    }
    public function guardarPartida(){
        $sesion=New ManejoSesiones();
        $user = $sesion->obtenerUsuario();
        $descripcion=isset($_POST['descripcion'])?$_POST['descripcion']:null;
        $result=$this->crearPartidaModel->crearPartida($descripcion,$user['id']);
        $partida=$this->crearPartidaModel->buscarPorID($result['user_id']);
        $cantRegistros=count($partida);
        $cantRegistros-=1;

        $partidas=$this->crearPartidaModel->obtenerPartidas($user['id']);
        $mejoresPunutajesJugador=$this->homeModel->trearMejoresPuuntajesJugadores();

        echo $this->presenter->render('home', ['partidas'=>$partidas,
            'nombre_usuario'=>$user['nombre_usuario'],
            'puntajes'=>$mejoresPunutajesJugador,

        ]);

    }



    public function jugarPartida(){
  //  $id_partida=isset($_GET['ID'])?$_GET['id_partida']:null;

        $url = $_SERVER['REQUEST_URI'];

        // Dividir la URL en partes (separadas por '/')
        $parts = explode('/', $url);

        // Capturar el último elemento (que sería el ID)
        $id_partida = end($parts);

        // Validar que sea un número o manejar errores
        $id_partida = is_numeric($id_partida) ? $id_partida : null;
        $sesion = new ManejoSesiones();
        $usuario = $sesion->obtenerUsuario();
        $username = $usuario['nombre_usuario'] ?? 'Invitado';

    $categoria=$this->crearPartidaModel-> obtenerCategoriaAlAzar();

        echo $this->presenter->render("partida", [
            'categoria'=>$categoria[0]['categoria'],
            'id_partida'=> $id_partida,
            'nombre_usuario'=>$username
        ]);

    }



}