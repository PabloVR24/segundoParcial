<?php
require('../FPDF/fpdf.php');
require_once(__DIR__ . '/../class/class_alumno/class_alumno_dal.php');



class PDF extends FPDF
{

    function Header()
    {
        if ($this->PageNo() == 1) {
            $this->Image('../src/images/SecEd.png', 80, 6, 50);
            $this->Ln(20);
            $this->SetFont('Arial', 'B', 25);
            $this->Cell(0, 20, 'Ticket de Turno', 0, 1, 'C');
        }
    }

    function Footer()
    {
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
        }


        $this->SetFont('Arial', 'B', 16);
        $this->Cell(40, 10, 'Datos del PDF');
        $this->Ln(10);
        // $this->Image('qr.png',10,40,50);
        $this->SetFont('Arial', '', 12);
        $this->Cell(40, 10, 'Nombre: ' . $res_alumno->getNOMBRE() . " " . $res_alumno->getAPELLIDO_PAT() . " " . $res_alumno->getAPELLIDO_MAT());
        $this->Ln(10);
        $this->Cell(40, 10, 'Edad: 30 años');
        $this->Ln(10);
        $this->Cell(40, 10, 'Correo electrónico: ' . " " . $res_alumno->getEMAIL());
        //$this->Image('qrcode.png', 10, 10, 50, 50);
    }
}


//include '../FPDF/phpqrcode/qrlib.php';

// Obtener la CURP ingresada por el usuario


// Opciones de generación del código QR
// $tamaño = 10; // Tamaño de cada módulo en píxeles
// $nivel_correccion = 'H'; // Nivel de corrección de errores (L, M, Q, H)
// $bordes = 2; // Ancho del borde en módulos
// $almacenamiento = QR_CACHEABLE; // Almacenamiento de caché para el código QR

// // Generar el código QR en formato PNG
// QRcode::png($curp, 'qrcode.png', $nivel_correccion, $tamaño, $bordes, false);


$pdf = new PDF();
$pdf->AddPage();
$pdf->Body();
$pdf->Output('Ticket_de_Turno.pdf', 'I');
exit;