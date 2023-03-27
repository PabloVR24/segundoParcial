<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../../css/styles2.css">
<?php

require_once(__DIR__ . '/../../class/class_ticket/class_ticket_dal.php');
require_once(__DIR__ . '/../../class/class_alumno/class_alumno_dal.php');

// Recuperar los datos y el mensaje de éxito de la URL
$exito = $_GET['exito'] ?? false;
$create_id = $_GET['create_id'] ?? '';
$lcurp = $_GET['lcurp'] ?? '';
$message = "";
$fecha1 = "";

$obj_ticket = new catalogo_ticket_dal;
$resultado = $obj_ticket->datos_por_id($create_id);

$obj_alumno = new catalogo_alumno_dal;
$res_alumno = $obj_alumno->datos_por_id($lcurp);

// Mostrar el mensaje de éxito y los datos de confirmación si existen
if ($exito) {
    if ($resultado == null) {
        echo "<h2 style = 'color:red'>NO SE ENCONTRO REGISTRO</h2>";
    } else {
        $message = "<style='backgroud-color:green'> Registro Exitoso</style>";
    }
} else {
    $message = "<style='color:#441b1b'> Registro ya existente </style>";
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
        print ("Fecha: " . $resultado->getFECHA()) . "<br>";
        print("<br>");
        print("Nombre Completo: " . $res_alumno->getNOMBRE() . " " . $res_alumno->getAPELLIDO_PAT() . " " . $res_alumno->getAPELLIDO_MAT());
        print("<br>");
        print("Numero de Turno " . $resultado->getTURNO());
        print("<br><br><br>");
        print("Registrado por " . $resultado->getNOMBRE_USUARIO())
        ?>

        <input type="checkbox" id="mostrar_area" name="mostrar_area" onchange="mostrarOcultarArea()">Editar<br>

        <div id="area" style="display: none;">
            <form action="" method="post">

                <div class="box">
                    <label for="fecha1">Fecha de Cita:</label>
                    <input type="date" id="fecha1" name="fecha1" value="<?php echo isset($_POST["fecha1"]) ? $_POST["fecha1"] : ""; ?>">
                    <br>
                    <?php if (!empty($error_fecha)) { ?>
                        <span class="error">
                            <?php echo $error_fecha; ?>
                        </span>
                    <?php } ?>
                </div>
                <div class="wrapper">
                    <div class="box">
                        <input type="submit" id="btnSubmit" value="Enviar" />
                    </div>
                </div>
            </form>
        </div>

        <form action="../../actions/generar_pdf.php" method="POST">
            <input hidden type="text" name="lcurp" id="lcurp" value="<?php echo $lcurp ?>">
            <input type="submit" name="submit" value="Generar PDF">
        </form>

        <script>
            function mostrarOcultarArea() {
                var checkbox = document.getElementById("mostrar_area");
                var area = document.getElementById("area");
                if (checkbox.checked == true) {
                    area.style.display = "block";
                } else {
                    area.style.display = "none";
                }
            }
        </script>


        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fecha1 = test_input($_POST["fecha1"]);

            if (empty($fecha1)) {
                $error_fecha = "La fecha es obligatoria";
            }

            if (empty($error_fecha)) {
                $obj_upd = new catalogo_ticket($create_id, $fecha1);
                $result_upd = $obj_ticket->actualizar_ticket($obj_upd);
                if ($result_upd == 1) {
                    echo "<script>alert('ACTUALIZADO CON EXITO')</script>";
                } else {
                    echo "<script>alert('NO SE PUDO ACTUALIZAR')</script>";
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