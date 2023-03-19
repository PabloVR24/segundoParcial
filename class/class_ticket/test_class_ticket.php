<?php
include('class_ticket_dal.php');

// READ ONE (READ)
$obj_ticket = new catalogo_ticket_dal;
$resultado = $obj_ticket->datos_por_id("VARP991202160322");
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


$obj_ins = new catalogo_ticket('id_ticket', 'fname', 'lcurp' ,'name', 'firstName', 'lastName', 'tel', 'cel', 'mail', '2023-12-02', '1', '1', '2', 'PENDIENTE');
$result_ins = $obj_ticket->inserta_ticket($obj_ins);
if ($result_ins == 1) {
    echo "<h2 style = 'color:green'>INSERTADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE INSERTO REGISTRO</h2>";
}

$result_del = $obj_ticket->borrar_ticket(2);
if ($result_del == 1) {
    echo "<h2 style = 'color:green'>BORRADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE BORRO REGISTRO</h2>";
}


// UPDATE

$obj_upd = new catalogo_ticket("1", "XD");
$result_upd = $obj_ticket->actualizar_ticket($obj_upd);
if ($result_upd == 1) {
    echo "<h2 style = 'color:green'>ACTUALIZADO CORRECTAMENTE</h2>";
} else {
    echo "<h2 style = 'color:red'>NO SE ACTUALIZO TICKET</h2>";
}

//existe curso
echo '<br>';
$result_exis = $obj_ticket->existe_ticket("PRIMERDAS");
if ($result_exis == 1) {
    echo "<h2 style = 'color:green'>CURSO EXISTE</h2>";
} else {
    echo "<h2 style = 'color:red'>CURSO NO EXISTE</h2>";
}
