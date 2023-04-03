<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
if(empty($_SESSION)){
	header("Location: index.php");
}
include 'koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Bursa Kerja Khusus | SMK NEGERI 1 PRIGEN</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<!--[if lt IE 9]>-->
	<!-- <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> -->
	<!--<![endif]-->
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <a href="./" style="color:white;">Bursa Kerja Khusus</a>
<a href="logout.php" class="btn btn-primary" onclick="return confirm('Yakin ingin Logout?')">Log out</a>

	
</nav>
<br>
<div class="container">


<span class=" text-center"><h5 ></h5></h5></span>
<br>
						<?php	
                        if (isset($_GET["dtlowongan"]))
                        {
                            $i=1;
							$id = $_GET["dtlowongan"];
                            $dtlowongan=mysqli_query($koneksi,"SELECT * FROM lowongan, industri, jurusan  where id_lowongan=$id  AND lowongan.id_industri=industri.id_industri AND lowongan.id_jurusan=jurusan.id_jurusan ");
                            if(mysqli_num_rows($dtlowongan)>0){
								while($data = mysqli_fetch_assoc($dtlowongan)){
                                    echo "
                                    <a href='lowongan.php' class='btn btn-warning'>Kembali</a>
                                    <a href='lowongan.php?edit=".$data['id_lowongan']."' class='btn btn-primary'>Ubah Data</a>
                                    <a href='lowongan.php?dtpelamar=".$data['id_lowongan']."' class='btn btn-primary'>Data Pelamar</a>
                            
                                    <br>
                                <br>
                                <div class='table-responsive-sm '>
                                    <table class='table table-bordered table-dark'>
                                  
                                    <tr><td colspan='3'>Detail Data Lowongan</td></tr>
                                     <tr><td>"."<img src='image/$data[gambar]' width='150' height='150' />"."</td></tr>
                                    <tr><td>Judul Lowongan</td> <td> : </td> <td>".$data['judul']."</td></tr>
                                    <tr><td>Nama Industri</td> <td> : </td> <td><a href='perusahaan.php?detail=".$data['id_industri']."'>".$data['nama']."</td></tr>
                                    <tr><td>Lowongan Buka</td> <td> : </td> <td>".$data['buka']."</td></tr>
                                    <tr><td>Batas Lowongan</td> <td> : </td> <td>".$data['tutup']."</td></tr>
                                    <tr><td>Deskripsi Lowongan</td> <td> : </td> <td>".$data['deskripsi']."</td></tr>
                                     <tr><td>Bidang Keahlian</td> <td> : </td> <td>".$data['jurusan']."</td></tr>
                                    <tr><td>Kualifikasi</td> <td> : </td> <td>".$data['kualifikasi']."</td></tr>
                                    <tr><td>Lain</td> <td> : </td> <td>".$data['lain']." </td></tr>
                                    ";
								}
                            }
                            
                        }elseif (isset($_GET["tambah"]))
                        {
                            
                            $pesan = $_GET["pesan"];
							$id = $_GET["tambah"];
                              
                            $file=mysqli_query($koneksi,"SELECT * FROM industri");
                            
                            $detail=mysqli_query($koneksi,"SELECT * FROM lowongan where id_lowongan=$id");
                                    if($pesan == 'sukses'){
                                        echo "
                                    <center><span class='alert alert-success'>Tambah Data Berhasil</span></center> ";
                                    }elseif($pesan == 'gagal')
                                    {
                                        echo " <center><span class='alert alert-danger'>Tambah Data Gagal</span></center>";
                                    }
                                    
                                    
                                    echo "
                                    
                                    <a href='lowongan.php?'class='btn btn-warning'>Kembali</a>
                                    <br>
                                    <br>
                                <div class='table-responsive-sm '>
                                    <table class='table table-bordered table-dark'>
                                    <form action='lowongan.php?ptambah' method='POST'>
                                    <tr><td colspan='3'>Tambah Data Lowongan</td></tr>
                                    
                                    <tr>
                                        <td>Nama Industri</td> <td> : </td> <td>
                                       <select name='id_industri' id='id_industri 'class='form-control' >
                                 
                                     ";
                                     
                                       while($dl = mysqli_fetch_assoc($file)){
                                             echo "
                                                            <option value='".$dl['id_industri']."'>
                                                               ".$dl['nama']."
                                                            </option>
                                                     ";
                                       }
								  
                                    echo "
                                      
                                                 
                                       </select>
                                     </td>
                                    </tr> 
                                    
                                    <input name='user_id' value='1' id='user_id' type='hidden' class='form-control' >
                                   <tr><td>Judul Lowongan</td> <td> : </td> <td><input name='judul' id='judul' type='text' class='form-control' ></td></tr>
                                    <tr><td>Deskripsi</td> <td> : </td> <td><input name='deskripsi' id='deskripsi' type='text' class='form-control' ></td></tr>
                                    <tr><td>Bidang Keahlian</td> <td> : </td> <td>
							        <select name='id_jurusan' id='id_jurusan 'class='form-control' >
                                    <option value='1'>AKUNTANSI</option>
                                    <option value='2'>MULTIMEDIA</option>
                                    <option value='3'>PERHOTELAN</option>
                                    <option value='4'>TEKNIK KOMPUTER DAN JARINGAN</option>
                                    <option value='5'>TATA BOGA</option>
                                    <option value='6'>TEKNIK SEPEDA MOTOR</option>
                                    </select>
											
                                   </td></tr>
                                    <tr><td>Batas Lowongan</td> <td> : </td> <td><input name='tutup' id='tutup' type='date' class='form-control' ></td></tr>
                                    <tr><td>Kualifikasi</td> <td> : </td> <td><textarea name='kualifikasi' id='kualifikasi' type='text' class='form-control' ></textarea></td></tr>
                                    <tr><td>Lain - Lain </td> <td> : </td> <td><textarea name='lain' id='lain' type='text' class='form-control' ></textarea></td></tr>
                                    <tr><td><input type='submit' class='btn btn-primary' value='Simpan'> </td></tr>
                                    </form>
                                    ";
								
                            
                        

                        }elseif (isset($_GET["ptambah"]))
                        {

							$id = $_POST["id_lowongan"];
							$id_industri = $_POST["id_industri"];
							$user_id = $_POST["user_id"];
							$id_jurusan = $_POST["id_jurusan"];
							$judul = $_POST["judul"];
							$deskripsi = $_POST["deskripsi"];
							$tgl = $_POST["tutup"];
							$kualifikasi = $_POST["kualifikasi"];
							$lain = $_POST["lain"];
							$buka = date("d-m-Y");
							$result=explode('-',$tgl);
                            $date=$result[2];
                            $month=$result[1];
                            $year=$result[0];
                            
                            //lapo di echo di ilangi ae
                            $new=$date.'-'.$month.'-'.$year;

                            $data = mysqli_query($koneksi,"INSERT into lowongan ( user_id,id_industri,id_jurusan,judul,deskripsi,tutup,kualifikasi,lain,buka)
                            VALUES ('$user_id','$id_industri','$id_jurusan','$judul','$deskripsi','$new','$kualifikasi','$lain','$buka') ");

                            if($data)
                            {
                                header('location:lowongan.php?dtlowongan='.$id_lowongan.'&pesan=sukses');
                                
                                 echo "<meta http-equiv='refresh' content='0;lowongan.php?'>";
                                 
                                 define( 'API_ACCESS_KEY', 'AAAAMLTW7JY:APA91bGHOUZHZifGn5olyVyeoAlLV3Lfo_jM9VtzRPjTSSvuiQFSDxCgMmq3C4hObG7LByB8kxJD0Y52Xn20RZCJ3VDHo0m0GmJQ2-Tkrjc1Jn8Yc_gC7im6S8YvXDlzZXlqxJI6J69Q' );
// $registrationIds = array( $_GET['id'] );
$registrationIds = '';




// prep the bundle
$msg = array
(
    // Pengumuman Hasil seleksi telah selesai,\n  silahkan cek pada menu hasil seleksi, kemudian cari namamu, setelah ketemu klik, kemudian isikan kode daftar ulang, kode daftar ulang siahkan di cek di email kalian saat pendaftaran, jika di kotak masuk tidak ada silahkan cek di folder spam
    'message'   => $judul,
    'title'     => 'Lowongan Kerja Baru',
    'subtitle'  => 'This is a subtitle. subtitle',
    'tickerText'    => 'Ticker text here...Ticker text here...Ticker text here',
    'intent' => 'MainActivity.class',
    'vibrate'   => 1,
    'sound'     => 1,
    'largeIcon' => 'large_icon',
    'smallIcon' => 'small_icon'
);
$fields = array
(   
    //per id
    // 'registration_ids'  =>array($ids1,$ids2) , 
    
    //group id
     'to'  => '/topics/bkk',
    'data'          => $msg
);
  
$headers = array
(
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
);
  
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );


                                 
                            }else
                            {
                                header('location:lowongan.php?dtlowongan='.$id_lowongan.'&pesan=gagal');
                            }
                        

                        }elseif (isset($_GET["edit"]))
                        {
                            
                            $pesan = $_GET["pesan"];
                            
							$id = $_GET["edit"];
                            $dtlowongan=mysqli_query($koneksi,"SELECT * FROM lowongan, industri, jurusan where id_lowongan=$id  AND lowongan.id_industri=industri.id_industri AND lowongan.id_jurusan=jurusan.id_jurusan");
                            if(mysqli_num_rows($dtlowongan)>0){
								while($data = mysqli_fetch_assoc($dtlowongan)){
                                    if($pesan == 'sukses'){
                                        echo "
                                       <center><span class='alert alert-success'>Update Data Berhasil</span></center> ";
                                    }elseif($pesan == 'gagal')
                                    {
                                        echo "<center><span class='alert alert-danger'>Update Data Gagal</span></center>";
                                    }
                                    echo "
                                  
                                    <a href='lowongan.php?dtlowongan=".$data['id_lowongan']."' class='btn btn-warning'>Kembali</a>
                                <br>
                                <br>
                                <div class='table-responsive-sm '>
                                    <table class='table table-bordered table-dark'>
                                    <form action='lowongan.php?pupdate' method='POST'>
                                    <tr><td colspan='3'>Ubah Data Lowongan</td></tr>
                                    <tr><td>Nama Industri</td> <td> : </td>
                                     <td>
                                     <input type='hidden' id='id_lowongan' name='id_lowongan' value='".$data['id_lowongan']."'>
                                     ".$data['nama']."
                                     </td></tr>
                                    <tr><td>Judul</td> <td> : </td> <td><input name='judul' id='judul' type='text' class='form-control' value='".$data['judul']."'></td></tr>
                                    <tr><td>Batas Lowongan</td> <td> : </td> <td> ".$data['tutup']."<br><input name='tutup' id='tutup' type='date' class='form-control' ></td></tr>
                                    <tr><td>Deskripsi</td> <td> : </td> <td><input name='deskripsi' id='deskripsi' type='text' class='form-control' value='".$data['deskripsi']."'></td></tr>
                                     <tr><td>Jurusan</td> <td> : </td> <td>
                                     ".$data['jurusan']."<br>
							        <select name='id_jurusan' id='id_jurusan 'class='form-control' >
                                    <option value='1'>AKUNTANSI</option>
                                    <option value='2'>MULTIMEDIA</option>
                                    <option value='3'>PERHOTELAN</option>
                                    <option value='4'>TEKNIK KOMPUTER DAN JARINGAN</option>
                                    <option value='5'>TATA BOGA</option>
                                    <option value='6'>TEKNIK SEPEDA MOTOR</option>
                                    </select>
											
                                   </td></tr>
                                   <tr><td>Kualifikasi</td> <td> : </td> <td> <textarea name='kualifikasi' id='kualifikasi' rows='5' class='form-control' value='".$data['kualifikasi']."'>".$data['kualifikasi']." </textarea></td></tr>
                                    
                                    <tr><td>Lain Lain</td> <td> : </td> <td> <textarea name='lain' id='lain' rows='5' class='form-control' value='".$data['lain']."'>".$data['lain']." </textarea></td></tr>
                                  
                                    <tr><td><input type='submit' value='Simpan' class='btn btn-primary'></input></td></tr>
                                    </form>
                                    ";
								}
                            }
                        

                        }elseif (isset($_GET["pupdate"]))
                        {

							// $id = $_GET["pupdate"];
							$id  = $_POST["id_lowongan"];
							$id_jurusan = $_POST["id_jurusan"];
							$judul = $_POST["judul"];
							$deskripsi = $_POST["deskripsi"];
							$tgl = $_POST["tutup"];
							$kualifikasi = $_POST["kualifikasi"];
							$lain = $_POST["lain"];
							$result=explode('-',$tgl);
                            $date=$result[2];
                            $month=$result[1];
                            $year=$result[0];
                            
                            //lapo di echo di ilangi ae
                            $new=$date.'-'.$month.'-'.$year;
                            
                            $data = mysqli_query($koneksi,"UPDATE lowongan SET id_jurusan='$id_jurusan',judul='$judul', deskripsi='$deskripsi', tutup='$new',
                            kualifikasi='$kualifikasi', lain='$lain' where id_lowongan=$id ");

                            if($data)
                            {
                                header('location:'. $_SERVER['HTTP_REFERER'].'&pesan=sukses');
                                
                                 echo "<meta http-equiv='refresh' content='0;lowongan.php?dtlowongan=$id'>";
                            }else
                            {
                                header('location:'. $_SERVER['HTTP_REFERER'].'&pesan=gagal');
                            }
                            
                        }elseif (isset($_GET["hpslowongan"]))
                        {
                            
							$id = $_GET["hpslowongan"];
                            
                            $data=mysqli_query($koneksi,"DELETE FROM lowongan where id_lowongan=$id");
                            
                            if($data)
                            {
                                header('location:lowongan.php?pesan=sukses');
                                
                                echo "<meta http-equiv='refresh' content='0;lowongan.php?'>";
                                
                            }else
                            {
                                 header('location:lowongan.php?pesan=gagal');
                            }

                            
                        } elseif (isset($_GET["dtpelamar"]))
                        {
                            $i=1;
							$id = $_GET["dtpelamar"];
                            $dtpelamar=mysqli_query($koneksi,"SELECT * FROM lamaran , users where id_lowongan=$id AND lamaran.id_user=users.id");
                            
                            echo "
                                    <a href='lowongan.php?dtlowongan=".$id."' class='btn btn-warning'>Kembali</a>
                            
                                    <br>
                                <br>
                                <div class='table-responsive-sm '>
                                    <table class='table table-bordered table-dark'>
                                  
                                    <tr><td colspan='3'> Data Pelamar </td></tr>
                                    <tr>
                                        <th>No.</th>
                                        <th>Foto</th>
                                        <th>Nama Pelamar</th>
                                        <th>Dikirim Tanggal</th>
                                        <th>Status Lamaran</th>
                                        <th>Aksi</th>
                                    </tr>";

                            
                            if(mysqli_num_rows($dtpelamar)>0){
								while($data = mysqli_fetch_assoc($dtpelamar)){
                                    echo "
                                    <tr>
                                        <td>".$i++."</td>
                                        
                                     <td>"."<img src='image/$data[gambar]' width='50' height='50' />"."</td>
                                        <td>".$data['nama']."</td>
                                        <td>".$data['tanggal']."</td>
                                        <td>".$data['status']."</td>
                                       
                                        <td>
                                            <a href='siswa.php?detail=".$data['id']."' class='btn btn-info'>Detail</a>
                                            <a href='lowongan.php?diterima=".$data['id_lamaran']."
                                            ' class='btn btn-success'>Diterima</a>
                                            <a href='lowongan.php?ditolak=".$data['id_lamaran']."' class='btn btn-warning'>Ditolak</a>
                                             <a href='lowongan.php?hpslamaran=".$data['id_lamaran']."' class='btn btn-danger'>Hapus</a>
                                        </td>
                                    </tr>
                                     <td colspan='1'><b>Pesan</b></td>
                                       
                                    
                                     <td colspan='5'>".$data['pesan']."</td>
                                    
                                    ";
								}
                            }else
                            {
                                echo '<tr><td colspan="4">Belum Ada Pelamar</td></tr>';
                            }
                        
     
                        }elseif($_GET['diterima'])
                        {
                            $id = $_GET['diterima'];
                            $id_lowongan =$_GET['id_lowongan'];
                           
                            $diterima=mysqli_query($koneksi,"SELECT * FROM lamaran where id_lamaran=$id");
                            if(mysqli_num_rows($diterima)>0){
								while($data = mysqli_fetch_assoc($diterima)){
                                    if($pesan == 'sukses'){
                                        echo "
                                       <center><span class='alert alert-success'>Update Data Berhasil</span></center> ";
                                    }elseif($pesan == 'gagal')
                                    {
                                        echo "<span class='alert alert-danger'>Update Data Berhasil</span>";
                                    }
                                    echo "
                                    
                                    <a href='lowongan.php?dtpelamar=".$data['id_lowongan']."' class='btn btn-warning'>Kembali</a>
                                <br>
                                <br>
                                <div class='table-responsive-sm '>
                                    <table class='table table-bordered table-dark'>
                                    <form action='lowongan.php?lupdate' method='POST' enctype='multipart/form-data'>
                                    <tr><td colspan='3'>Lamaran Diterima</td></tr>
                                     <input type='hidden' id='id_lamaran' name='id_lamaran' value='".$data['id_lamaran']."'>
                                      <input type='hidden' id='id_lowongan' name='id_lowongan' value='".$data['id_lowongan']."'>
                                      <input type='hidden' id='status' name='status' value='DITERIMA'>
                                    <tr><td>Pesan</td> <td> : </td>
                                     <td><input name='pesan' id='pesan' type='text' class='form-control' value='".$data['pesan']."'>
                                     </td></tr>
                                      <tr><td><input type='submit' value='Kirim' class='btn btn-primary'></input></td></tr>
                                    </form>
                                    ";
								}
                            }
                            
                       
                        }elseif($_GET['ditolak'])
                        {
                           $id = $_GET['ditolak'];
                            $id_lowongan =$_GET['id_lowongan'];
                           
                            $ditolak=mysqli_query($koneksi,"SELECT * FROM lamaran where id_lamaran=$id");
                            if(mysqli_num_rows($ditolak)>0){
								while($data = mysqli_fetch_assoc($ditolak)){
                                    if($pesan == 'sukses'){
                                        echo "
                                       <center><span class='alert alert-success'>Update Data Berhasil</span></center> ";
                                    }elseif($pesan == 'gagal')
                                    {
                                        echo "<span class='alert alert-danger'>Update Data Berhasil</span>";
                                    }
                                    echo "
                                    
                                    <a href='lowongan.php?dtpelamar=".$data['id_lowongan']."' class='btn btn-warning'>Kembali</a>
                                <br>
                                <br>
                                <div class='table-responsive-sm '>
                                    <table class='table table-bordered table-dark'>
                                    <form action='lowongan.php?lupdate' method='POST' enctype='multipart/form-data'>
                                    <tr><td colspan='3'>Lamaran Diterima</td></tr>
                                     <input type='hidden' id='id_lamaran' name='id_lamaran' value='".$data['id_lamaran']."'>
                                      <input type='hidden' id='id_lowongan' name='id_lowongan' value='".$data['id_lowongan']."'>
                                      <input type='hidden' id='status' name='status' value='DITOLAK'>
                                    <tr><td>Pesan</td> <td> : </td>
                                     <td><input name='pesan' id='pesan' type='text' class='form-control' value='".$data['pesan']."'>
                                     </td></tr>
                                      <tr><td><input type='submit' value='Kirim' class='btn btn-primary'></input></td></tr>
                                    </form>
                                    ";
								}
                            }
                            
                            
                        }elseif (isset($_GET["lupdate"]))
                        {
							$id = $_POST["id_lamaran"];
							$id_lowongan = $_POST["id_lowongan"];
							$status = $_POST["status"];
							$pesan = $_POST["pesan"];
							$tanggal2 = date("d-m-Y");
					
                            $data = mysqli_query($koneksi,"UPDATE lamaran SET 
                            status='$status', pesan='$pesan', tanggal2='$tanggal2' where id_lamaran=$id ");

                            if($data)
                            {
                                header('location:lamaran.php?edit='.$id_lowongan.'&pesan=sukses');
                               
                          echo "<meta http-equiv='refresh' content='0;lowongan.php?dtpelamar=$id_lowongan'>";
                           
                            }else
                            {
                                header('location:perusahaan.php?edit='.$id.'&pesan=gagal');
                            }
                            
                            
                            
                        }elseif (isset($_GET["hpslamaran"]))
                        {
                            
							$id = $_GET["hpslamaran"];
                            
                            $data=mysqli_query($koneksi,"DELETE FROM lamaran where id_lamaran=$id");
                            
                            if($data)
                            {
                                header('location:lamaran.php?pesan=sukses');
                                
                                // echo "<meta http-equiv='refresh' content='0;lamaran.php?'>";
                                
                                echo "<script>window.history.back();</script>";
                                
                            }else
                            {
                                 header('location:lamaran.php?pesan=gagal');
                            }

                        }else{
                            $pesan = $_GET['pesan'];

                            if($pesan == 'sukses'){
                                echo "
                            <center><span class='alert alert-success'>Hapus Data Berhasil</span></center> ";
                            }elseif($pesan == 'gagal')
                            {
                                echo " <center><span class='alert alert-danger'>Hapus Data Gagal</span></center>";
                            }
                            echo "
                            <a href='home.php' class='btn btn-warning'>Kembali</a>
                            <a href='lowongan.php?tambah' class='btn btn-primary'>Tambah Data</a>
                    
                            <br>
                        <br>
                        <div class='table-responsive-sm '>
                            <table class='table table-bordered table-dark'>
                            
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
                                <th>Judul Lowongan</th>
                                <th>Nama Industri</th>
                                <th>Buka</th>
                                <th>Tutup</th>
                                <th>Aksi</th>
                            </tr>
                            
                            <tr>";        
                            $i=1;

                            $file=mysqli_query($koneksi,"SELECT * FROM lowongan, industri where lowongan.id_industri=industri.id_industri ");

							if(mysqli_num_rows($file)>0){
								while($data = mysqli_fetch_assoc($file)){
                                    echo "
                                    <td>".$i++."</td>
                                    <td>"."<img src='image/$data[gambar]' width='50' height='50' />"."</td>
                                     <td>".$data['judul']."</td>
                                    <td><a href='perusahaan.php?detail=".$data['id_industri']."'>".$data['nama']."</a></td>
                                    <td>".$data['buka']."</td>
                                    <td>".$data['tutup']."</td>
                                    <td>
                                        <a href='lowongan.php?dtlowongan=".$data['id_lowongan']."' class='btn btn-warning'>Detail</a>
                                        <a href='lowongan.php?hpslowongan=".$data['id_lowongan']."' class='btn btn-danger'>Hapus</a>
                                    </td>
                                    </tr>
                                    
                                    
                                    ";
								}
                            }
                        }	
						?>
        </table>
    </div>
</div>



</body>
</html>