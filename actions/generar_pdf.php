<?php
require('../FPDF/fpdf.php');
require_once(__DIR__ . '/../class/class_alumno/class_alumno_dal.php');
require_once(__DIR__ . '/../class/class_ticket/class_ticket_dal.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curp = $_POST['lcurp'];
    $obj_alumno = new catalogo_alumno_dal;
    $res_alumno = $obj_alumno->datos_por_id($curp);

    $create_id = $_POST['create_id'];
    $obj_ticket = new catalogo_ticket_dal;
    $res_ticket = $obj_ticket->datos_por_id($create_id);
}

if (file_exists("../FPDF/phpqrcode/qrlib.php")) {
    require("../FPDF/phpqrcode/qrlib.php");

    $ruta_qr = "../FPDF/phpqrcode/qrcodes/" . $curp . ".png";
    $tamaño = 10;
    $level = "Q";
    $framSize = 3;

    QRcode::png($curp, $ruta_qr, $level, $tamaño, $framSize);
}

class PDF extends FPDF
{

    function Header()
    {
        if ($this->PageNo() == 1) {
            $this->Image('../src/images/frame.png', 0, 0, 210);
            $this->Ln(30);
            $this->SetFont('Arial', 'B', 25);
            $this->Cell(0, 20, 'Ticket de Turno', 0, 1, 'C');
        }
    }

    function Footer()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $curp = $_POST['lcurp'];
        }

        $this->Image('../FPDF/phpqrcode/qrcodes/' . $curp . '.png', 80, 100, 50, 50);
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    function Body()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $curp = $_POST['lcurp'];
            $obj_alumno = new catalogo_alumno_dal;
            $res_alumno = $obj_alumno->datos_por_id($curp);
            $create_id = $_POST['create_id'];
            $obj_ticket = new catalogo_ticket_dal;
            $res_ticket = $obj_ticket->datos_por_id($create_id);
        }



        $this->SetFont('Arial', '', 12);
        $this->Cell(40, 10, 'Nombre: ' . $res_alumno->getNOMBRE() . " " . $res_alumno->getAPELLIDO_PAT() . " " . $res_alumno->getAPELLIDO_MAT());
        $this->Ln(7);
        $this->Cell(40, 10, 'Correo electronico: ' . " " . $res_alumno->getEMAIL());
        $this->Ln(7);
        $this->Cell(40, 10, 'Telefono: ' . " " . $res_alumno->getTELEFONO());
        $this->Ln(7);
        $this->Cell(40, 10, 'Hola ' . $res_alumno->getNOMBRE() . " su ticket indica que su turno es el:  " . $res_ticket->getFECHA());
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->Body();
$pdf->Output('Ticket_de_Turno.pdf', 'I');
exit;
