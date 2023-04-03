<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
if(empty($_SESSION)){
	header("Location: index.php");
}
include 'koneksi.php';

$file=mysqli_query($koneksi,"SELECT * FROM industri ");

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
                            $lowongan = mysqli_query($koneksi,"SELECT * FROM lowongan where id_industri=$id ");
                            
                            $detail=mysqli_query($koneksi,"SELECT * FROM  industri where id_industri=$id");
                            if(mysqli_num_rows($detail)>0){
								while($data = mysqli_fetch_assoc($detail)){
                                    echo "
                                    <a href='perusahaan.php' class='btn btn-warning'>Kembali</a>
                                    <a href='perusahaan.php?edit=".$data['id_industri']."' class='btn btn-primary'>Ubah Data</a>
                                    <a href='perusahaan.php?lowongan=".$data['id_industri']."' class='btn btn-info'>Tambah Lowongan</a>
                            
                                    <br>
                                <br>
                                <div class='table-responsive-sm '>
                                    <table class='table table-bordered table-dark'>
                                  
                                    <tr><td colspan='6'>Detail Data Industri</td></tr>
                                    <tr><td>"."<img src='image/$data[gambar]' width='150' height='150' />"."</td></tr>
                                    <tr><td>Nama Industri</td> <td> : </td> <td colspan='4'>".$data['nama']."</td></tr>
                                     <tr><td>Alamat</td> <td> : </td> <td colspan='4'>".$data['alamat']."</td></tr>
                                    <tr><td>Telepon</td> <td> : </td> <td colspan='4'>".$data['telepon']."</td></tr>
                                    <tr><td>Email</td> <td> : </td> <td colspan='4'>".$data['email']."</td></tr>
                                    <tr><td>Website</td> <td> : </td> <td colspan='4'>".$data['website']."</td></tr>
                                    ";
								}
                            }
                            echo "
                            <tr><td colspan='6'></td></td></tr>
                            <tr><td colspan='6' class='text-center'> Daftar Lowongan</td></tr>
                            
                            <tr>
                            <td>No.</td> <td>Judul Lowongan</td> 
                             <td>Tanggal Dibuka</td>
                            <td>Tanggal Berakhir</td>
                            <td>Aksi</td>
                        </tr>
                            
                            ";
                            $i=1;
                            if(mysqli_num_rows($lowongan)>0){
								while($dl = mysqli_fetch_assoc($lowongan)){
                                    echo "
                                    <tr>
                                        <td>".$i++."</td>
                                        <td>".$dl['judul']."</td>
                                        <td>".$dl['buka']."</td>
                                        <td>".$dl['tutup']."</td>
                                       
                                        <td>
                                        <a href='lowongan.php?dtlowongan=".$dl['id_lowongan']."' class='btn btn-warning'>Detail</a>
                                        <a href='lowongan.php?hpslowongan=".$dl['id_lowongan']."' class='btn btn-danger'>Hapus</a>

                                        </td>
                                    </tr>
                                ";

                                }
                            }else{
                                echo "<tr><td colspan='6' class='text-center'>Belum Ada Lowongan</td></tr>";
                            }
                                    

                        }elseif (isset($_GET["edit"]))
                        {
                            
                            $pesan = $_GET["pesan"];
                            
							$id = $_GET["edit"];
                            $detail=mysqli_query($koneksi,"SELECT * FROM industri where id_industri=$id");
                            if(mysqli_num_rows($detail)>0){
								while($data = mysqli_fetch_assoc($detail)){
                                    if($pesan == 'sukses'){
                                        echo "
                                       <center><span class='alert alert-success'>Update Data Berhasil</span></center> ";
                                    }elseif($pesan == 'gagal')
                                    {
                                        echo "<span class='alert alert-danger'>Update Data Berhasil</span>";
                                    }
                                    echo "
                                    
                                    <a href='perusahaan.php?detail=".$data['id_industri']."' class='btn btn-warning'>Kembali</a>
                                <br>
                                <br>
                                <div class='table-responsive-sm '>
                                    <table class='table table-bordered table-dark'>
                                    <form action='perusahaan.php?pupdate' method='POST' enctype='multipart/form-data'>
                                    <tr><td colspan='3'>Ubah Data Industri</td></tr>
                                     <input type='hidden' id='id_industri' name='id_industri' value='".$data['id_industri']."'>
                                    <tr><td>Nama</td> <td> : </td>
                                     <td><input name='nama' id='nama' type='text' class='form-control' value='".$data['nama']."'>
                                     </td></tr>
                                     <tr><td>Alamat</td> <td> : </td> <td><input name='alamat' id='alamat' type='text' class='form-control' value='".$data['alamat']."'></td></tr>
                                    <tr><td>Telepon</td> <td> : </td> <td><input name='telepon' id='telepon' type='text' class='form-control' value='".$data['telepon']."'></td></tr>
                                    <tr><td>Email</td> <td> : </td> <td><input name='email' id='email' type='email' class='form-control' value='".$data['email']."'></td></tr>
                                    <tr><td>Website</td> <td> : </td> <td><input  name='website' id='website' type='text' class='form-control' value='".$data['website']."'></td></tr>
                                    <tr><td><input type='submit' value='Simpan' class='btn btn-primary'></input></td></tr>
                                    </form>
                                    ";
								}
                            }
                        

                        }elseif (isset($_GET["pupdate"]))
                        {

							$id = $_POST["id_industri"];
							$nama = $_POST["nama"];
							$alamat = $_POST["alamat"];
							$telepon = $_POST["telepon"];
							$email = $_POST["email"];
							$website = $_POST["website"];
					
                            $data = mysqli_query($koneksi,"UPDATE industri SET nama='$nama', alamat='$alamat',
                            telepon='$telepon', email='$email' , website='$website' where id_industri=$id ");

                            if($data)
                            {
                                header('location:perusahaan.php?edit='.$id.'&pesan=sukses');
                               
                           echo "<meta http-equiv='refresh' content='0;perusahaan.php?detail=$id'>";
                           
                            }else
                            {
                                header('location:perusahaan.php?edit='.$id.'&pesan=gagal');
                            }

                            
                        }elseif (isset($_GET["tambah"]))
                        {
                            
                            $pesan = $_GET["pesan"];
							$id = $_GET["tambah"];
							
                            $detail=mysqli_query($koneksi,"SELECT * FROM industri where id_industri=$id");
                                    if($pesan == 'sukses'){
                                        echo "
                                    <center><span class='alert alert-success'>Tambah Data Berhasil</span></center> ";
                                    }elseif($pesan == 'gagal')
                                    {
                                        echo " <center><span class='alert alert-danger'>Tambah Data Gagal</span></center>";
                                    }
                                    echo "
                                    
                                    <a href='perusahaan.php' class='btn btn-warning'>Kembali</a>
                                  
                                    <br>
                                <br>
                                <div class='table-responsive-sm '>
                                    <table class='table table-bordered table-dark'>
                                    <form action='perusahaan.php?ptambah' method='POST' enctype='multipart/form-data'>
                                    <tr><td colspan='3'>Tambah Data Industri</td></tr>
                                    
                                    
                                    
                                    
                                    <tr><td>Foto</td> <td> : </td> <td> <input type='file' name='gambar' id='gambar'></td></tr>
                                    
                                    
                                    
                                    
                                    <tr><td>Nama</td> <td> : </td> <td><input name='nama' id='nama' type='text' class='form-control' ></td></tr>
                                    <tr><td>Alamat</td> <td> : </td> <td><input name='alamat' id='alamat' type='text' class='form-control' ></td></tr>
                                   <tr><td>Telepon</td> <td> : </td> <td><input name='telepon' id='telepon' type='text' class='form-control' ></td></tr>
                                    <tr><td>Email</td> <td> : </td> <td><input name='email' id='email' type='email' class='form-control' ></td></tr>
                                    <tr><td>Website</td> <td> : </td> <td><input name='website' id='website' type='text' class='form-control' ></td></tr>
                                    <tr><td><input type='submit' class='btn btn-primary' value='Simpan'> </td></tr>
                                    </form>
                                    ";
								
                            
                        

                        }elseif (isset($_GET["ptambah"]))
                        {

							$id = $_POST["id_industri"];
							$nama = $_POST["nama"];
							$alamat = $_POST["alamat"];
							$telepon = $_POST["telepon"];
							$email = $_POST["email"];
							$website = $_POST["website"];
							$gambar = $_POST["gambar"];
							
						    $name=$_FILES['gambar']['name'];
						    $folder      = 'image/'.$name; 
					        $tmp = $_FILES['gambar']['tmp_name'];
						 
                            $data = mysqli_query($koneksi,"INSERT into industri ( nama,alamat,telepon,email,website,gambar)
                            VALUES ('$nama','$alamat','$telepon','$email','$website','$name') ");

                            if($data)
                            {
                                move_uploaded_file($tmp, $folder); 
                                
                                header('location:perusahaan.php?tambah=&pesan=sukses');
                             
                             echo "<meta http-equiv='refresh' content='0;perusahaan.php?'>";
                            
                            }else
                            {
                                header('location:perusahaan.php?tambah&pesan=gagal');
                            }

                            
                        }elseif (isset($_GET["hapus"]))
                        {
                            
							$id = $_GET["hapus"];
                            
                            $data=mysqli_query($koneksi,"DELETE FROM industri where id_industri=$id");
                            
                            if($data)
                            {
                                header('location:perusahaan.php?pesan=sukses');
                                
                                echo "<meta http-equiv='refresh' content='0;perusahaan.php?'>";
                            }else
                            {
                                header('location:perusahaan.php?pesan=gagal');
                            }
                        
                            
                        }elseif (isset($_GET["lowongan"]))
                        {
                            
                            $pesan = $_GET["pesan"];
							$id = $_GET["lowongan"];
                            
                            $detail=mysqli_query($koneksi,"SELECT * FROM lowongan where id_industri=$id");
                                    if($pesan == 'sukses'){
                                        echo "
                                    <center><span class='alert alert-success'>Tambah Data Berhasil</span></center> ";
                                    }elseif($pesan == 'gagal')
                                    {
                                        echo " <center><span class='alert alert-danger'>Tambah Data Gagal</span></center>";
                                    }
                                    echo "
                                    
                                    <a href='perusahaan.php?detail=".$id."'class='btn btn-warning'>Kembali</a>
                                    <br>
                                     <br>
                                <div class='table-responsive-sm '>
                                    <table class='table table-bordered table-dark'>
                                    <form action='perusahaan.php?plowongan' method='POST'>
                                    <tr><td colspan='3'>Tambah Data</td></tr><input name='id_industri' value=".$id." id='id_industri' type='hidden' class='form-control' >
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
                                    <tr><td>Kualifikasi</td> <td> : </td> <td><input name='kualifikasi' id='kualifikasi' type='text' class='form-control' ></td></tr>
                                    <tr><td>Lain - Lain </td> <td> : </td> <td><input name='lain' id='lain' type='text' class='form-control' ></td></tr>
                                    <tr><td><input type='submit' class='btn btn-primary' value='Simpan'> </td></tr>
                                    </form>
                                    ";
								
                            
                        

                        }elseif (isset($_GET["plowongan"]))
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
                                header('location:perusahaan.php?lowongan='.$id_industri.'&pesan=sukses');
                                
                                echo "<meta http-equiv='refresh' content='0;perusahaan.php?detail=$id'>";
                            }else
                            {
                                header('location:perusahaan.php?lowongan='.$id_industri.'&pesan=gagal');
                            }

                            
                        }else{
                            $pesan = $_GET['pesan'];
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
                            <a href='perusahaan.php?tambah' class='btn btn-primary'>Tambah Data</a>
                    
                            <br>
                        <br>
                        <div class='table-responsive-sm '>
                            <table class='table table-bordered table-dark'>
                            
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
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
                                    <td>"."<img src='image/$data[gambar]' width='50' height='50' />"."</td>
                                    <td>".$data['nama']."</td>
                                    <td>".$data['email']."</td>
                                    <td>".$data['telepon']."</td>
                                    <td>
                                        <a href='perusahaan.php?detail=".$data['id_industri']."' class='btn btn-warning'>Detail</a>
                                        <a href='perusahaan.php?hapus=".$data['id_industri']."' class='btn btn-danger'>Hapus</a>
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