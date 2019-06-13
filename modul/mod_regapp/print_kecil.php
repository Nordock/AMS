<?php
/*
 * file ini berfungsi untuk menghasilkan output file pdf
 * yang siap cetak, dengan ukuran kertas A5 atau separuh dari kuarto
 * silakan rubah ukuran masing-masing variabel untuk menentukan panjang dan lebar kertas
 * 
 * variabel $line_h berfungsi untuk mengatur tinggi tiap-tiap baris
 * variabel $font berfungsi untuk mengatur tampilan font pada file pdf defaultnya adalah Arial
 * 
 */
require_once("../../config/konfersi_pdf/konversi-angka.php");
require_once("../../config/konfersi_pdf/fpdf/fpdf.php");
//require_once("pengaturan.php");
//paket
//jns pembayarn
//nama

$oid = isset($_GET['oid']) ? $_GET['oid'] : ''; 
$nojamaah= isset($_GET['nojamaah']) ? $_GET['nojamaah'] : ''; ''; 
$nominal = isset($_GET['nominal']) ? $_GET['nominal'] : ''; 
$datereq = isset($_GET['datereq']) ? $_GET['datereq'] : '';  
$bildesc = isset($_GET['bildesc']) ? $_GET['bildesc'] : ''; 
$nmjamaah= isset($_GET['nmjamaah']) ? $_GET['nmjamaah'] : ''; 
$nmpaket= isset($_GET['nmpaket']) ? $_GET['nmpaket'] : ''; 
$pembayaran= isset($_GET['pembayaran']) ? $_GET['pembayaran'] : '';
$uang=number_format($nominal,0,",",".").',-';

$konversi=new Konversi();
//$pengaturan=new Pengaturan();
//$pdf=new FPDF('L','mm','A5');/*L untuk tampilan Landscape, A5 adalah ukuran kertasnya*/
$pdf=new FPDF('P','mm',array(80,110));
/*
 * Pengaturan Nama Bulan sesuai bahasa Indonesia
 */

/*membuat file PDF untuk dicetak*/
$pdf->setMargins(5,5,5);
$pdf->AddPage();

$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,7,'FIRST TRAVEL',0,1,'C');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,'ORDER ID '."$oid",0,1,'C');
$pdf->Ln(2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,5,'Kode Jamaah',0,1,'C');
$pdf->Ln(2);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,5,"$nojamaah",0,1,'C');
//frame
$pdf->SetLineWidth(0.4);
$pdf->Rect(5,18,70,14);/*ubah ukuran Kotak Judul -> Rect(sumbu x, sumbu y, lebar kotak,tinggi kotak)*/
$pdf->Ln(3);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(25,5,'Tgl Order :',0,1,'L');
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,5,"$datereq",'J');



$pdf->Ln(2);


$pdf->SetFont('Arial','B',11);
$pdf->Cell(30,5,'Nama Paket',0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,5,": "."$nmpaket",'J');

$pdf->SetFont('Arial','B',11);
$pdf->Cell(30,5,'Pembayaran',0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,5,": "."$pembayaran",'J');

$pdf->SetFont('Arial','B',11);
$pdf->Cell(30,5,'Nominal Bayar',0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,5,": "."$uang",'J');

$pdf->SetFont('Arial','B',11);
$pdf->Cell(30,5,'Nama Jamaah',0,0,'L');
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,5,": "."$nmjamaah",'J');


$pdf->Ln(5);
$pdf->Output();

?>