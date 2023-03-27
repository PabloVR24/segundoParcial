<?php
require('../FPDF/fpdf.php');
require_once(__DIR__ . '/../class/class_alumno/class_alumno_dal.php');



class PDF extends FPDF
{

    function Header()
    {
        if ($this->PageNo() == 1) {
            $this->Image('../src/images/SecEd.png', 80, 6, 50);
            $this->Ln(25);
            $this->SetFont('Arial', 'B', 25);
            $this->Cell(0, 20, 'Ticket de Turno', 0, 1, 'C');
        }
    }

    function Footer()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $curp = $_POST['lcurp'];
            $obj_alumno = new catalogo_alumno_dal;
            $res_alumno = $obj_alumno->datos_por_id($curp);
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
        }


        $this->SetFont('Arial', 'B', 16);
        $this->Cell(40, 10, 'Datos del PDF');
        $this->Ln(10);
        $this->SetFont('Arial', '', 12);
        $this->Cell(40, 10, 'Nombre: ' . $res_alumno->getNOMBRE() . " " . $res_alumno->getAPELLIDO_PAT() . " " . $res_alumno->getAPELLIDO_MAT());
        $this->Ln(10);
        $this->Cell(40, 10, 'Correo electronico: ' . " " . $res_alumno->getEMAIL());
    }
}


$pdf = new PDF();
$pdf->AddPage();
$pdf->Body();
$pdf->Output('Ticket_de_Turno.pdf', 'I');
exit;