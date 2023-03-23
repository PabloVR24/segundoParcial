<?php
include('class_alumno.php');
include('class_db.php');

class catalogo_alumno_dal extends class_db
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
        $sql = "SELECT * FROM ALUMNO WHERE CURP = '$id'";
        $this->set_sql($sql);
        $result = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $total_alumnos = mysqli_num_rows($result);
        $obj_det = null;

        if ($total_alumnos == 1) {
            $renglon = mysqli_fetch_assoc($result);
            $obj_det = new catalogo_alumno(
                $renglon["CURP"],
                $renglon["NOMBRE"],
                $renglon["APELLIDO_PAT"],
                $renglon["APELLIDO_MAT"],
                $renglon["TELEFONO"],
                $renglon["CELULAR"],
                $renglon["EMAIL"],
            );
        }
        return $obj_det;
    }

    function obtener_lista_alumno()
    {
        $sql = "SELECT * FROM alumno";
        $this->set_sql(($sql));
        $rs = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $total_alumnos = mysqli_num_rows($rs);
        $obj_det = null;

        if ($total_alumnos > 0) {
            $i = 0;
            while ($renglon = mysqli_fetch_assoc($rs)) {
                $obj_det = new catalogo_alumno(
                    $renglon["CURP"],
                    $renglon["NOMBRE"],
                    $renglon["APELLIDO_PAT"],
                    $renglon["APELLIDO_MAT"],
                    $renglon["TELEFONO"],
                    $renglon["CELULAR"],
                    $renglon["EMAIL"],
                );

                $i++;
                $lista[$i] = $obj_det;
                unset($obj_det);
            }
            return $lista;
        }
    }
    function inserta_alumno($obj)
    {
        $sql = "INSERT INTO alumno (CURP, NOMBRE, APELLIDO_PAT, APELLIDO_MAT, TELEFONO, CELULAR, EMAIL)";
        $sql .= " VALUES (";
        $sql .= "'" . $obj->getCURP() . "',";
        $sql .= "'" . $obj->getNOMBRE() . "',";
        $sql .= "'" . $obj->getAPELLIDO_PAT() . "',";
        $sql .= "'" . $obj->getAPELLIDO_MAT() . "',";
        $sql .= "'" . $obj->getTELEFONO() . "',";
        $sql .= "'" . $obj->getCELULAR() . "',";
        $sql .= "'" . $obj->getEMAIL() . "'";
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

    function actualizar_alumno($obj)
    {
        $sql = "UPDATE alumno SET ";
        $sql .= "NOMBRE=" . "'" . $obj->getNOMBRE() . "'";
        $sql .= "WHERE CURP= '" . $obj->getCURP() . "'";

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

    function borrar_alumno($id)
    {
        $id = $this->db_conn->real_escape_string($id);
        $sql = "DELETE FROM alumno WHERE CURP = '$id'";

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

    function existe_alumno($id)
    {
        $id = $this->db_conn->real_escape_string($id);
        $sql = "SELECT COUNT(*) from ALUMNO where CURP='$id'";
        $this->set_sql($sql);
        $rs = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $renglon = mysqli_fetch_array($rs);
        $cuantos = $renglon[0];
        return $cuantos;
    }
}
