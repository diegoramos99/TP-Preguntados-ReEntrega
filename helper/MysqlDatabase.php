<?php
class MysqlDatabase
{
    private $conn;
    public function __construct($host, $port, $username, $password, $database)
    {
        $this->conn = mysqli_connect($host, $username, $password, $database, $port);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    // Agrego esto para que funcione la bdd con sesiones
    public function getConnection() {
        return $this->conn;
    }

    /*
    public function query($sql){
        $result = mysqli_query($this->conn, $sql);
        return  mysqli_fetch_all($result, MYSQLI_ASSOC);
    }*/

    public function query($sql) {
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function execute($sql, $params = []) {
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt === false) {
            throw new mysqli_sql_exception(mysqli_error($this->conn));
        }

        // Vincular los parámetros
        if (!empty($params)) {
            $types = '';
            foreach ($params as $param) {
                $types .= is_int($param) ? 'i' : 's'; // 'i' para enteros, 's' para strings
            } // Asumiendo que todos los parámetros son strings
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }

        // Ejecutar la consulta
        $result = mysqli_stmt_execute($stmt);

        if ($result === false) {
            mysqli_stmt_close($stmt); // Cerrar el stmt antes de lanzar la excepción
            throw new mysqli_sql_exception(mysqli_error($this->conn));
        }
        if (stripos($sql, 'SELECT') === 0) {
            // Obtener el resultado de la consulta
            $resultSet = mysqli_stmt_get_result($stmt);
            $data = mysqli_fetch_all($resultSet, MYSQLI_ASSOC);
            mysqli_free_result($resultSet);
            mysqli_stmt_close($stmt); // Cerrar el stmt después de obtener los resultados
            return $data; // Devuelve todos los resultados como un array asociativo
        } else {
            // Para consultas que no son SELECT
            $affectedRows = mysqli_stmt_affected_rows($stmt);
            $insertedId = mysqli_insert_id($this->conn); // ID del último registro insertado
            mysqli_stmt_close($stmt); // Cerrar el stmt después de obtener las filas afectadas

            return [
                'affected_rows' => $affectedRows,
                'user_id' => $insertedId
            ];
        }
    }


    /*
    public function execute($sql){
        mysqli_query($this->conn, $sql);
        return $this->conn->affected_rows;
    }*/



    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}
