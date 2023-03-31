<?php
if (class_exists("class_db") != true) {
    class class_db
    {
        var $db_conn;
        var $db_name;
        var $db_query;

        function __construct()
        {
            $this->set_db('localhost', 'root', '', 'mydb');
        }

        function __destruct()
        {
            $this->close_db();
        }

        function set_db($host, $user, $password, $db)
        {
            if (!isset($this->db_conn)) {
                $this->db_conn = mysqli_connect($host, $user, $password, $db);
                $this->db_name = $db;

                if (!$this->db_conn) {
                    echo "Error: no se puedo conectar a mysql" . PHP_EOL;
                    echo "ErrNO" . mysqli_connect_errno() . PHP_EOL;
                    echo "Depuracion" . mysqli_connect_error() . PHP_EOL;
                }
            }
        }

        function close_db()
        {
            if (isset($this->db_conn)) {
                if (mysqli_ping($this->db_conn)) {
                    mysqli_close($this->db_conn);
                }
                unset($this->db_conn);
            }
        }


        function set_sql($sql)
        {
            $this->db_query = $sql;
        }

        function get_ticket_counts_by_municipio_and_status()
        {
            // Ejecutar la consulta SQL
            $result = mysqli_query($this->db_conn, "SELECT ID_MUNICIPIO, ESTATUS, COUNT(*) AS NUM_TICKETS FROM ticket GROUP BY ID_MUNICIPIO, ESTATUS");

            // Verificar si la consulta tuvo éxito
            if (!$result) {
                echo "Error al ejecutar la consulta: " . mysqli_error($this->db_conn);
                return false;
            }

            // Procesar los resultados de la consulta
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $municipio = $row["ID_MUNICIPIO"];
                $estatus = $row["ESTATUS"];
                $num_tickets = $row["NUM_TICKETS"];

                // Agregar los datos al arreglo de resultados
                if (!isset($data[$municipio])) {
                    $data[$municipio] = array(
                        "PENDIENTE" => 0,
                        "RESUELTO" => 0
                    );
                }
                $data[$municipio][$estatus] = $num_tickets;
            }

            // Devolver los datos procesados
            return $data;
        }
    }
}