<?php

class AdminModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function traerPreguntasCorrectas(){
        $sql = "SELECT * FROM Pregunta ";

        $result= $this->database->execute($sql, []);

        $correctas=0;
        $incorrectas=0;
        foreach ($result as $respuestas){
        $respuestasCorrectas=$respuestas['acertada'];
        $respuestasIncorrectas=$respuestas['mostrada']-$respuestas['acertada'];

        $correctas+=$respuestasCorrectas;
        $incorrectas+=$respuestasIncorrectas;
        }
        $sumaDeAmbas=$correctas+$incorrectas;
        $porcentajeCorrectas =round(($correctas / $sumaDeAmbas) * 100, 2) ;
        $porcentajeIncorrectas = round( ($incorrectas / $sumaDeAmbas) * 100,2);

        $correctaseIncorrectas=[$porcentajeCorrectas,$porcentajeIncorrectas];
        return $correctaseIncorrectas;
    }
    public function clasificarUsuariosPorEdad() {
        $sql = "SELECT id, nombre, fecha_nacimiento FROM Usuario";
        $result = $this->database->execute($sql, []);

        // Arreglos para clasificar usuarios
        $totalNiños = 0;
        $totalAdolescentes = 0;
        $totalAdultos = 0;
        $totalAncianos = 0;

        // Recorrer los resultados
        foreach ($result as $row) {
            $fechaNacimiento = $row['fecha_nacimiento'];
            $edad = $this->calcularEdad($fechaNacimiento);

            // Clasificar por edad
            if ($edad < 10) {
                $totalNiños++;
            } elseif ($edad < 20) {
                $totalAdolescentes++;
            } elseif ($edad < 40) {
                $totalAdultos++;
            } else {
                $totalAncianos++;
            }
        }
        $totalUsuarios = $totalNiños + $totalAdolescentes + $totalAdultos + $totalAncianos;

        // Calcular porcentajes
        $porcentajeNiños = round(($totalNiños / $totalUsuarios) * 100, 2);
        $porcentajeAdolescentes = round(($totalAdolescentes / $totalUsuarios) * 100, 2);
        $porcentajeAdultos = round(($totalAdultos / $totalUsuarios) * 100, 2);
        $porcentajeAncianos = round(($totalAncianos / $totalUsuarios) * 100, 2);
        // Retornar los resultados clasificados
        return [
            $porcentajeNiños,
            $porcentajeAdolescentes,
            $porcentajeAdultos,
            $porcentajeAncianos
        ];
    }

// Función auxiliar para calcular la edad a partir de la fecha de nacimiento
    private function calcularEdad($fechaNacimiento) {
        $fechaNac = new DateTime($fechaNacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNac)->y;
        return $edad;
    }





}