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

<?php
include(__DIR__ . "../../../includes/bootstrap.php");
?>

<style>
    @import url('https://fonts.cdnfonts.com/css/circular-std');

    * {
        font-family: 'Circular Std', sans-serif;
    }

    body {
        background-color: #251c25;
        background: radial-gradient(circle, transparent 20%, #011627 20%, #011627 80%, transparent 80%, transparent),
            radial-gradient(circle, transparent 20%, #011627 20%, #011627 80%, transparent 80%, transparent) 15px 15px,
            linear-gradient(#b89cd7 1.2000000000000002px, transparent 1.2000000000000002px) 0 -0.6000000000000001px,
            linear-gradient(90deg, #b89cd7 1.2000000000000002px, #011627 1.2000000000000002px) -0.6000000000000001px 0;
        background-size: 150px 150px, 150px 150px, 15px 15px, 15px 15px;
    }

    .container {
        width: 70%;
        align-items: center;
        text-align: center;
        color: white;
        background-color: #7D5A8C;
        margin-top: 100px;
        height: 500px;
        border-radius: 30px;
        padding-top: 50px;
        padding-left: 100px;
        padding-right: 100px;
        padding-bottom: 100px;
    }

    h1 {
        font-size: 50px;
    }

    p {
        font-size: 20px;
    }

    form {

        margin-bottom: 50px;
        margin-top: 50px;
    }

    .form-control {
        width: 100%;
        text-align: center;
        font-size: 20px;
    }


    .submit {
        color: white;
        background-color: #7641BF;
        width: 250px;
        height: 60px;
        border-radius: 60px;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .submit:hover {
        background-color: #B8A0D9;
    }
</style>

<body>
    <div class="container">
        <form action="" method="POST">
            <h1>BUSQUEDA DE TICKET</h1>
            <p>Ingresa por favor los siguientes datos</p>
            <div class="row">
                <div class="col">
                    <label class="form-label" for="ticket_number">Numero de Turno:</label>
                    <input class="form-control" type="text" id="ticket_number" name="ticket_number" placeholder="20 digitos del numero">
                </div>
                <div class="col">
                    <label class="form-label" for="lCurp">CURP</label>
                    <input class="form-control" type="text" id="lCurp" name="lCurp" placeholder="CURP">

                </div>
            </div>
            <input class="submit" type="submit" name="submit" value="Enviar">
        </form>
    </div>
</body>

</html>