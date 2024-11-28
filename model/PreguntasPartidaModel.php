<?php

class PreguntasPartidaModel{
    private $database;
    public function __construct($database)
    {
        $this->database = $database;
    }
    public function buscarPregunta($categoria,$nivelDeUsuario)
    {
        $sql = "SELECT P.* FROM Pregunta P INNER JOIN Categoria C ON P.Categoria_id = C.ID
                WHERE C.Categoria =? and p.Dificultad= ?";


        $sql1 = "SELECT * FROM Pregunta P";
        $result=$this->database->execute($sql1,[]);
        foreach ($result as $pregunta){ //en este for each actualizo la dificultad de cada pregunta de la base de datos
            $mostrada=$pregunta['mostrada'];
            $acertada=$pregunta['acertada'];
            $dificultad=($acertada/$mostrada)*100;

            if ($pregunta['ID']!=3 &&
                $pregunta['ID']!=4 &&
                $pregunta['ID']!=7 &&
                $pregunta['ID']!=6 &&
                $pregunta['ID']!=14 &&
                $pregunta['ID']!=15 &&
                $pregunta['ID']!=18 &&
                $pregunta['ID']!=17 &&
                $pregunta['ID']!=21 &&
                $pregunta['ID']!=22 &&
                $pregunta['ID']!=27 &&
                $pregunta['ID']!=30
                ){


            if ($dificultad>=70){
                $sql_actualizarDificultad="UPDATE Pregunta
                SET Dificultad = 1
                WHERE ID = ?";
                $this->database->execute($sql_actualizarDificultad,[$pregunta['ID']]);


            }elseif ($dificultad<=30){
                $sql_actualizarDificultad="UPDATE Pregunta
                SET Dificultad = 3
                WHERE ID = ?";
                $this->database->execute($sql_actualizarDificultad,[$pregunta['ID']]);

            }else{
                $sql_actualizarDificultad="UPDATE Pregunta
                SET Dificultad = 2
                WHERE ID = ?";
                $this->database->execute($sql_actualizarDificultad,[$pregunta['ID']]);
            }
            }
        }
        try {

            $result=$this->database->execute($sql,[$categoria,$nivelDeUsuario]);
            $min = 0; // Este debe ser el índice mínimo
            $max = count($result) - 1; // Este debe ser el índice máximo, ajustando según tu arreglo
            $randomIndex = rand($min, $max);

            return $result[$randomIndex];
        } catch (PDOException $e) {
            error_log("Error al crear partida: " . $e->getMessage());
            // Maneja el error adecuadamente
        }
    }
    public function traerRespuestasDePregunta($id){
        $sql = "SELECT * FROM Respuesta WHERE pregunta_id=? ";

        try {

            // $stmt = $this->database->prepare($sql);
            $result=$this->database->execute($sql,[$id]);
            shuffle($result);
            return $result;
        } catch (PDOException $e) {
            error_log("Error al traer las respuestas: " . $e->getMessage());
            // Maneja el error adecuadamente
        }
    }


    public function verificarRespuesta($respuesta, $userID, $id_partida,$tiempo)
    {
        if ($tiempo==0){
            $sql1_buscaPregunta="SELECT p.*
                        FROM Pregunta p
                        JOIN Respuesta r ON p.ID = r.Pregunta_id
                        WHERE r.Texto_respuesta = ?"; //busca pregunta que tenga como campo pregunta la respuesta que envio el usuario

            $pregunta=$this->database->execute($sql1_buscaPregunta, [$respuesta]);

            $sql_actualizaPreguntaErrada = "UPDATE Pregunta
                                            SET mostrada = mostrada + 1
                                            WHERE Pregunta=?"; //si no es acertada solo suma un punto en el campo mostrada

            $sql_ActualizarUsuario_respondeMal="UPDATE Usuario
                                            SET total_respuestas =total_respuestas + 1
                                            WHERE id=?";

            $this->database->execute($sql_actualizaPreguntaErrada, [$pregunta[0]['Pregunta']]);
            $this->database->execute($sql_ActualizarUsuario_respondeMal, [$userID]);
            return null;
        }
        $sql = "SELECT * FROM Respuesta 
            WHERE Texto_respuesta = ?";

        $sql1_buscaPregunta="SELECT p.*
                        FROM Pregunta p
                        JOIN Respuesta r ON p.ID = r.Pregunta_id
                        WHERE r.Texto_respuesta = ?"; //busca pregunta que tenga como campo pregunta la respuesta que envio el usuario
        try {
            $result = $this->database->execute($sql, [$respuesta]);
            $pregunta=$this->database->execute($sql1_buscaPregunta, [$respuesta]);
            if ($result && $result[0]['Es_correcta']) {

                $sql_actualizaPreguntaAcertada = "UPDATE Pregunta
                                            SET mostrada = mostrada + 1,
                                                acertada = acertada + 1
                                            WHERE Pregunta=?";// si la encuentra y es correcta actualiza los campo mostrada ya certada un punto mas

                $sql_ActualizarUsuario_respondeBien="UPDATE Usuario
                                            SET total_respuestas_correctas = total_respuestas_correctas + 1,
                                                total_respuestas =total_respuestas + 1
                                            WHERE id=?";


                $sql = "UPDATE Partida SET puntuacion = puntuacion + 1 
                    WHERE Usuario_id = ? AND ID = ?";

                try {
                    $this->database->execute($sql, [$userID, $id_partida]);
                    $this->database->execute($sql_actualizaPreguntaAcertada, [$pregunta[0]['Pregunta']]);
                    $this->database->execute($sql_ActualizarUsuario_respondeBien, [$userID]);

                    return $result;
                } catch (PDOException $e) {
                    error_log("Error al actualizar el puntaje en la partida: " . $e->getMessage());
                    return null;
                }
            }else{
                $sql_actualizaPreguntaErrada = "UPDATE Pregunta
                                            SET mostrada = mostrada + 1
                                            WHERE Pregunta=?"; //si no es acertada solo suma un punto en el campo mostrada

                $sql_ActualizarUsuario_respondeMal="UPDATE Usuario
                                            SET total_respuestas =total_respuestas + 1
                                            WHERE id=?";

              $this->database->execute($sql_actualizaPreguntaErrada, [$pregunta[0]['Pregunta']]);
                $this->database->execute($sql_ActualizarUsuario_respondeMal, [$userID]);

            }

            return null;
        } catch (PDOException $e) {
            error_log("Error al verificar respuesta: " . $e->getMessage());
            return null;
        }
    }

    public function crearReportePregunta($data, $idUsuario){
        $sql = "INSERT INTO reporte (Pregunta_id, Descripcion, Usuario_id)
            VALUES (?,?,?)";

        $params = [
            $data['Pregunta_id'],
            $data['Descripcion'],
            $idUsuario
        ];
        $this->database->execute($sql, $params);
    }

}


















?>