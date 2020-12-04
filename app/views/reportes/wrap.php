<?php 
require('../app/views/archivos/fpdf.php');

class myPDF extends FPDF{
	function myCell($w, $h, $x, $t){
		$height = $h/3;
		$first = $height+2;
		$second = $height+$height+$height+3;
		$len = strlen($t);

		if($len>15){
			$txt = str_split($t, 15);
			$this->SetX($x);
			$this->Cell($w, $first, $txt[0], '', '', '');
			$this->SetX($x);
			$this->Cell($w, $second, $txt[0], '', '', '');
			$this->SetX($x);
			$this->Cell($w, $h, '', 'LTRB', 0, 'L', 0);

		}else{
			$this->SetX($x);
			$this->Cell($w, $h, $t, 'LTRB', 0, 'L', 0);

		}
	}
}

$pdf = new myPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 16);
$pdf->Ln();

$w = 45;
$h = 16;

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, '1.1 satu titik satu');

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, '1.2 satu titik satu');

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, '1.3 satu titik satu');

$x = $pdf->GetX();
$pdf->myCell($w, $h, $x, '1.3 satu titik satu');

$pdf->Ln();

$pdf->Output();



 ?>