<link rel="stylesheet" href="../../css/styles2.css">
<?php

require_once(__DIR__ . '/../../class/class_ticket/class_ticket_dal.php');
require_once(__DIR__ . '/../../class/class_alumno/class_alumno_dal.php');
require_once(__DIR__ . '/../../class/class_nivel/class_nivel_dal.php');
require_once(__DIR__ . '/../../class/class_asunto/class_asunto_dal.php');
require_once(__DIR__ . '/../../class/class_municipio/class_municipio_dal.php');
include('../../includes/navbar_users.php');

$exito = $_GET['exito'] ?? false;
$create_id = $_GET['create_id'] ?? '';
$lcurp = $_GET['lcurp'] ?? '';
$message = "";
$fecha1 = "";

$obj_ticket = new catalogo_ticket_dal;
$resultado = $obj_ticket->datos_por_id($create_id);
$obj_alumno = new catalogo_alumno_dal;
$res_alumno = $obj_alumno->datos_por_id($lcurp);

if ($exito) {
    if ($resultado == null) {
        echo "<h2 style = 'color:red'>NO SE ENCONTRO REGISTRO</h2>";
    } else {
        $message = "<style='backgroud-color:green'> Registro Exitoso</style>";
    }
} else {
    $message = "<style='color:#e5e5e5'> Registro ya existente </style>";
}

?>
<div class="container">
    <div class="card">
        <h1 class="message">
            <?php
            echo $message;
            ?>
        </h1>

        <?php
        print ("<p class = 'h4'> ESTATUS: " . $resultado->getESTATUS()) . "</p>";
        print("<br>");
        print ("ID TICKET: " . $resultado->getID_TICKET()) . "<br>";
        print("<br>");
        print ("Fecha: " . $resultado->getFECHA()) . "<br>";
        print("<br>");
        print("Nombre Completo: " . $res_alumno->getNOMBRE() . " " . $res_alumno->getAPELLIDO_PAT() . " " . $res_alumno->getAPELLIDO_MAT());
        print("<br>");
        print("CURP: " . $res_alumno->getCURP());
        print("<br>");
        print("Numero de Turno: " . $resultado->getTURNO());
        print("<br>");
        print("Registrado por: " . $resultado->getNOMBRE_USUARIO());
        print("<br>");
        ?>
        <form action="../../actions/generar_pdf.php" method="POST">
            <input hidden type="text" name="lcurp" id="lcurp" value="<?php echo $lcurp ?>">
            <input type="hidden" name="create_id" id="create_id" value="<?php echo $create_id ?>">
            <br>
            <input type="submit" name="submit" value="Generar PDF">
        </form>
        <br>
        <h4>Editar Datos</h4>
        <p>Si deseas editar los datos llena el formulario inferior</p>
        <br>

        <div id="area">
            <form action="" method="post">
                <div class="box">
                    <label for="fecha1">Fecha de Cita:</label>
                    <input type="date" class="form-control" id="fecha1" name="fecha1" value="<?php echo isset($_POST["fecha1"]) ? $_POST["fecha1"] : ""; ?>">
                    <br>
                    <?php if (!empty($error_fecha)) { ?>
                        <span class="error">
                            <?php echo $error_fecha; ?>
                        </span>
                    <?php } ?>
                </div>

                <div class="box">
                    <label for="mes1">Asunto a tratar:
                    </label>
                    <?php
                    $obj_lista_asuntos = new catalogo_asunto_dal;
                    $result_asuntos = $obj_lista_asuntos->obtener_lista_ASUNTO();

                    if ($result_asuntos == null) {
                        echo '<h2> No se encontraron Asuntos </h2>';
                    } else {
                    ?>
                        <select name="mes1" id="mes1" class="form-control" value="<?php echo isset($_POST["mes1"]) ? $_POST["mes1"] : ""; ?>">
                            <option class="opt" hidden></option>
                            <?php
                            foreach ($result_asuntos as $key => $value) {
                            ?>
                                <option class="opt" value="<?= $value->GETID_ASUNTO() ?>"><?= $value->GETID_ASUNTO() . $value->getNOMBRE_ASUNTO() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?PHP
                    }
                    ?>
                    <br>
                    <?php if (!empty($error_mes1)) { ?>
                        <span class="error"><?php echo $error_mes1; ?></span>
                    <?php } ?>
                </div>
                <div class="box">
                    <label for="mes">Nivel al que desea ingresar o que ya cursa el alumno:
                    </label>
                    <?php
                    $obj_lista_niveles = new catalogo_nivel_dal;
                    $result_nivel = $obj_lista_niveles->obtener_lista_niveles();

                    if ($result_nivel == null) {
                        echo '<h2> No se encontraron Niveles </h2>';
                    } else {
                    ?>
                        <select name="mes" class="form-control" id="mes" value="<?php echo isset($_POST["mes"]) ? $_POST["mes"] : ""; ?>">
                            <option class="opt" hidden></option>
                            <?php
                            foreach ($result_nivel as $key => $value) {
                            ?>
                                <option class="opt" value="<?= $value->getID_NIVEL() ?>"><?= $value->getID_NIVEL() . $value->getNOMBRE_NIVEL() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?PHP
                    }
                    ?>
                    <br>
                    <?php if (!empty($error_mes)) { ?>
                        <span class="error"><?php echo $error_mes; ?></span>
                    <?php } ?>
                </div>
                <div class="box">
                    <label for="mes2">Municipio:
                    </label>
                    <?php
                    $obj_lista_municipio = new catalogo_municipio_dal;
                    $result_municipio = $obj_lista_municipio->obtener_lista_municipio();

                    if ($result_municipio == null) {
                        echo '<h2> No se encontraron Municipios </h2>';
                    } else {
                    ?>
                        <select name="mes2" id="mes2" class="form-control" value="<?php echo isset($_POST["mes2"]) ? $_POST["mes2"] : ""; ?>">
                            <option class="opt" hidden></option>
                            <?php
                            foreach ($result_municipio as $key => $value) {
                            ?>
                                <option class="opt" value="<?= $value->getID_MUNICIPIO() ?>"><?= $value->getID_MUNICIPIO() . $value->getNOMBRE_MUNICIPIO() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?PHP
                    }
                    ?>


                    <br>
                    <?php if (!empty($error_mes2)) { ?>
                        <span class="error"><?php echo $error_mes2; ?></span>
                    <?php } ?>
                </div>
                <div class="wrapper">
                    <div class="box">
                        <input type="submit" id="btnSubmit" value="Enviar" />
                    </div>
                </div>
            </form>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $mes = test_input($_POST["mes"]);
            $mes1 = test_input($_POST["mes1"]);
            $mes2 = test_input($_POST["mes2"]);
            $fecha1 = test_input($_POST["fecha1"]);
            echo "fecha: " . $fecha1 . " NIVEL: " . $mes1 . " ASUNTO: " . $mes . " MUNICIPIO: " . $mes2;

            if (empty($fecha1)) {
                $error_fecha = "La fecha es obligatoria";
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

            if (empty($error_fecha) && empty($error_mes) && empty($error_mes1) && empty($error_mes2)) {
                $obj_upd = new catalogo_ticket($create_id, $fecha1, $mes1, $mes, $mes2);
                $result_upd = $obj_ticket->actualizar_ticket($obj_upd);
                if ($result_upd == 1) {
                    echo "<script>alert('ACTUALIZAR')</script>";
                    print('<script> location.reload(); </script>');
                } else {
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
        ?>

    </div>
</div>