<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
if(empty($_SESSION)){
	header("Location: index.php");
}
include 'koneksi.php';

$file=mysqli_query($koneksi,"SELECT * FROM users where status_user='KERJA' ");
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
                            <a href='keterserapan_kerja.php' class='btn btn-primary'>ALUMNI BEKERJA</a>
                            <a href='keterserapan_belumkerja.php' class='btn btn-danger'>ALUMNI BELUM BEKERJA</a>
                            <a href='keterserapan_kerja_cetak.php?status_user=%27".KERJA."%27' target='_blank' class='btn btn-success'>CETAK DATA</a>
                            
                    
                            <br>
                        <br>
                        <div class='table-responsive-sm '>
                            <table class='table table-bordered table-dark'>
                           
                            <ul>
	
                            <tr>
                                <th>No.</th>
                                <th>No. KTP</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Status</th>
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
                                     <td>".$data['status_user']."</td>
                                    <td>
                                        <a href='siswa.php?detail=".$data['id']."' class='btn btn-warning'>Detail</a>
                                
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