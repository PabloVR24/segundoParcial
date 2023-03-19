<?php
include('class_ticket.php');
include('class_db.php');

class catalogo_ticket_dal extends class_db
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
        $sql = "SELECT * FROM Ticket WHERE ID_TICKET = '$id'";
        $this->set_sql($sql);
        $result = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $total_tickets = mysqli_num_rows($result);
        $obj_det = null;

        if ($total_tickets == 1) {
            $renglon = mysqli_fetch_assoc($result);
            $obj_det = new catalogo_ticket(
                $renglon["ID_TICKET"],
                $renglon["NOMBRE_REALIZA"],
                $renglon["CURP"],
                $renglon["NOMBRE"],
                $renglon["APELLIDO_PAT"],
                $renglon["APELLIDO_MAT"],
                $renglon["TELEFONO"],
                $renglon["CELULAR"],
                $renglon["EMAIL"],
                $renglon["FECHA"],
                $renglon["ID_ASUNTO"],
                $renglon["ID_NIVEL"],
                $renglon["ID_MUNICIPIO"],
                $renglon["ESTATUS"],
            );
        }
        return $obj_det;
    }

    function obtener_lista_tickets()
    {
        $sql = "SELECT * FROM ticket";
        $this->set_sql(($sql));
        $rs = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $total_tickets = mysqli_num_rows($rs);
        $obj_det = null;

        if ($total_tickets > 0) {
            $i = 0;
            while ($renglon = mysqli_fetch_assoc($rs)) {
                $obj_det = new catalogo_ticket(
                    $renglon["ID_TICKET"],
                    $renglon["NOMBRE_REALIZA"],
                    $renglon["CURP"],
                    $renglon["NOMBRE"],
                    $renglon["APELLIDO_PAT"],
                    $renglon["APELLIDO_MAT"],
                    $renglon["TELEFONO"],
                    $renglon["CELULAR"],
                    $renglon["EMAIL"],
                    $renglon["FECHA"],
                    $renglon["ID_ASUNTO"],
                    $renglon["ID_NIVEL"],
                    $renglon["ID_MUNICIPIO"],
                    $renglon["ESTATUS"],
                );

                $i++;
                $lista[$i] = $obj_det;
                unset($obj_det);
            }
            return $lista;
        }
    }
    function inserta_ticket($obj)
    {
        $sql = "INSERT INTO ticket (ID_TICKET, NOMBRE_REALIZA, CURP, NOMBRE, APELLIDO_PAT, APELLIDO_MAT, TELEFONO, CELULAR, EMAIL, FECHA, ID_ASUNTO, ID_NIVEL, ID_MUNICIPIO, ESTATUS)";
        $sql .= " VALUES (";
        $sql .= "'" . $obj->getID_TICKET() . "',";
        $sql .= "'" . $obj->getNOMBRE_REALIZA() . "',";
        $sql .= "'" . $obj->getCURP() . "',";
        $sql .= "'" . $obj->getNOMBRE() . "',";
        $sql .= "'" . $obj->getAPELLIDO_PAT() . "',";
        $sql .= "'" . $obj->getAPELLIDO_MAT() . "',";
        $sql .= "'" . $obj->getTELEFONO() . "',";
        $sql .= "'" . $obj->getCELULAR() . "',";
        $sql .= "'" . $obj->getEMAIL() . "',";
        $sql .= "'" . $obj->getFECHA() . "',";
        $sql .= "'" . $obj->getID_ASUNTO() . "',";
        $sql .= "'" . $obj->getID_NIVEL() . "',";
        $sql .= "'" . $obj->getID_MUNICIPIO() . "',";
        $sql .= "'" . $obj->getESTATUS() . "'";
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

    function actualizar_ticket($obj)
    {
        $sql = "UPDATE Ticket SET ";
        $sql .= "NOMBRE_REALIZA=" . "'" . $obj->getNOMBRE_REALIZA() . "'";
        $sql .= "WHERE id_ticket= '" . $obj->getID_TICKET() . "'";

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

    function borrar_ticket($id)
    {
        $id = $this->db_conn->real_escape_string($id);
        $sql = "DELETE FROM Ticket WHERE ID_TICKET = '$id'";

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

    function existe_ticket($id){
        $id=$this->db_conn->real_escape_string($id);
        $sql="SELECT COUNT(*) from TICKET where ID_TICKET='$id'";
        $this->set_sql($sql);
        $rs=mysqli_query($this->db_conn,$this->db_query)
        or die(mysqli_error($this->db_conn));

        $renglon=mysqli_fetch_array($rs);
        $cuantos=$renglon[0];
        return $cuantos;
    }
}
