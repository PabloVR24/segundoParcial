<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../css/styles2.css">
<?php

require_once('..\class\class_ticket\class_ticket_dal.php');

// Recuperar los datos y el mensaje de éxito de la URL
$exito = $_GET['exito'] ?? false;
$create_id = $_GET['create_id'] ?? '';
$message = "";

$obj_ticket = new catalogo_ticket_dal;
$resultado = $obj_ticket->datos_por_id($create_id);

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
        print("Nombre Completo: " . $resultado->getNOMBRE() . " " . $resultado->getAPELLIDO_PAT() . " " . $resultado->getAPELLIDO_MAT());
        print("<br><br><br>");
        print("Registrado por " . $resultado->getNOMBRE_REALIZA())
        ?>
    </div>
</div>