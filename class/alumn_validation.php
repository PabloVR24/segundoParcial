<?php
include('../class/class_alumno/class_alumno_dal.php');
$lcurp = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lcurp = test_input($_POST["lCurp"]);
    $name = test_input($_POST["name"]);
    $firstName = test_input($_POST["firstName"]);
    $lastName = test_input($_POST["lastName"]);
    $tel = test_input($_POST["tel"]);
    $cel = test_input($_POST["cel"]);
    $mail = test_input($_POST["mail"]);

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

    if (empty($error_lcurp) && empty($error_name) && empty($error_firstName) && empty($error_lastName) && empty($error_tel) && empty($error_cel) && empty($error_mail)) {

        $obj_alumno = new catalogo_alumno_dal;
        $obj_ins = new catalogo_alumno("$lcurp", "$name", "$firstName", "$lastName", "$tel", "$cel", "$mail");
        $result_ins = $obj_alumno->inserta_alumno($obj_ins);
        if ($result_ins == 1) {
            header("Location: index.php");
            exit();
        } else {
            echo "<h2 style = 'color:red'>NO SE INSERTO REGISTRO</h2>";
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
