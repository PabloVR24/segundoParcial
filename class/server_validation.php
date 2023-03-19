<style>
    @import url('https://fonts.cdnfonts.com/css/circular-std');

    .error {
        color: red;
        font-family: 'Circular Std', sans-serif;
    }
</style>

<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css
" rel="stylesheet" />

<?php
$create_id = "";
$mes = "";
$mes1 = "";
$mes2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = test_input($_POST["fname"]);
    $lcurp = test_input($_POST["lCurp"]);
    $name = test_input($_POST["name"]);
    $firstName = test_input($_POST["firstName"]);
    $lastName = test_input($_POST["lastName"]);
    $tel = test_input($_POST["tel"]);
    $cel = test_input($_POST["cel"]);
    $mail = test_input($_POST["mail"]);
    $mes = test_input($_POST["mes"]);
    $mes1 = test_input($_POST["mes1"]);
    $mes2 = test_input($_POST["mes2"]);
    $fecha = test_input($_POST["fecha"]);


    if (empty($fname)) {
        $error_fname = "El nombre es obligatorio";
    } elseif (!preg_match("/^[a-zA-Z ]{3,50}\s?$/", $fname)) {
        $error_fname = "El nombre es invalido";
    }

    if (empty($lcurp)) {
        $error_lcurp = "El CURP es obligatorio";
    } elseif (!preg_match("/^[a-zA-Z]{4}(\d{6})([a-zA-Z]{6})(([a-zA-Z0-9]){2})?$/", $lcurp)) {
        $error_lcurp = "El formato del CURP no es válido";
    }

    if (empty($name)) {
        $error_name = "El Nombre es obligatorio";
    } elseif (!preg_match("/^[a-zA-Z ]{3,30}\s?$/", $name)) {
        $error_name = "El nombre es invalido";
    }

    if (empty($firstName)) {
        $error_firstName = "El Apellido es obligatorio";
    } elseif (!preg_match("/^[a-zA-Z ]{3,30}\s?$/", $firstName)) {
        $error_firstName = "El Apellido es invalido";
    }

    if (empty($lastName)) {
        $error_lastName = "El Apellido es obligatorio";
    } elseif (!preg_match("/^[a-zA-Z ]{3,30}\s?$/", $lastName)) {
        $error_lastName = "El Apellido es invalido";
    }

    if (empty($tel)) {
        $error_tel = "El Telefono es obligatorio";
    } elseif (!preg_match("/^[0-9]{10}?$/", $tel)) {
        $error_tel = "El Telefono es invalido";
    }

    if (empty($cel)) {
        $error_cel = "El Celular es obligatorio";
    } elseif (!preg_match("/^[0-9]{10}?$/", $cel)) {
        $error_cel = "El Celular es invalido";
    }

    if (empty($mail)) {
        $error_mail = "El email es obligatorio";
    } elseif (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $mail)) {
        $error_mail = "El email es invalido";
    }

    if (empty($mes)) {
        $error_mes = "Esta opción es obligatoria";
    }

    if (empty($mes1)) {
        $error_mes1 = "Esta opción es obligatoria";
    }

    if (empty($mes2)) {
        $error_mes2 = "Esta opción es obligatoria";
    }

    if (empty($fecha)) {
        $error_fecha = "La fecha es obligatoria";
    }

    if (empty($error_fname) && empty($error_lcurp) && empty($error_name) && empty($error_firstName) && empty($error_lastName) && empty($error_tel) && empty($error_cel) && empty($error_mail) && empty($error_mes) && empty($error_mes1) && empty($error_mes2) && empty($error_fecha)) {

        $create_id = substr($lcurp, 0, 10) . str_replace("-", "", $fecha);

        require_once('..\class\class_ticket\class_ticket_dal.php');

        $obj_ticket = new catalogo_ticket_dal;
        $result_exis = $obj_ticket->existe_ticket($create_id);
        if ($result_exis == 1) {
            header("Location: confirmacion.php?exito=0&create_id=$create_id");
            exit();
        } else {
            $obj_ins = new catalogo_ticket('id_ticket', 'fname', 'lcurp', 'name', 'firstName', 'lastName', 'tel', 'cel', 'mail', '2023-12-02', '1', '1', '2', 'PENDIENTE');
            $obj_ins = new catalogo_ticket($create_id, $fname, $lcurp, $name, $firstName, $lastName, $tel, $cel, $mail, $fecha, $mes, $mes1, $mes2, 'PENDIENTE');
            $result_ins = $obj_ticket->inserta_ticket($obj_ins);
            if ($result_ins == 1) {
                header("Location: confirmacion.php?exito=1&create_id=$create_id");
                exit();
            } else {
                echo "<h2 style = 'color:red'>NO SE INSERTO REGISTRO</h2>";
            }
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
