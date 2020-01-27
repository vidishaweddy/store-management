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
$pdf->Cell(0,0.7,'Sales Report on '.date("Y-m-d", strtotime($_GET['date'])),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Print at : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Date', 1, 0, 'C');
$pdf->Cell(6, 0.8, 'Name', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Quantity', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Price', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Total Price', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Profit', 1, 1, 'C');

$no=1;
$date=$_GET['date'];
$query=$mysql->query("select * from sales where date='".$date."'");
while($sale_row=mysqli_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, date("D-d/m/Y", strtotime($sale_row['date'])),1, 0, 'C');
	$pdf->Cell(6, 0.8, $sale_row['name'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $sale_row['quantity'], 1, 0,'C');
	$pdf->Cell(4, 0.8, "$ ".number_format($sale_row['price']), 1, 0,'C');
	$pdf->Cell(4.5, 0.8, "$ ".number_format($sale_row['total']),1, 0, 'C');
	$pdf->Cell(4, 0.8, "$ ".number_format($sale_row['profit']), 1, 1,'C');

	$no++;
}
$q=$mysql->query("select sum(total) as total from sales where date='".$date."'");
// select sum(total_price) as total from sales where date='$date'
while($total=mysqli_fetch_array($q)){
	$pdf->Cell(17, 0.8, "Total", 1, 0,'C');
	$pdf->Cell(4.5, 0.8, "$ ".number_format($total['total']), 1, 0,'C');
}
$qu=$mysql->query("select sum(profit) as total_profit from sales where date='".$date."'");
// select sum(profit) as total from sales where date='$date'
while($tl=mysqli_fetch_array($qu)){
	$pdf->Cell(4, 0.8, "$ ".number_format($tl['total_profit']), 1, 1,'C');
}
$pdf->Output("laporan_buku.pdf","I");

?>
