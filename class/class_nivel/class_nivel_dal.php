<?php
include('class_nivel.php');
include('class_db.php');

class catalogo_nivel_dal extends class_db
{
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        parent::__destruct();
    }


    function datos_por_id($id)
    {
        $id = $this->db_conn->real_escape_string($id);
        $sql = "SELECT * FROM NIVELES WHERE ID_NIVEL = '$id'";
        $this->set_sql($sql);
        $result = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $total_niveles = mysqli_num_rows($result);
        $obj_det = null;

        if ($total_niveles == 1) {
            $renglon = mysqli_fetch_assoc($result);
            $obj_det = new catalogo_nivel(
                $renglon["ID_NIVEL"],
                $renglon["NOMBRE_NIVEL"],
            );
        }
        return $obj_det;
    }

    function obtener_lista_niveles()
    {
        $sql = "SELECT * FROM NIVELES";
        $this->set_sql(($sql));
        $rs = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $total_niveles = mysqli_num_rows($rs);
        $obj_det = null;

        if ($total_niveles > 0) {
            $i = 0;
            while ($renglon = mysqli_fetch_assoc($rs)) {
                $obj_det = new catalogo_nivel(
                    $renglon["ID_NIVEL"],
                    $renglon["NOMBRE_NIVEL"],
                );

                $i++;
                $lista[$i] = $obj_det;
                unset($obj_det);
            }
            return $lista;
        }
    }
    function inserta_nivel($obj)
    {
        $sql = "INSERT INTO NIVELES (NOMBRE_NIVEL)";
        $sql .= " VALUES (";
        $sql .= "'" . $obj->getNOMBRE_NIVEL() . "'";
        $sql .= ")";

        $this->set_sql($sql);
        $this->db_conn->set_charset('utf8');
        mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        if (mysqli_affected_rows($this->db_conn) == 1) {
            $insertado = 1;
        } else {
            $insertado = 0;
        }
        unset($obj);
        return $insertado;
    }

    function actualizar_nivel($obj)
    {
        $sql = "UPDATE NIVELES SET ";
        $sql .= "NOMBRE_NIVEL=" . "'" . $obj->getNOMBRE_NIVEL() . "'";
        $sql .= "WHERE ID_NIVEL= '" . $obj->getID_NIVEL() . "'";

        $this->set_sql($sql);
        $this->db_conn->set_charset('utf8');
        mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        if (mysqli_affected_rows($this->db_conn) == 1) {
            $actualizado = 1;
        } else {
            $actualizado = 0;
        }
        unset($obj);
        return $actualizado;
    }

    function borrar_nivel($id)
    {
        $id = $this->db_conn->real_escape_string($id);
        $sql = "DELETE FROM NIVELES WHERE ID_NIVEL = '$id'";

        $this->set_sql($sql);
        $this->db_conn->set_charset('utf8');
        mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        if (mysqli_affected_rows($this->db_conn) == 1) {
            $borrado = 1;
        } else {
            $borrado = 0;
        }
        return $borrado;
    }
}
