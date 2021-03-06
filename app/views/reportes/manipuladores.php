<?php 

//call main fpdf file
//require('../app/views/archivos/fpdf.php');

include('pdf_mc_table.php');




$pdf = new PDF_MC_Table();

//add page, set font
$pdf->AddPage();

$pdf->Image('../app/views/archivos/logominsal.png',10,8,33);
$pdf->Image('../app/views/archivos/log.jpeg',180,7,22);


$pdf->SetFont('Arial','B',12);

//set width for each column (6 columns)
$pdf->SetWidths(Array(50,25,25,20,40,30));
$pdf->SetFillColor(17, 213, 229);

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

 $pdf->Cell(60);
    // Título
     $pdf->Cell(70,10,'Unidad Comunitaria de Salud Familiar',0,0,'C');
      $pdf->Ln(8);
      $pdf->Cell(60);
     $pdf->Cell(70,10,'Reporte General de Manipuladores de Alimentos',0,0,'C');

    // Salto de línea
     $pdf->Ln(20);

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//load json data
//$json = file_get_contents('MOCK_DATA.json');
//$data = json_decode($json,true);

//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,5,"NOMBRE",0, 0, 'C', 1);
$pdf->Cell(25,5,"DUI",0, 0, 'C', 1);
$pdf->Cell(25,5,"PUESTO",0, 0, 'C', 1);
$pdf->Cell(20,5,"ESTADO",0, 0, 'C', 1);
$pdf->Cell(40,5,"ESTABLECIMIENTO",0, 0, 'C', 1);
$pdf->Cell(30,5,"SECTOR",0, 1, 'C', 1);

//$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',10);

for ($i=0; $i < count($parameters['manipuladores']) ; $i++) { 

    $pdf->Row(Array(
         $parameters['manipuladores'][$i]->nombre_manip.' ' .
         $parameters['manipuladores'][$i]->apellido_manip,
         $parameters['manipuladores'][$i]->dui_manip,
         $parameters['manipuladores'][$i]->puesto_manip,
         $parameters['manipuladores'][$i]->estado_manip,
         $parameters['manipuladores'][$i]->nombre_estab,
         $parameters['manipuladores'][$i]->tipo_estab,


    ));

     
}


//output the pdf
$pdf->Output();




 ?>