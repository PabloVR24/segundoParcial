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
                mysqli_close($this->db_conn);
            }
        }

        function set_sql($sql)
        {
            $this->db_query = $sql;
        }
    }
}
