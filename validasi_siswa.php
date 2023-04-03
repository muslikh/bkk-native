<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
if(empty($_SESSION)){
	header("Location: index.php");
}
include 'koneksi.php';

$file=mysqli_query($koneksi,"SELECT * FROM users where role_id=3");

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
                        if (isset($_GET["detail"]))
                        {
                            
							$id = $_GET["detail"];
                            $detail=mysqli_query($koneksi,"SELECT * FROM users, jurusan where id=$id AND users.id_jurusan = jurusan.id_jurusan");
                            if(mysqli_num_rows($detail)>0){
								while($data = mysqli_fetch_assoc($detail)){
                                    echo "
                                    <a href='validasi_siswa.php' class='btn btn-warning'>Kembali</a>
                                    
                                    <br>
                                <br>
                                <div class='table-responsive-sm '>
                                    <table class='table table-bordered table-dark'>
                                  
                                    <tr><td colspan='3'>Detail Data Alumni</td></tr>
                                      <tr><td>No. KTP</td> <td> : </td> <td>".$data['username']."</td></tr>
                                    <tr><td>Nama</td> <td> : </td> <td>".$data['nama']."</td></tr>
                                     <tr><td>Tempat Lahir</td> <td> : </td> <td>".$data['tempat_lahir']."</td></tr>
                                    <tr><td>Tanggal Lahir</td> <td> : </td> <td>".$data['tgl_lahir']."</td></tr>
                                    <tr><td>Jenis Kelamin</td> <td> : </td> <td>".$data['jenis_kelamin']."</td></tr>
                                    <tr><td>Telepon</td> <td> : </td> <td>".$data['telepon']."</td></tr>
                                    <tr><td>Email</td> <td> : </td> <td>".$data['email']."</td></tr>
                                     <tr><td>Jurusan</td> <td> : </td> <td>".$data['jurusan']."</td></tr>
                                    <tr><td>Tahun Lulus</td> <td> : </td> <td>".$data['tahun_lulus']."</td></tr>
                                   
                                    
                                    ";
								}
                            }
                        

                        }elseif (isset($_GET["hapus"]))
                        {
                            
							$id = $_GET["hapus"];
                            
                            $data=mysqli_query($koneksi,"DELETE FROM users where id=$id");
                            
                            if($data)
                            {
                                header('location:siswa.php?pesan=sukses');
                                
                                echo "<meta http-equiv='refresh' content='0;validasi_siswa.php?'>";
                            }else
                            {
                                header('location:siswa.php?pesan=gagal');
                            }
                            
                        }elseif($_GET['diterima'])
                        {
                            $id = $_GET['diterima'];
                           $diterima = mysqli_query($koneksi,"UPDATE users SET role_id='2' where id=$id ");

                            if(diterima)
                            {
                                header('location:'. $_SERVER['HTTP_REFERER'].'&pesan=sukses');
                                
                                echo "<meta http-equiv='refresh' content='0;validasi_siswa.php?'>";
                            }else
                            {
                                header('location:'. $_SERVER['HTTP_REFERER'].'&pesan=gagal');
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
                            <a href='siswa.php' class='btn btn-warning'>Kembali</a>
                            
                    
                            <br>
                        <br>
                        <div class='table-responsive-sm '>
                            <table class='table table-bordered table-dark'>
                            
                            <tr>
                                <th>No.</th>
                                <th>No. KTP</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                            
                            <tr>";        
                            $i=1;
							if(mysqli_num_rows($file)>0){
								while($data = mysqli_fetch_assoc($file)){
                                    echo "
                                    <td>".$i++."</td>
                                    <td>".$data['username']."</td>
                                    <td>".$data['nama']."</td>
                                    <td>".$data['email']."</td>
                                    <td>".$data['telepon']."</td>
                                    <td>
                                        <a href='validasi_siswa.php?detail=".$data['id']."' class='btn btn-warning'>Detail</a>
                                        <a href='validasi_siswa.php?diterima=".$data['id']."' class='btn btn-success'>Terima</a>
                                        <a href='siswa.php?hapus=".$data['id']."' class='btn btn-danger'>Hapus</a>
                                    </td>
                                    </tr>";
								}
                            }
                        }	
						?>
        </table>
    </div>
</div>



</body>
</html>