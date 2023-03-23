<?php
include('class_usuario.php');
include('../class_db/class_db.php');

class catalogo_usuario_dal extends class_db
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
        $sql = "SELECT * FROM USUARIOS WHERE NOMBRE_USUARIO = '$id'";
        $this->set_sql($sql);
        $result = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $total_usuarios = mysqli_num_rows($result);
        $obj_det = null;

        if ($total_usuarios == 1) {
            $renglon = mysqli_fetch_assoc($result);
            $obj_det = new catalogo_usuario(
                $renglon["NOMBRE_USUARIO"],
                $renglon["NOMBRE"],
                $renglon["CONTRASEÑA"],
            );
        }
        return $obj_det;
    }

    function obtener_lista_usuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $this->set_sql(($sql));
        $rs = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $total_usuarios = mysqli_num_rows($rs);
        $obj_det = null;

        if ($total_usuarios > 0) {
            $i = 0;
            while ($renglon = mysqli_fetch_assoc($rs)) {
                $obj_det = new catalogo_usuario(
                    $renglon["NOMBRE_USUARIO"],
                    $renglon["NOMBRE"],
                    $renglon["CONTRASEÑA"],
                );

                $i++;
                $lista[$i] = $obj_det;
                unset($obj_det);
            }
            return $lista;
        }
    }
    function inserta_usuario($obj)
    {
        $sql = "INSERT INTO USUARIOS (NOMBRE_USUARIO, NOMBRE, CONTRASEÑA)";
        $sql .= " VALUES (";
        $sql .= "'" . $obj->getNOMBRE_USUARIO() . "',";
        $sql .= "'" . $obj->getNOMBRE() . "',";
        $sql .= "'" . $obj->getCONTRASEÑA() . "'";
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
        $sql = "UPDATE USUARIOS SET ";
        $sql .= "NOMBRE =" . "'" . $obj->getNOMBRE() . "'";
        $sql .= "WHERE NOMBRE_USUARIO= '" . $obj->getNOMBRE_USUARIO() . "'";

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

    function borrar_usuario($id)
    {
        $id = $this->db_conn->real_escape_string($id);
        $sql = "DELETE FROM USUARIOS WHERE NOMBRE_USUARIO = '$id'";

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

    function existe_usuario($id)
    {
        $id = $this->db_conn->real_escape_string($id);
        $sql = "SELECT COUNT(*) from TICKET where NOMBRE_USUARIO ='$id'";
        $this->set_sql($sql);
        $rs = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $renglon = mysqli_fetch_array($rs);
        $cuantos = $renglon[0];
        return $cuantos;
    }
}
