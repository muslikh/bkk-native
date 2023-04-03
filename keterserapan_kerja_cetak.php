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
$pdf->Cell(190,7,'DATA KETERSERAPAN KERJA',0,1,'C');
$pdf->SetFont('Arial','B',12);

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'NO',1,0);
$pdf->Cell(40,6,'NO KTP',1,0);
$pdf->Cell(65,6,'NAMA MAHASISWA',1,0);
$pdf->Cell(40,6,'TELEPON',1,0);
// $pdf->Cell(35,6,'EMAIL',1,0);
$pdf->Cell(35,6,'STATUS',1,1);

$pdf->SetFont('Arial','',10);


include 'koneksi.php';
$i=0;
$status_user = $_GET ['status_user'];
$user = mysqli_query($koneksi, "select * from users where status_user=$status_user ORDER BY nama ASC");
while ($row = mysqli_fetch_array($user)){
     $i++;
    $pdf->Cell(10,6,$i,1,0);
    $pdf->Cell(40,6,$row['username'],1,0);
    $pdf->Cell(65,6,$row['nama'],1,0);
    $pdf->Cell(40,6,$row['telepon'],1,0);
    // $pdf->Cell(35,6,$row['email'],1,0);
    $pdf->Cell(35,6,$row['status_user'],1,1); 
}

$pdf->Output();
?>