<?php
//require('archivos/fpdf.php');

require('../app/views/archivos/fpdf.php');
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
   /* $this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Title',1,0,'C');
    // Salto de línea
    $this->Ln(20);*/
}

// Pie de página
function Footer()
{
   
}


}

// Creación del objeto de la clase heredada
$pdf = new PDF();

$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(60);
$pdf->Cell(70,10,'Unidad Comunitaria de Salud Familiar',0,0,'C');
$pdf->Ln(20);




$pdf->SetFont('Arial','B',10);
//$pdf->Cell(70);
//$pdf->Cell(60,80," Hola mundo",1, 0, 'C', 0);


//$pdf->Ln(20);
$pdf->Image('../app/views/archivos/credencial1.png',70,40,80);
//$pdf->Image('credencial1.png',70,40,80);
$pdf->Ln(51);
$pdf->Cell(85);
//$pdf->Cell(25,5,"DUGLAS ENRIQUE",0, 0, 'C', 0);
$pdf->Cell(25, 5, $parameters['credencial']->nombre_manip, 0, 0, 'C', 0);
$pdf->Ln(8);
$pdf->Cell(85);
//$pdf->Cell(25,5,"DIAZ BARAHONA",0, 0, 'C', 0);
$pdf->Cell(25, 5, $parameters['credencial']->apellido_manip, 0, 0, 'C', 0);
$pdf->Ln(16.5);
$pdf->Cell(102);
//$pdf->Cell(25,5,"04891509-5",0, 0, 'C', 0);
$pdf->Cell(25, 5, $parameters['credencial']->dui_manip, 0, 0, 'C', 0);


$pdf->Ln(7);
$pdf->Cell(109);
//$pdf->Cell(25,5,"VENCIMIENTO",0, 0, 'C', 0);
$pdf->Cell(25, 5, $parameters['credencial']->fecha_exped_creden, 0, 0, 'C', 0);
$pdf->Output();


?>