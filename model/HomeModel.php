<?php

class HomeModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function trearMejoresPuuntajesJugadores()
    {
        $sql = "SELECT 
        u.nombre_usuario,
         p.ID AS id_partida,
         p.Puntuacion,
        p.Puntuacion_porcentaje,
        p.Fecha_creada
        FROM 
        Usuario u
        JOIN 
        Partida p ON u.id = p.Usuario_id
        WHERE 
         p.Puntuacion = (
        SELECT MAX(p2.Puntuacion)
        FROM Partida p2
        WHERE p2.Usuario_id = u.id
    )
ORDER BY 
    p.Puntuacion DESC;
";
        try {

            $result = $this->database->execute($sql, []);
            return $result;
        } catch (PDOException $e) {
            error_log("Error al traer los datos: " . $e->getMessage());
            // Maneja el error adecuadamente
        }
    }



}

