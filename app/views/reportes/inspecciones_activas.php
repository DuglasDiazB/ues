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
$pdf->SetWidths(Array(40,25,40,30,25,20));
$pdf->SetFillColor(17, 213, 229);

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

 $pdf->Cell(60);
    // Título
     $pdf->Cell(70,10,'Unidad Comunitaria de Salud Familiar',0,0,'C');
      $pdf->Ln(8);
      $pdf->Cell(60);
     $pdf->Cell(70,10,'Reporte General de Inspecciones Activas',0,0,'C');

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
$pdf->Cell(40,5,"ESTABLECIMIENTO",0, 0, 'C', 1);
$pdf->Cell(25,5,"OBJETO",0, 0, 'C', 1);
$pdf->Cell(40,5,"INSPECTOR",0, 0, 'C', 1);
$pdf->Cell(30,5,"PARA",0, 0, 'C', 1);
$pdf->Cell(25,5,"FECHA",0, 0, 'C', 1);
$pdf->Cell(20,5,"NOTA",0, 1, 'C', 1);

//$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',10);

for ($i=0; $i < count($parameters['inspecciones']) ; $i++) { 

    $pdf->Row(Array(
     $parameters['inspecciones'][$i]->nombre_estab,
     $parameters['inspecciones'][$i]->objeto_visita,
     $parameters['inspecciones'][$i]->nombre_inspector,
     $parameters['inspecciones'][$i]->inspec_para,
     $parameters['inspecciones'][$i]->fecha_inspec,
     $parameters['inspecciones'][$i]->cal_primer_inspec,

         


    ));

     
}


//output the pdf
$pdf->Output();




 ?>