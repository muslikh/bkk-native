<?php
session_start();
if(empty($_SESSION)){
	header("Location: index.php");
}
include 'koneksi.php';

$data_alumni = mysqli_query($koneksi,"SELECT * FROM users where role_id=2");
$jumlah_alumni = mysqli_num_rows($data_alumni);

$data_industri = mysqli_query($koneksi,"SELECT * FROM industri");
$jumlah_industri = mysqli_num_rows($data_industri);

$data_lowongan = mysqli_query($koneksi,"SELECT * FROM lowongan");
$jumlah_lowongan = mysqli_num_rows($data_lowongan);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Bursa Kerja Khusus | SMK NEGERI 1 PRIGEN</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<!--[if lt IE 9]>-->
	<!-- <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> -->
	<!--<![endif]-->
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <p style ="color:white;">Bursa Kerja Khusus</p>
<a href="logout.php" class="btn btn-primary" onclick="return confirm('Yakin ingin Logout?')">Log out</a>

	
</nav>
<br>
<div class="container text-center">


<br>

				<div class='table-responsive-sm '>
                    <table class='table table-dark text-center'>
						<tr><td colspan='6'> 
							<h5>Selamat Datang di Halaman Admin</h5> 
						</td></tr>				
						<tr>
							<td></td>
								<td></td>
									<td></td>
							<td>
							
								<div class="card" style="width: 10rem;">
								<img class="card-img-top" src="http://muslikh.my.id/bkk/image/user.jpg" alt="Card image cap">
								
								<font face="Century Gothic"font size=”3" color=”#000000″><b><?php echo $jumlah_alumni; ?> Data</b></font>
								
									<a href="siswa.php" class="btn btn-primary">Manajemen<br>Alumni</a>
								</div>
							</td>
							<td>
								<div class="card" style="width: 10rem;">
								<img class="card-img-top" src="http://muslikh.my.id/bkk/image/industri.jpg" alt="Card image cap">
								
								 <font face="Century Gothic"font size=”3" color=”#000000″><b><?php echo $jumlah_industri; ?> Data</b></font>
								 
									<a href="perusahaan.php" class="btn btn-primary">Manajemen Industri</a>
								</div>
							</td>
							<td>
								<div class="card" style="width: 10rem;">
								<img class="card-img-top" src="http://muslikh.my.id/bkk/image/lowongan.jpg" alt="Card image cap">
								
								<font face="Century Gothic"font size=”3" color=”#000000″><b><?php echo $jumlah_lowongan; ?> Data</b></font>
								
									<a href="lowongan.php" class="btn btn-primary">Manajemen Lowongan</a>
								</div>
							</td>
						</tr>
					</table>
				</div>



</div>


</body>
</html>