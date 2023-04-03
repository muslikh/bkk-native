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
                         if($_GET['diterima'])
                        {
                            $id = $_GET['diterima'];
                            $id_lowongan = $_GET['id_lowongan'];
                            $diterima = mysqli_query($koneksi,"UPDATE lamaran SET status='DITERIMA' where id_user=$id And id_lowongan=$id_lowongan ");
                            
                            if($diterima)
                            {
                                header('location:'.$_SESSION['current_page'].'&pesan=sukses');
                                
                                 echo "<script>window.history.back();</script>";
                                
                                
                            }else
                            {
                                header('location:'. $_SERVER['HTTP_REFERER'].'&pesan=gagal');
                            }

                        }elseif($_GET['ditolak'])
                        {
                            $id = $_GET['ditolak'];
                            $ditolak = mysqli_query($koneksi,"UPDATE lamaran SET status='DITOLAK' where id_user=$id ");

                            if($ditolak)
                            {
                                header('location:'. $_SERVER['HTTPS_REFERER'].'&pesan=sukses');
                                
                                echo "<script>window.history.back();</script>";
                            }else
                            {
                                header('location:'. $_SERVER['HTTPS_REFERER'].'&pesan=gagal');
                            }
                            
                        }elseif (isset($_GET["hpslamaran"]))
                        {
                            
							$id = $_GET["hpslamaran"];
                            
                            $data=mysqli_query($koneksi,"DELETE FROM lamaran where id_user=$id");
                            
                            if($data)
                            {
                                header('location:lamaran.php?pesan=sukses');
                                
                                
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
                            <a href='lowongan.php?dtlowongan=".$data['id_lowongan']."'' class='btn btn-warning'>Kembali</a>
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
                          
                             $i=1;
                             
							$id = $_GET["dtpelamar"];
                            $dtpelamar=mysqli_query($koneksi,"SELECT * FROM lamaran , users where id_lowongan=$id AND lamaran.id_user=users.id");
 
						
						if(mysqli_num_rows($dtpelamar)>0){
								while($data = mysqli_fetch_assoc($dtpelamar)){
                                    echo "
                                   <td>".$i++."</td>
                                        
                                     <td>"."<img src='image/$data[gambar]' width='50' height='50' />"."</td>
                                     
                                        <td>".$data['nama']."</td>
                                        <td>".$data['tanggal']."</td>
                                        <td>".$data['status']."</td>
                                        <td>
                                            <a href='siswa.php?detail=".$data['id']."' class='btn btn-info'>Detail</a>
                                            <a href='pelamar.php?diterima=".$data['id']."
                                            ' class='btn btn-success'>Diterima</a>
                                            <a href='pelamar.php?ditolak=".$data['id']."' class='btn btn-warning'>Ditolak</a>
                                             <a href='pelamar.php?hpslamaran=".$data['id']."' class='btn btn-danger'>Hapus</a>
                                        </td>
                                    </tr>
                                    
                                    ";
								}
                            }else
                            {
                                echo '<tr><td colspan="4">Belum Ada Pelamar</td></tr>';
                            }
                        }	
						?>
        </table>
    </div>
</div>



</body>
</html>