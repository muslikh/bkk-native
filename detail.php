<?php
session_start();
if(empty($_SESSION)){
	header("Location: index.php");
}
include 'koneksi.php';


if (isset($_GET['id']))
 {


 }	

$file=mysqli_query($koneksi,"SELECT * FROM users ");

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
  <p style="color:white;">Bursa Kerja Khusus</p>
<a href="logout.php" class="btn btn-primary" onclick="return confirm('Yakin ingin Logout?')">Log out</a>

	
</nav>
<br>
<div class="container">


<span class=" text-center"><h5 ></h5></h5></span>
<br>
        <a href="home.php" class="btn btn-warning">Kembali</a>
        <a href="" class="btn btn-primary">Tambah Siswa</a>

        <br>
    <br>
	<div class="table-responsive-sm ">
        <table class="table table-bordered table-dark">
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
						<?php	
								
                                            
                            $i=1;
							if(mysqli_num_rows($file)>0){
								while($data = mysqli_fetch_assoc($file)){
                                    echo "<tr>
                                    <td>".$i++."</td>
                                    <td>".$data['nama']."</td>
                                    <td>".$data['email']."</td>
                                    <td>".$data['telepon']."</td>
                                    <td>
                                        <a href='detail.php' class='btn btn-warning'>Detail</a>
                                        <a href='hapus.php' class='btn btn-danger'>Hapus</a>
                                    </td>
                                    </tr>";
								}
							}	
						?>
        </table>
    </div>
</div>

</body>
</html>