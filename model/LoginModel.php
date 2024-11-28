<?php

class LoginModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function loginUser($nombre_usuario, $contrasenia) {

        if (empty($nombre_usuario) || empty($contrasenia)) {
            return null; // Devolver null si hay datos faltantes
        }

        $sql = "SELECT contrasenia FROM usuario WHERE nombre_usuario = ?"; //buscamos la contraseña hasheada
        $stmt1=$this->database->execute($sql,[$nombre_usuario]);

        if (empty($stmt1)) {
            return null;
        }

        $hashAlmacenado = $stmt1[0]['contrasenia'];//almacenamos la contraceña hasheada
        if ($hashAlmacenado && password_verify($contrasenia, $hashAlmacenado)) {//verificamos si la contraceña que ingreso el usuario concuerda con la contraseña hasheada en la base de datos

            // Contraseña válida
            $sql = "SELECT * FROM usuario WHERE nombre_usuario = ?"; // Usamos la clase MysqlObjectDatabase, que ya tiene la conexión manejada
            $stmt = $this->database->getConnection()->prepare($sql); // Accedemos a la conexion
            if ($stmt === false) {
                die('Error en la preparación de la consulta: ' . $this->database->getConnection()->error);
            }
            $stmt->bind_param("s", $nombre_usuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null;
            }

            $stmt->close();
        } else {
            return null;
        }

    }

}
