<?php

class PerfilController
{
    private $presenter;
    private $crearPartidaModel;


    public function __construct($presenter,$crearPartidaModel)
    {
        $this->crearPartidaModel=$crearPartidaModel;
        $this->presenter = $presenter;
    }

    public function inicio()
    {
        $sesion = new ManejoSesiones();
        $usuario = $sesion->obtenerUsuario();
        $username = $usuario['nombre_usuario'] ?? 'Invitado';
        $pais = $usuario['pais'] ?? 'Invitado';
        $ciudad = $usuario['ciudad'] ?? 'Invitado';
        $fotoIMG = $usuario['fotoIMG'] ?? 'Invitado';
        $partidas=$this->crearPartidaModel->obtenerPartidasFinalizadas($usuario['id']);

        if($username=='Invitado' )
            header("Location: /app/login");

        echo $this->presenter->render('perfil', [
            'nombre_usuario' => $username,
            'pais' => $pais,
            'ciudad' => $ciudad,
            'fotoIMG' => $fotoIMG,
            'partidas' => $partidas

        ]);
    }
}

