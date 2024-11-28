<?php

class PreguntasPartidaController
{

    private $presenter;
    private $preguntaPartidaModel;
    private $usuarioModel;
    private $crearPartidaModel;

    public function __construct($presenter,$preguntaPartidaModel,$usuarioModel,$crearPartidaModel)
    {
        $this->presenter = $presenter;
        $this->preguntaPartidaModel=$preguntaPartidaModel;
        $this->usuarioModel=$usuarioModel;
        $this->crearPartidaModel=$crearPartidaModel;

    }

    public function inicio()
    {
        // Renderiza la vista correcta
        echo $this->presenter->render('preguntasPartida');
    }


    public function mostrarPregunta(){
        $id_partida=isset($_GET['id_partida'])?$_GET['id_partida']:null;
        $sesion=New ManejoSesiones();
        $user = $sesion->obtenerUsuario();
        $username = $user['nombre_usuario'] ?? 'Invitado';


        $categoria=isset($_GET['categoria'])?$_GET['categoria']:null;
        $nivelUsuario=$this->usuarioModel->verificarNivelDeUsuario($user['id']);
        $pregunta=$this->preguntaPartidaModel->buscarPregunta($categoria,$nivelUsuario);
        $opcion =$this->preguntaPartidaModel->traerRespuestasDePregunta($pregunta['ID']);


        $data=[
            'pregunta'=>$pregunta['Pregunta'],
            'id_pregunta'=>$pregunta['ID'],
           'opcion1'=>$opcion[0]['Texto_respuesta'],
            'opcion2'=>$opcion[1]['Texto_respuesta'],
           'opcion3'=>$opcion[2]['Texto_respuesta'],
           'opcion4'=>$opcion[3]['Texto_respuesta'],
            'id_partida'=>$id_partida,
            'categoria' => $categoria,
          //  'Es_correcta' =>  $respuesVerificada,
            'nombre_usuario' => $username

        ];

        echo $this->presenter->render('preguntasPartida',$data);
     //  print_r($respuesVerificada);
      //  print_r(1);

    }

    public function reportarPregunta() {
        $sesion = new ManejoSesiones();
        $usuario = $sesion->obtenerUsuario();
        $id_usuario = $sesion->obtenerUsuarioID();
        $idUsuario = $usuario['id'] ?? 'Invitado';

        if (isset($_POST['descripcionSeleccionada']) && isset($_POST['id_pregunta'])) {

            $data = [
                'Pregunta_id' => $_POST['id_pregunta'],
                'Descripcion' => $_POST['selectMotivo'],
                'Usuario_id' => $idUsuario
            ];

         /* Hay que actualzar la partida,agregarle la partida que finalizo asi se muestra en  el perfil,lo mismo con el temporatizador cuando esta en 0
            $partidas = $this->crearPartidaModel->obtenerPartidas($id_usuario);
            $id=isset($_POST['id_partida'])?$_POST['id_partida']:null;
            $id_partida=intval($id);
            $actualizarPartida = $this->crearPartidaModel->actualizarPartida($id_partida);
*/
            $this->preguntaPartidaModel->crearReportePregunta($data, $idUsuario);
            $partidas=$this->crearPartidaModel->obtenerPartidas($usuario['id']);

            echo $this->presenter->render('home', ['partidas' => $partidas
            ]);

        } else {
            echo "Faltan datos en el formulario.";
        }
    }



}