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
$pdf->SetWidths(Array(40,25,20,20,25,20,20,20));
$pdf->SetFillColor(17, 213, 229);

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

 $pdf->Cell(60);
    // Título
     $pdf->Cell(70,10,'Unidad Comunitaria de Salud Familiar',0,0,'C');
      $pdf->Ln(8);
      $pdf->Cell(60);
     $pdf->Cell(70,10,'Reporte General de Manipuladores de Examenes Clinicos Aptos',0,0,'C');

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
$pdf->Cell(40,5,"MANIPULADOR",0, 0, 'C', 1);
$pdf->Cell(25,5,"FECHA S0",0, 0, 'C', 1);
$pdf->Cell(20,5,"EXAM_S",0, 0, 'C', 1);
$pdf->Cell(20,5,"EXAM_O",0, 0, 'C', 1);
$pdf->Cell(25,5,"FECHA_SO2",0, 0, 'C', 1);
$pdf->Cell(20,5,"EXAM_S2",0, 0, 'C', 1);
$pdf->Cell(20,5,"EXAM_02",0, 0, 'C', 1);
$pdf->Cell(20,5,"ESTADO",0, 1, 'C', 1);

//$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',10);

for ($i=0; $i < count($parameters['examenes']) ; $i++) { 

    $pdf->Row(Array(
         $parameters['examenes'][$i]->nombre_manip.' ' .
         $parameters['examenes'][$i]->apellido_manip,
         $parameters['examenes'][$i]->fecha_entrega_so,
         $parameters['examenes'][$i]->exam_s,
         $parameters['examenes'][$i]->exam_o,
         $parameters['examenes'][$i]->fecha_entrega_so2,
         $parameters['examenes'][$i]->exam_s2,
         $parameters['examenes'][$i]->exam_o2,
         $parameters['examenes'][$i]->estado_exam,



         


    ));

     
}


//output the pdf
$pdf->Output();




 ?>