<?php
include('class_ticket_dal.php');

// READ ONE (READ)
$obj_ticket = new catalogo_ticket_dal;
$resultado = $obj_ticket->datos_por_id("id_ticket3");
if ($resultado == null) {
    echo "<h2 style = 'color:red'>NO SE ENCONTRO REGISTRO</h2>";
} else {
    echo '<pre>';
    print_r($resultado);
    echo '</pre>';
}

// READ EVERYONE (READ)
$resultado2 = $obj_ticket->obtener_lista_tickets();
if ($resultado2 == null) {
    echo "<h2 style = 'color:red'>NO SE ENCONTRO REGISTRO</h2>";
} else {
    echo '<pre>';
    print_r($resultado2);
    echo '</pre>';
}

// $obj_ins = new catalogo_ticket('id_ticket3', 'PabloVR24', 'VARP991202HCLLNB05', '2023-12-02', '1', '1', '2', 'PENDIENTE', 2);
// $result_ins = $obj_ticket->inserta_ticket($obj_ins);
// if ($result_ins == 1) {
//     echo "<h2 style = 'color:green'>INSERTADO CORRECTAMENTE</h2>";
// } else {
//     echo "<h2 style = 'color:red'>NO SE INSERTO REGISTRO</h2>";
// }

$result_del = $obj_ticket->borrar_ticket(2);
if ($result_del == 1) {
    echo "<h2 style = 'color:green'>BORRADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE BORRO REGISTRO</h2>";
}

// UPDATE
$obj_upd = new catalogo_ticket("id_ticket3", "2025-12-27", "7", "3", "2");
$result_upd = $obj_ticket->actualizar_ticket($obj_upd);
if ($result_upd == 1) {
    echo "<h2 style = 'color:green'>ACTUALIZADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE ACTUALIZO TICKET</h2>";
}

// $resultado3 = $obj_ticket->existe_ticket_turno("1", "VARP151202HCLLNB05");
// if ($resultado3 == null) {
//     echo "<h2 style = 'color:red'>NO SE ENCONTRO REGISTRO</h2>";
// } else if ($resultado3 == 1) {
//     echo '<pre>';
//     print_r($resultado3);
//     echo '</pre>';
// } else {
//     print_r($resultado3);
// }
