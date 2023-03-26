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
                $renglon["NOMBRE_USUARIO"],
                $renglon["CURP"],
                $renglon["FECHA"],
                $renglon["ID_ASUNTO"],
                $renglon["ID_NIVEL"],
                $renglon["ID_MUNICIPIO"],
                $renglon["ESTATUS"],
                $renglon["TURNO"],
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
                    $renglon["NOMBRE_USUARIO"],
                    $renglon["CURP"],
                    $renglon["FECHA"],
                    $renglon["ID_ASUNTO"],
                    $renglon["ID_NIVEL"],
                    $renglon["ID_MUNICIPIO"],
                    $renglon["ESTATUS"],
                    $renglon["TURNO"],
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
        $sql = "INSERT INTO ticket (ID_TICKET, NOMBRE_USUARIO, CURP, FECHA, ID_ASUNTO, ID_NIVEL, ID_MUNICIPIO, ESTATUS, TURNO)";
        $sql .= " VALUES (";
        $sql .= "'" . $obj->getID_TICKET() . "',";
        $sql .= "'" . $obj->getNOMBRE_USUARIO() . "',";
        $sql .= "'" . $obj->getCURP() . "',";
        $sql .= "'" . $obj->getFECHA() . "',";
        $sql .= "'" . $obj->getID_ASUNTO() . "',";
        $sql .= "'" . $obj->getID_NIVEL() . "',";
        $sql .= "'" . $obj->getID_MUNICIPIO() . "',";
        $sql .= "'" . $obj->getESTATUS() . "',";
        $sql .= "'" . $obj->getTURNO() . "'";
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
        $sql .= "FECHA=" . "'" . $obj->getNOMBRE_USUARIO() . "'";
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

    function existe_ticket($id)
    {
        $id = $this->db_conn->real_escape_string($id);
        $sql = "SELECT COUNT(*) from TICKET where ID_TICKET='$id'";
        $this->set_sql($sql);
        $rs = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $renglon = mysqli_fetch_array($rs);
        $cuantos = $renglon[0];
        return $cuantos;
    }

    function existe_ticket_municipio($id_municipio)
    {
        $id_municipio = $this->db_conn->real_escape_string($id_municipio);
        $sql = "SELECT COUNT(*) FROM ticket WHERE id_municipio = '$id_municipio'";
        $this->set_sql($sql);
        $rs = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $renglon = mysqli_fetch_array($rs);
        $cuantos = $renglon[0];
        return $cuantos;
    }

    function existe_ticket_turno($ticket_number, $lcurp)
    {
        $ticket_number = $this->db_conn->real_escape_string($ticket_number);
        $lcurp = $this->db_conn->real_escape_string($lcurp);
        $sql = "SELECT COUNT(*) FROM ticket WHERE ID_TICKET = '$ticket_number' AND CURP = '$lcurp'";
        $this->set_sql($sql);
        $rs = mysqli_query($this->db_conn, $this->db_query)
            or die(mysqli_error($this->db_conn));

        $renglon = mysqli_fetch_array($rs);
        $cuantos = $renglon[0];
        return $cuantos;
    }
}
