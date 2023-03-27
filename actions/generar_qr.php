<?php
require_once(__DIR__ . '/../class/class_alumno/class_alumno_dal.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curp = $_POST['lcurp'];
    $obj_alumno = new catalogo_alumno_dal;
    $res_alumno = $obj_alumno->datos_por_id($curp);
}


if (file_exists("../FPDF/phpqrcode/qrlib.php")) {
    require("../FPDF/phpqrcode/qrlib.php");

    $ruta_qr = "../FPDF/phpqrcode/qrcodes/" . $curp . ".png";
    $tamaño = 10;
    $level = "Q";
    $framSize = 3;

    QRcode::png($curp, $ruta_qr, $level, $tamaño, $framSize);

    if (file_exists($ruta_qr)) {
        $error = 0;
        $mensaje = "QR Generado";
    } else {
        $error = 1;
        $mensaje = "No existe la libreria";
    }

    $resp = [
        "error" => $error,
        "mensaje" => $mensaje,
        "datos" => $ruta_qr
    ];

    echo json_encode($resp);
}
?>