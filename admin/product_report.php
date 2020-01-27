<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Store Management',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Phone : +61412123123',0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Adelaide SA',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'website : www.store-test.com email : store@test.com',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);
$pdf->Line(1,3.2,28.5,3.2);
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"Product Report",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Print at: ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Name', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Type', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Supplier', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Price', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Quantity', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query=$mysql->query("select * from product");
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(7, 0.8, $lihat['name'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['type'], 1, 0,'C');
	$pdf->Cell(4, 0.8, $lihat['supplier'],1, 0, 'C');
	$pdf->Cell(4.5, 0.8, $lihat['price'],1, 0, 'C');
	$pdf->Cell(2, 0.8, $lihat['quantity'], 1, 1,'C');

	$no++;
}

$pdf->Output("poduct_report.pdf","I");

?>
