
<?php 
require('../app/views/archivos/fpdf.php');




class PDF extends FPDF
{
// Cabecera de página
    function Header()
    {
    // Logo

     $this->Image('../app/views/archivos/logominsal.png',10,8,33);
     $this->Image('../app/views/archivos/log.jpeg',180,7,22);
    // Arial bold 15
     $this->SetFont('Arial','B',12);
     //$this->SetDrawColor(0,80,180);
     $this->SetFillColor(17, 213, 229);
     //$this->SetTextColor(220,50,50);

         // Movernos a la derecha
     $this->Cell(60);
    // Título
     $this->Cell(70,10,'Unidad Comunitaria de Salud Familiar',0,0,'C');
      $this->Ln(8);
      $this->Cell(60);
     $this->Cell(70,10,'Reporte General de Manipuladores de Alimentos del Sector Informal',0,0,'C');

    // Salto de línea
     $this->Ln(20);

     //El primer cero indica el que no tiene borde la celda
     //El ultimo 1 indica que si tiene relleno
     //El segundo 1 de la ultima linea indica un salto de linea despues de cada fila
     //El primero despues de cell indica lo largo y el segundo lo alto
     $this->Cell(30, 8, 'NOMBRE', 0, 0, 'C', 1);
     $this->Cell(30, 8, 'APELLIDO', 0, 0, 'C', 1);
     $this->Cell(20, 8, 'DUI', 0, 0, 'C', 1);
     $this->Cell(20, 8, 'PUESTO', 0, 0, 'C', 1);
     $this->Cell(20, 8, 'ESTADO', 0, 0, 'C', 1);
     $this->Cell(50, 8, 'ESTABLECIMIENTO', 0, 0, 'C', 1);
     $this->Cell(20, 8, 'SECTOR', 0, 1, 'C', 1);
 }

// Pie de página
 function Footer()
 {
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);

    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}


}











$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',10);

//$pdf->Cell(40,10, utf8_decode('¡Hola, Mundo!'));

//$parameters->['manipuladores']['2']->dui_manip

//$pdf->Cell(70, 10, $parameters['manipuladores']['2']->nombre_manip, 1, 0, 'C', 0);

for ($i=0; $i < count($parameters['manipuladores']) ; $i++) { 

    $pdf->Cell(30, 8, $parameters['manipuladores'][$i]->nombre_manip, 0, 0, 'C', 0);
    $pdf->Cell(30, 8, $parameters['manipuladores'][$i]->apellido_manip, 0, 0, 'C', 0);
     $pdf->Cell(20, 8, $parameters['manipuladores'][$i]->dui_manip, 0, 0, 'C', 0);
    $pdf->Cell(20, 8, $parameters['manipuladores'][$i]->puesto_manip, 0, 0, 'C', 0);
     $pdf->Cell(20, 8, $parameters['manipuladores'][$i]->estado_manip, 0, 0, 'C', 0);
      $pdf->Cell(50, 8, $parameters['manipuladores'][$i]->nombre_estab, 0, 0, 'C', 0);
       $pdf->Cell(20, 8, $parameters['manipuladores'][$i]->tipo_estab, 0, 1, 'C', 0);
    
}

$pdf->Output();


 ?>



