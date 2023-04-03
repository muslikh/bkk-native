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
$user = mysqli_query($koneksi, "select * from users where id=$id");
while ($row = mysqli_fetch_array($user)){
   
    $gambar=$row['gambar'];
    $pdf->Image('image//' . $gambar,155,43,30,40);
    $pdf->Cell(100,2,'',0,1);
 
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(35 ,6,'Nama',0,0);
    $pdf->Cell(3 ,6,':',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0 ,6, $row['nama'],0,1);
    $pdf->Cell(100 ,6,'',0,1);//end of line
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(35 ,6,'Tempat, Tgl Lahir',0,0);
    $pdf->Cell(3 ,6,':',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(20 ,6, $row['tempat_lahir'],0,0);
    $pdf->Cell(2 ,6,',',0,0);
    $pdf->Cell(0 ,6, $row['tgl_lahir'],0,1);
    $pdf->Cell(100 ,6,'',0,1);//end of line
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(35 ,6,'Jenis Kelamin',0,0);
    $pdf->Cell(3 ,6,':',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0 ,6, $row['jenis_kelamin'],0,1);
    $pdf->Cell(100 ,6,'',0,1);//end of line
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(35 ,6,'Tinggi Badan',0,0);
    $pdf->Cell(3 ,6,':',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(8 ,6, $row['tinggi'],0,0);
    $pdf->Cell(0 ,6,'cm',0,1);
    $pdf->Cell(100 ,6,'',0,1);//end of line
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(35 ,6,'Berat Badan',0,0);
    $pdf->Cell(3 ,6,':',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(7 ,6, $row['berat'],0,0);
    $pdf->Cell(0 ,6,'cm',0,1);
    $pdf->Cell(100 ,6,'',0,1);//end of line
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(35 ,6,'Alamat',0,0);
    $pdf->Cell(3 ,6,':',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0 ,6, $row['alamat'],0,1);
    $pdf->Cell(100 ,6,'',0,1);//end of line
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(35 ,6,'No. Telp/ HP',0,0);
    $pdf->Cell(3 ,6,':',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0 ,6, $row['telepon'],0,1);
    $pdf->Cell(100 ,6,'',0,1);//end of line
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(35 ,6,'email',0,0);
    $pdf->Cell(3 ,6,':',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0 ,6, $row['email'],0,1);
    $pdf->Cell(100 ,6,'',0,1);//end of line
    
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(35 ,6,'Keahlian',0,0);
    $pdf->Cell(3 ,6,':',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0 ,6, $row['keahlian'],0,1);
    $pdf->Cell(100 ,6,'',0,1);//end of line
    
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(35 ,15,'Riwayat Pendidikan',0,1);
    $pdf->Cell(100 ,1,'',0,1);//end of line
    
    $data = $_GET ['id'];
$user = mysqli_query($koneksi, "select * from pendidikan where user_id=$id");
while ($row = mysqli_fetch_array($user)){
   
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(7 ,5,'+',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(12 ,5, $row['masuk'],0,0);
    $pdf->Cell(5 ,5,'-',0,0);
    $pdf->Cell(12 ,5, $row['lulus'],0,0);
    $pdf->Cell(5 ,5,'',0,0);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(10 ,5, $row['instansi'],0,1);
    $pdf->Cell(100 ,5,'',0,1);//end of line
    
}
    
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(35 ,15,'Riwayat Pekerjaan',0,1);
    $pdf->Cell(100 ,1,'',0,1);//end of line
    
$user = mysqli_query($koneksi, "select * from pekerjaan where user_id=$id");
while ($row = mysqli_fetch_array($user)){
   
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(7 ,5,'+',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(12 ,5, $row['masuk'],0,0);
    $pdf->Cell(5 ,5,'-',0,0);
    $pdf->Cell(12 ,5, $row['keluar'],0,0);
    $pdf->Cell(5 ,5,'',0,0);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(10 ,5, $row['tempat'],0,1);
    $pdf->Cell(100 ,5,'',0,1);//end of line
    
}
}

$pdf->Output();
?>