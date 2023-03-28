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
            $this->SetFont('Times', 'B', 30);
            $this->Cell(0, 20, 'TICKET DE TURNO', 0, 1, 'C');
        }
    }

    function Footer()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $curp = $_POST['lcurp'];
        }

        $this->Image('../FPDF/phpqrcode/qrcodes/' . $curp . '.png', 66, 190, 80, 80);
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
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

        $this->Ln(8);

        $this->SetFont('Arial', 'B', 20);
        $this->Cell(50, 10, '   Nombre:');
        $this->SetFont('Courier', '', 20);
        $this->Cell(40, 10, $res_alumno->getNOMBRE() . " " . $res_alumno->getAPELLIDO_PAT() . " " . $res_alumno->getAPELLIDO_MAT());
        $this->Ln(12);

        $this->SetFont('Arial', 'B', 20);
        $this->Cell(50, 10, '   Telefono:');
        $this->SetFont('Courier', '', 20);
        $this->Cell(40, 10, $res_alumno->getTELEFONO());
        $this->Ln(12);

        $this->SetFont('Arial', 'B', 20);
        $this->Cell(50, 10, '   Correo:');
        $this->SetFont('Courier', '', 20);
        $this->Cell(40, 10, $res_alumno->getEMAIL());
        $this->Ln(28);  
        $this->Line(8,110,202,110);  

        $this->SetFont('Courier', 'B', 22);
        $this->Cell(5, 15, '', 0, 0, "C");
        $this->Cell(90, 15, 'TURNO:', 1, 0, "C");
        $this->Cell(90, 15, 'FECHA:', 1, 0, "C");
        $this->Cell(5, 15, '', 0, 0, "C");
        $this->SetFont('Courier', '', 25);
        $this->Ln(15);
        $this->Cell(5, 15, '', 0, 0, "C");
        $this->Cell(90, 20, $res_ticket->getTURNO(), 1, 0, "C");
        $this->Cell(90, 20, $res_ticket->getFECHA(), 1, 0, "C");
        $this->Cell(5, 15, '', 0, 0, "C");
        $this->Ln(30);

        $this->Cell(5, 15, '', 0, 0, "C");
        $this->Cell(180, 15, 'CURP POR CODIGO QR:', 1, 0, "C");
        $this->Cell(5, 15, '', 0, 0, "C");


    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->Body();
$pdf->Output('Ticket_de_Turno.pdf', 'I');
exit;
