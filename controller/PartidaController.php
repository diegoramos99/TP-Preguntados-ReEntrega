<?php

class PartidaController
{
    private $presenter;
    private $preguntasPartidaModel;
    private $crearPartidaModel;
    private $homeModel;

    public function __construct($presenter,$preguntasPartidaModel,$crearPartidaModel,$homeModel)
    {
        $this->presenter = $presenter;
        $this->preguntasPartidaModel=$preguntasPartidaModel;
        $this->crearPartidaModel=$crearPartidaModel;
        $this->homeModel=$homeModel;

    }

    public function inicio()
    {
        // Renderiza la vista correcta
        echo $this->presenter->render('partida');
    }
    public function validarRespuesta()
    {
        $id=isset($_POST['id_partida'])?$_POST['id_partida']:null;
        $id_partida=intval($id);
        $respuesta = isset($_POST['answer'])?$_POST['answer']:null;
        $tiempo=isset($_POST['tiempo'])?$_POST['tiempo']:null;
        $tiempo_int=intval($tiempo);
        $sesion=New ManejoSesiones();
        $user = $sesion->obtenerUsuario();

        if ($respuesta!=null){
            $respuesVerificada= $this->preguntasPartidaModel->verificarRespuesta($respuesta, $user['id'],$id_partida,$tiempo_int);
            if ($respuesVerificada != null) {
                $categoria = $this->crearPartidaModel->obtenerCategoriaAlAzar();
                echo $this->presenter->render("partida", [
                    'categoria' => $categoria[0]['categoria'],
                    'id_partida' => $id_partida,
                    'Es_correcta' => $respuesVerificada
                ]);
            }else{
                $sesion = new ManejoSesiones();
                $user = $sesion->obtenerUsuario();
                $mejoresPunutajesJugador = $this->homeModel->trearMejoresPuuntajesJugadores();
                $actualizarPartida = $this->crearPartidaModel->actualizarPartida($id_partida);
                $partidas = $this->crearPartidaModel->obtenerPartidas($user['id']);
                echo $this->presenter->render('home', ['partidas' => $partidas,
                    'puntajes' => $mejoresPunutajesJugador,
                    'nombre_usuario' => $user['nombre_usuario']
                    ]);

            }
        }else{

            // Actualziar el ranking despues de jugar una partida
            $actualizarPartida = $this->crearPartidaModel->actualizarPartida($id_partida);
            $sesion = new ManejoSesiones();
            $user = $sesion->obtenerUsuario();
            $mejoresPunutajesJugador1 = $this->homeModel->trearMejoresPuuntajesJugadores();
            $partidas1 = $this->crearPartidaModel->obtenerPartidas($user['id']);
            echo $this->presenter->render('home', ['partidas' => $partidas1,
                'puntajes' => $mejoresPunutajesJugador1,
                'nombre_usuario' => $user['nombre_usuario']
            ]);
        }






    }

}