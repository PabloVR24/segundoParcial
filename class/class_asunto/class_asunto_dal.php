<?php
include('class_asunto.php');
include('class_db.php');

class catalogo_asunto_dal extends class_db
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
        $sql = "SELECT * FROM ASUNTO WHERE ID_ASUNTO = '$id'";
        $this->set_sql($sql);
        $result = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $total_asuntos = mysqli_num_rows($result);
        $obj_det = null;

        if ($total_asuntos == 1) {
            $renglon = mysqli_fetch_assoc($result);
            $obj_det = new catalogo_asunto(
                $renglon["ID_ASUNTO"],
                $renglon["NOMBRE_ASUNTO"],
            );
        }
        return $obj_det;
    }

    function obtener_lista_ASUNTO()
    {
        $sql = "SELECT * FROM asunto";
        $this->set_sql(($sql));
        $rs = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $total_ASUNTOs = mysqli_num_rows($rs);
        $obj_det = null;

        if ($total_ASUNTOs > 0) {
            $i = 0;
            while ($renglon = mysqli_fetch_assoc($rs)) {
                $obj_det = new catalogo_asunto(
                    $renglon["ID_ASUNTO"],
                    $renglon["NOMBRE_ASUNTO"],
                );

                $i++;
                $lista[$i] = $obj_det;
                unset($obj_det);
            }
            return $lista;
        }
    }
    function inserta_ASUNTO($obj)
    {
        $sql = "INSERT INTO ASUNTO (NOMBRE_ASUNTO)";
        $sql .= " VALUES (";
        $sql .= "'" . $obj->getNOMBRE_ASUNTO() . "'";
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

    function actualizar_ASUNTO($obj)
    {
        $sql = "UPDATE ASUNTO SET ";
        $sql .= "NOMBRE_ASUNTO=" . "'" . $obj->getNOMBRE_ASUNTO() . "'";
        $sql .= "WHERE ID_ASUNTO= '" . $obj->getID_ASUNTO() . "'";

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

    function borrar_ASUNTO($id)
    {
        $id = $this->db_conn->real_escape_string($id);
        $sql = "DELETE FROM ASUNTO WHERE ID_ASUNTO = '$id'";

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
