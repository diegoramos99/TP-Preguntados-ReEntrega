<?php

class CrearPreguntaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function crearSugerenciaPregunta($data, $id_usuario)
    {
        // Ajustamos la consulta SQL. Eliminamos 'ID' si es una columna autoincremental.
        $sql = "INSERT INTO sugerencia (pregunta, opcionA, opcionB, opcionC, opcionD, opcionCorrecta, categoria, Usuario_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Ajustamos los parámetros para coincidir con la consulta
        $params = [
            $data['Pregunta'],
            $data['OpcionA'],
            $data['OpcionB'],
            $data['OpcionC'],
            $data['OpcionD'],
            $data['OpcionCorrecta'],
            $data['Categoria'],
            $id_usuario
        ];

        // Ejecutamos la consulta
        $this->database->execute($sql, $params);
    }

    public function obtenerPreguntasSugeridas()
    {
        $sql = "SELECT * FROM sugerencia";
        try {

            $result = $this->database->execute($sql, []);
            return $result;
        } catch (PDOException $e) {
            error_log("Error al obtener preguntas sugeridas: " . $e->getMessage());
            // Maneja el error adecuadamente
        }

    }

    public function eliminarPregunta($id){
        $sql = "DELETE FROM sugerencia WHERE ID = ?";
        $this->database->execute($sql, [$id]);
    }

    public function agregarPregunta($pregunta, $opcionA, $opcionB, $opcionC, $opcionD, $opcionCorrecta, $categoria)
    {
        // Obtener id de categoria
        $idCategoria = $this->obtenerCategoria($categoria); // Llama a obtenerCategoria usando $this

        // agregar pregunta
        $sqlPregunta = "INSERT INTO Pregunta (Pregunta, Dificultad, Categoria_id,mostrada,acertada) VALUES (?, ?, ?,?,?)";
        $dificultad = 1; // Nivel de dificultad predeterminado
        $this->database->execute($sqlPregunta, [$pregunta, $dificultad, $idCategoria,1,1]);

        // Obtener el ID de la última pregunta insertada
        $sqlLastInsertId = "SELECT ID FROM Pregunta ORDER BY ID DESC LIMIT 1    ";
        $result = $this->database->execute($sqlLastInsertId,[]);

        if (count($result) > 0) {
            $preguntaId = $result[0]['ID'];
        } else {
            throw new Exception("No se pudo obtener el ID de la última pregunta.");
        }
        switch ($opcionCorrecta){
            case "A" :
                $this->insertarRespuesta($opcionA, 1, $preguntaId);
                $this->insertarRespuesta($opcionB, 0, $preguntaId);
                $this->insertarRespuesta($opcionC, 0, $preguntaId);
                $this->insertarRespuesta($opcionD, 0, $preguntaId);
                break;
            case "B":
                $this->insertarRespuesta($opcionA, 0, $preguntaId);
                $this->insertarRespuesta($opcionB, 1, $preguntaId);
                $this->insertarRespuesta($opcionC, 0, $preguntaId);
                $this->insertarRespuesta($opcionD, 0, $preguntaId);
                break;
            case "C":
                $this->insertarRespuesta($opcionA, 0, $preguntaId);
                $this->insertarRespuesta($opcionB, 0, $preguntaId);
                $this->insertarRespuesta($opcionC, 1, $preguntaId);
                $this->insertarRespuesta($opcionD, 0, $preguntaId);
                Break;
            case "D":
                $this->insertarRespuesta($opcionA, 0, $preguntaId);
                $this->insertarRespuesta($opcionB, 0, $preguntaId);
                $this->insertarRespuesta($opcionC, 0, $preguntaId);
                $this->insertarRespuesta($opcionD, 1, $preguntaId);
                Break;
            default:

                break;
        }


    }

    public function ObtenerTodosLosUsuarios()
    {
        $sql = "SELECT * FROM usuario";
        $result =$this->database->execute($sql,[]);
        return $result;
    }
    // Función para insertar las respuestas
    private function insertarRespuesta($respuesta, $esCorrecta, $preguntaId)
    {
        $sqlRespuesta = "INSERT INTO respuesta (Texto_respuesta, Es_correcta, Pregunta_id) VALUES (?, ?, ?)";
        $this->database->execute($sqlRespuesta, [$respuesta, $esCorrecta, $preguntaId]);
    }

    public function obtenerCategoria($categoria)
    {

        switch ($categoria) {
            case "Arte" :
                return 1;
                break;
            case "Cine":
                return 2;
                break;
            case "Deportes":
                return 3;
                break;
            case "Historia":
                return 4;
                break;
            case "Ciencia":
                return 5;
                break;
            case "Geografía":
                return 6;
                break;
            default:
                break;
        }

    }

    function actualizarPregunta($db, $id, $pregunta, $opcionA, $opcionB, $opcionC, $opcionD, $opcionCorrecta, $categoria) {
        $sql = "UPDATE Sugerencia 
            SET Pregunta = ?, OpcionA = ?, OpcionB = ?, OpcionC = ?, OpcionD = ?, OpcionCorrecta = ?, Categoria = ?
            WHERE ID = ?";

        // Ejecutar la consulta
        $resultado = $db->execute($sql, [$pregunta, $opcionA, $opcionB, $opcionC, $opcionD, $opcionCorrecta, $categoria, $id]);

        // Verificar si se actualizó alguna fila
        if ($resultado['affected_rows'] > 0) {
            echo "Pregunta actualizada exitosamente.";
        } else {
            echo "Advertencia: No se actualizó ninguna fila. Verifica si los datos son idénticos a los almacenados.";
        }
    }
    public function modificarPreguntaSugerida($pregunta, $opcionA, $opcionB, $opcionC, $opcionD, $opcionCorrecta, $categoria,$idUsuario,$ID) {
        $sql = "UPDATE Sugerencia 
        SET Pregunta = ?, OpcionA = ?, OpcionB = ?, OpcionC = ?, OpcionD = ?, OpcionCorrecta = ?, Categoria = ?, Usuario_id = ?
        WHERE ID = ?";



        return $this->database->execute($sql, [

            $pregunta,
            $opcionA,
            $opcionB,
            $opcionC,
            $opcionD,
            $opcionCorrecta,
            $categoria,
            $idUsuario,
            $ID
        ]);
    }

    public function obtenerReportes()
    {
                $sql = "SELECT p.Pregunta AS texto_pregunta,r.* 
                FROM reporte r
                INNER JOIN Pregunta p ON r.Pregunta_id = p.ID";

                try {

                    $result = $this->database->execute($sql, []);
                    return $result;
                } catch (PDOException $e) {
                    error_log("Error al obtener preguntas sugeridas: " . $e->getMessage());
                }
            }

    public function eliminarReporte($idReporte){
        $sql = "DELETE FROM reporte WHERE ID = ?";
        $this->database->execute($sql, [$idReporte]);
    }

    public function eliminarRespuestas($idPregunta) {
        $sql = "DELETE FROM respuesta WHERE Pregunta_id = ?";
        $this->database->execute($sql, [$idPregunta]);
    }
    public function eliminarPreguntaRe($idPregunta){
        $sql = "DELETE FROM pregunta WHERE ID = ?";
        $this->database->execute($sql, [$idPregunta]);
    }
    public function eliminarReporteRelacionado($idPregunta) {
        $sql = "DELETE FROM reporte WHERE Pregunta_id = ?";
        $this->database->execute($sql, [$idPregunta]);
    }
}
