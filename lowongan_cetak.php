<?php
// memanggil library FPDF
require('pdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',18);
// mencetak string 
$pdf->Cell(190,7,'',0,1,'C');
$pdf->Cell(190,7,'CURRICULUM VITAE',0,1,'C');
$pdf->SetFont('Arial','B',12);

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,15,'',0,1);

include 'koneksi.php';
$id = $_GET ['id'];
$user = mysqli_query($koneksi, "select * from lowongan where id_lowongan=$id");
while ($row = mysqli_fetch_array($user)){
   
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(7 ,5,'+',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(12 ,5, $row['kualifikasi'],0,0);
    $pdf->Cell(5 ,5,'-',0,0);
    $pdf->Cell(12 ,5, $row['lain'],0,0);
    $pdf->Cell(5 ,5,'',0,0);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(10 ,5, $row['tempat'],0,1);
    $pdf->Cell(100 ,5,'',0,1);//end of line
    
}

$pdf->Output();
?>