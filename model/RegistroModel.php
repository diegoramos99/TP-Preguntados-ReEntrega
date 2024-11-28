<?php

class RegistroModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

  /*  public function createUser($data)
    {
        $this->database->execute("INSERT INTO usuario (nombre,nombre_usuario, contrasenia,fecha_nacimiento,pais,sexo,ciudad,email) VALUES ('$data[nombre]', '$data[nombre_usuario]', '$data[contrasenia]', '$data[fecha_nacimiento]', '$data[pais]', '$data[sexo]', '$data[ciudad]', '$data[email]')");
    }*/

    // modificacion del metodo
    public function createUser($data,$token) {
        $sql = "INSERT INTO usuario (nombre, nombre_usuario, contrasenia, fecha_nacimiento, pais, sexo, ciudad, email,token)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $params = [
            $data['nombre'],
            $data['nombre_usuario'],
            $data['contrasenia'],
            $data['fecha_nacimiento'],
            $data['pais'],
            $data['sexo'],
            $data['ciudad'],
            $data['email'],
            $token
        ];

        return $this->database->execute($sql, $params);
    }
    public function validarToken($userId, $token)
    {
        // Aquí haces la consulta a la base de datos para verificar el token
        $sql = "SELECT * FROM usuario WHERE id = ? AND token = ?";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param("is", $userId, $token);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0; // Devuelve verdadero si hay una coincidencia
    }

    public function activarUsuario($userId,$token)
    {

          if ($this->validarToken($userId,$token)){

        // Actualizar la cuenta del usuario para activarla
        $sql = "UPDATE usuario SET activo = 1 WHERE id = ?";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        }
   }
    public function verificarNombreUsuario($nombre_usuario)
    {
        $query = $this->database->getConnection()->prepare("SELECT COUNT(*) FROM usuario WHERE nombre_usuario = ?");

        // Cambiar `bindParam` por `bind_param` y especificar el tipo de parámetro (en este caso, "s" para string)
        $query->bind_param("s", $nombre_usuario);

        $query->execute();
        $result = $query->get_result();
        $count = $result->fetch_row()[0];

        return $count > 0; // Devuelve true si el nombre de usuario ya existe
    }

}
