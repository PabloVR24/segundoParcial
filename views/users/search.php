<?php
include('../../class/class_ticket/class_ticket_dal.php');
if (isset($_POST['submit'])) {
    $ticket_number = $_POST['ticket_number'];
    $lcurp = $_POST['lCurp'];
    
    $obj_ticket = new catalogo_ticket_dal;
    $resultado = $obj_ticket->existe_ticket_turno($ticket_number, $lcurp);
    if ($resultado == 1) {
        header("Location: confirmacion.php?exito=0&create_id=$ticket_number&lcurp=$lcurp");
        exit();
    } else {
        echo '<script>alert("REGISTRO NO EXISTENTE")</script>';
        sleep(5);
        header("Location: index.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda por Ticket</title>
</head>

<body>
    <form action="" method="POST">
        <h1>BUSQUEDA DE TICKET</h1>
        <label for="ticket_number">Turno:</label>
        <input type="text" id="ticket_number" name="ticket_number" placeholder="20 digitos del numero">

        <label for="lCurp">CURP</label>
        <input type="text" id="lCurp" name="lCurp" placeholder="CURP">

        <input type="submit" name="submit" value="Enviar">
    </form>
</body>

</html>