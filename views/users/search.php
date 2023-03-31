<?php
include('../../class/class_ticket/class_ticket_dal.php');
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
include(__DIR__ . "../../../includes/sweetalert.php");
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

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
        width: 100%;
        align-items: center;
        text-align: center;
        color: white;
        background-color: #7D5A8C;
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

    .form {

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

    td {
        line-height: 1;
        vertical-align: middle;
    }
</style>

<body>
    <div class="container">
        <form class="form" action="" id="forms" method="POST">
            <h1>BUSQUEDA DE TICKET</h1>
            <p>Ingresa por favor los siguientes datos</p>
            <div class="row">
                <div class="col-4">
                    <label class="form-label" for="ticket_number">Numero de Turno:</label>
                    <input class="form-control" type="text" id="ticket_number" name="ticket_number" placeholder="Digitos del numero">
                </div>
                <div class="col-8">
                    <label class="form-label" for="lCurp">CURP</label>
                    <input class="form-control" type="text" id="lCurp" name="lCurp" placeholder="CURP">

                </div>
            </div>
            <input class="submit" id="btnSubmit" type="submit" name="submit" value="Enviar" onclick="mostrarOcultarArea()">
        </form>

        <div class="area">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID_TICKET</th>
                        <th scope="col">NOMBRE_REGISTRO</th>
                        <th scope="col">CURP</th>
                        <th scope="col">FECHA CITA</th>
                        <th scope="col">ASUNTO</th>
                        <th scope="col">NIVEL</th>
                        <th scope="col">MUNICIPIO</th>
                        <th scope="col">ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['submit'])) {
                        $ticket_number = $_POST['ticket_number'];
                        $lcurp = $_POST['lCurp'];

                        $obj_ticket = new catalogo_ticket_dal;
                        $resultado = $obj_ticket->existe_ticket_turno_curp($ticket_number, $lcurp);

                        $resultado2 = $obj_ticket->existe_ticket_turno($ticket_number, $lcurp);
                        if ($resultado2 >= 1) {
                            foreach ($resultado as $ticket) {
                                echo "<tr>";
                                echo "<td>" . $ticket->getID_TICKET() . "</td>";
                                echo "<td>" . $ticket->getNOMBRE_USUARIO() . "</td>";
                                echo "<td>" . $ticket->getCURP() . "</td>";
                                echo "<td>" . $ticket->getFECHA() . "</td>";
                                echo "<td>" . $ticket->getID_ASUNTO() . "</td>";
                                echo "<td>" .  $ticket->getID_NIVEL() . "</td>";
                                echo "<td>" . $ticket->getID_MUNICIPIO() . "</td>";
                                echo "<td>";
                                echo "<form class = 'form-btn' method='POST' action=''>";
                                echo "<input type='hidden' name='id_ticket' value='" . $ticket->getID_TICKET() . "'>";
                                echo "<input type='hidden' name='lCurp' value='" . $lcurp . "'>";
                                echo "<input type='submit' class='btn btn-success' name='enviar' value='" . $ticket->getID_TICKET() . "'> </form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<script>Swal.fire(
                            'The Internet?',
                            'That thing is still around?',
                            'question'
                          )</script>";
                            exit();
                        }
                    }

                    if (isset($_POST['enviar'])) {
                        $id_ticket = $_POST['enviar'];
                        $lcurp = $_POST['lCurp'];
                        header("Location: confirmacion.php?exito=0&create_id=" . $id_ticket . "&lcurp=" . $lcurp);
                        exit();
                    }

                    ?>
                </tbody>
            </table>
        </div>

        <!-- <script>
            const formulario = document.getElementById("forms");
            const btnSubmit = document.getElementById("btnSubmit");

            formulario.addEventListener("submit", (e) => {

                let messages = [];

                let patTurno = document.getElementById("ticket_number").value.trim();
                let expTurno = /^[a-zA-Z]{4}(\d{6})(\d{8})?$/;

                if (patTurno == "") {
                    messages.push("Turno Faltante")
                } else if (!expTurno.test(patTurno)) {
                    messages.push("Turno Invalido")
                }

                let patCURP = document.getElementById("lCurp").value.trim();
                let expCURP = /^[a-zA-Z]{4}(\d{6})([a-zA-Z]{6})(([a-zA-Z0-9]){2})?$/;

                if (patCURP == "") {
                    messages.push("CURP Faltante")
                } else if (!expCURP.test(patCURP)) {
                    messages.push("CURP Invalida")
                }

                if (messages.length > 0) {
                    Swal.fire({
                        icon: "info",
                        title: "Error en campos",
                        text: messages.join(" --- "),
                        footer: "Complete o verifique los campos mencionados",
                    });
                    e.preventDefault();
                }
            })
        </script> -->
    </div>

</body>
<style>
    .pie-pagina {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: #1c121f;
        color: #fff;
        text-align: center;
        padding: 20px;
    }
</style>

<footer class="pie-pagina">
    <style>
        .navbar {
            background-color: #1c121f;
            color: white;
            height: 40px;
        }

        .navbar-brand {
            color: white;
        }

        .nav-link {
            color: white;
        }

        .nav-link:hover {
            background-color: #7D5A8C;
            color: white;
        }
    </style>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php">Estado de Coahuila</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="http://localhost/Practica 2/views/users/index.php">Registro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/Practica 2/views/users/search.php">Busqueda</a>
                    </li>
            </div>
        </div>
    </nav>
</footer>

</html>