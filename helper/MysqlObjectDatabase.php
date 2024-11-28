<?php
class MysqlObjectDatabase
{
    private $conn;
    public function __construct($host, $port, $username, $password, $database)
    {
        $this->conn = new mysqli($host, $username, $password, $database, $port);
    }

    public function query($sql){
        $result = $this->conn->query($sql);
        return  $result->fetch_all( MYSQLI_ASSOC );
    }

   /* public function execute($sql){
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }*/

    public function execute($sql, $params = []) {
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt === false) {
            throw new mysqli_sql_exception(mysqli_error($this->conn));
        }

        // Vincular los parámetros
        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Suponiendo que todos los parámetros son strings
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }

        // Ejecutar la consulta
        $result = mysqli_stmt_execute($stmt);

        if ($result === false) {
            mysqli_stmt_close($stmt); // Cerrar el stmt antes de lanzar la excepción
            throw new mysqli_sql_exception(mysqli_error($this->conn));
        }

        // Obtener el número de filas afectadas antes de cerrar el stmt
        $affectedRows = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt); // Cerrar el stmt después de obtener las filas afectadas

        return $affectedRows;
    }


    public function __destruct()
    {
        $this->conn->close();
    }
}
