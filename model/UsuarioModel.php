<?php

class UsuarioModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }



    public function validate($username, $password)
    {
        $sesion = new ManejoSesiones();
        $usuario = $sesion->iniciarSesion($username);
        if($usuario){
            $sql = "SELECT * FROM usuario WHERE nombre_usuario = ?";
            $stmt = $this->database->getConnection()->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        if ($result->num_rows === 0) {
            return false; // Usuario no existe
        }
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['contrasenia']) && $user['activo']) {
            return $user; // Usuario autenticado y activo
        }
        return false; // Credenciales incorrectas o usuario inactivo
    }

    public function activateUser($userId)
    {
        $sesion = new ManejoSesiones();
        $usuario = $sesion->obtenerUsuario();
        if ($usuario) {
            // Actualizar la cuenta del usuario para activarla
            $sql = "UPDATE usuario SET activo = 1 WHERE id = ?";
            $stmt = $this->database->getConnection()->prepare($sql);
            $stmt->bind_param("i", $userId);
            return $stmt->execute(); // Verifica si la ejecución es exitosa
        }
    }
    public function verificarNivelDeUsuario($id){
        $sql="SELECT * FROM Usuario WHERE id=?";
       $result= $this->database->execute($sql, [$id]);
    if ($result!=null){
        $total_respuestas_correctas=$result[0]['total_respuestas_correctas'];
        $total_respuestas=$result[0]['total_respuestas'];
        $porcentajeDeAcierto=($total_respuestas_correctas/$total_respuestas)*100;
        if ($porcentajeDeAcierto>=70){
            return 3;
        }elseif ($porcentajeDeAcierto<=30){
            return 1;
        }else{
            return 2;
        }

    }
    return null;
    }

}