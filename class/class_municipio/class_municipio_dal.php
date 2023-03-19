<?php
include('class_municipio.php');
include('class_db.php');

class catalogo_municipio_dal extends class_db
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
        $sql = "SELECT * FROM MUNICIPIO WHERE ID_MUNICIPIO = '$id'";
        $this->set_sql($sql);
        $result = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $total_municipios = mysqli_num_rows($result);
        $obj_det = null;

        if ($total_municipios == 1) {
            $renglon = mysqli_fetch_assoc($result);
            $obj_det = new catalogo_municipio(
                $renglon["ID_MUNICIPIO"],
                $renglon["NOMBRE_MUNICIPIO"],
            );
        }
        return $obj_det;
    }

    function obtener_lista_municipio()
    {
        $sql = "SELECT * FROM MUNICIPIO";
        $this->set_sql(($sql));
        $rs = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $total_municipios = mysqli_num_rows($rs);
        $obj_det = null;

        if ($total_municipios > 0) {
            $i = 0;
            while ($renglon = mysqli_fetch_assoc($rs)) {
                $obj_det = new catalogo_municipio(
                    $renglon["ID_MUNICIPIO"],
                    $renglon["NOMBRE_MUNICIPIO"],
                );

                $i++;
                $lista[$i] = $obj_det;
                unset($obj_det);
            }
            return $lista;
        }
    }
    function inserta_municipio($obj)
    {
        $sql = "INSERT INTO MUNICIPIO (NOMBRE_MUNICIPIO)";
        $sql .= " VALUES (";
        $sql .= "'" . $obj->getNOMBRE_MUNICIPIO() . "'";
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

    function actualizar_municipio($obj)
    {
        $sql = "UPDATE MUNICIPIO SET ";
        $sql .= "NOMBRE_MUNICIPIO=" . "'" . $obj->getNOMBRE_MUNICIPIO() . "'";
        $sql .= "WHERE ID_MUNICIPIO= '" . $obj->getID_MUNICIPIO() . "'";

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

    function borrar_municipio($id)
    {
        $id = $this->db_conn->real_escape_string($id);
        $sql = "DELETE FROM MUNICIPIO WHERE ID_MUNICIPIO = '$id'";

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
