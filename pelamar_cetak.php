<?php
// memanggil library FPDF
require('pdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->Cell(190,7,'',0,1,'C');
$pdf->Cell(190,7,'CURRICULUM VITAE',0,1,'C');
$pdf->SetFont('Arial','B',12);

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,6,'NIM',1,0);
$pdf->Cell(85,6,'NAMA MAHASISWA',1,0);
$pdf->Cell(27,6,'NO HP',1,0);
$pdf->Cell(25,6,'TANGGAL LHR',1,1);

$pdf->SetFont('Arial','',10);

include 'koneksi.php';
$sql = mysqli_query($koneksi, "select * from lamaran where id_lowongan=3 ");
while ($row = mysqli_fetch_array($sql)){
    $pdf->Cell(20,6,$row['id_user'],1,0);
    $pdf->Cell(85,6,$row[''],1,0);
    $pdf->Cell(27,6,$row['no_hp'],1,0);
    $pdf->Cell(25,6,$row['tanggal_lahir'],1,1); 
}

$pdf->Output();
?>