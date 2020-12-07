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
//PARA UN MARGEN BUENO DEBE DE MEDIR 190
$pdf->SetWidths(Array(35,40,25,35,15,20,20));
$pdf->SetFillColor(17, 213, 229);

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

 $pdf->Cell(60);
    // Título
     $pdf->Cell(70,10,'Unidad Comunitaria de Salud Familiar',0,0,'C');
      $pdf->Ln(8);
      $pdf->Cell(60);
     $pdf->Cell(70,10,'Reporte General de Establecimientos Activos',0,0,'C');

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
$pdf->Cell(35,5,"ESTAB",0, 0, 'C', 1);
$pdf->Cell(40,5,"PROPIETARIO",0, 0, 'C', 1);
$pdf->Cell(25,5,"TELEFONO",0, 0, 'C', 1);
$pdf->Cell(35,5,"DIRECCION",0, 0, 'C', 1);
$pdf->Cell(15,5,"A_E",0, 0, 'C', 1);
$pdf->Cell(20,5,"TIPO",0, 0, 'C', 1);
$pdf->Cell(20,5,"ESTADO",0, 1, 'C', 1);

//$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',10);

for ($i=0; $i < count($parameters['establecimientos']) ; $i++) { 

    $pdf->Row(Array(
         $parameters['establecimientos'][$i]->nombre_estab,
         $parameters['establecimientos'][$i]->nombre_prop.' ' .
         $parameters['establecimientos'][$i]->apellido_prop,
         $parameters['establecimientos'][$i]->telefono_estab,
         $parameters['establecimientos'][$i]->direccion_estab,
         $parameters['establecimientos'][$i]->apartado_especifico, 
         $parameters['establecimientos'][$i]->tipo_estab,
         $parameters['establecimientos'][$i]->estado_estab,


    ));

     
}


//output the pdf
$pdf->Output();




 ?>