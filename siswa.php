<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
if(empty($_SESSION)){
	header("Location: index.php");
}
include 'koneksi.php';

$file=mysqli_query($koneksi,"SELECT * FROM users where role_id=2");

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
                                    <a href='siswa.php' class='btn btn-warning'>Kembali</a>
                                     <a href='cv_cetak.php?id=".$data['id']."' target='_blank' class='btn btn-success'>Lihat CV</a>
                                    <a href='siswa.php?edit=".$data['id']."' class='btn btn-primary'>Ubah Data</a>
                            
                                    <br>
                                <br>
                                <div class='table-responsive-sm '>
                                    <table class='table table-bordered table-dark'>
                                  
                                    <tr><td colspan='3'>Detail Data Alumni</td></tr>
                                    <tr><td>"."<img src='image/$data[gambar]' width='150' height='150' />"."</td></tr>
                                      <tr><td>No. KTP</td> <td> : </td> <td>".$data['username']."</td></tr>
                                    <tr><td>Nama</td> <td> : </td> <td>".$data['nama']."</td></tr>
                                     <tr><td>Tempat Lahir</td> <td> : </td> <td>".$data['tempat_lahir']."</td></tr>
                                    <tr><td>Tanggal Lahir</td> <td> : </td> <td>".$data['tgl_lahir']."</td></tr>
                                    <tr><td>Jenis Kelamin</td> <td> : </td> <td>".$data['jenis_kelamin']."</td></tr>
                                    <tr><td>Telepon</td> <td> : </td> <td>".$data['telepon']."</td></tr>
                                    <tr><td>Email</td> <td> : </td> <td>".$data['email']."</td></tr>
                                    <tr><td>Alamat</td> <td> : </td> <td>".$data['alamat']."</td></tr>
                                     <tr><td>Jurusan</td> <td> : </td> <td>".$data['jurusan']."</td></tr>
                                    <tr><td>Tahun Lulus</td> <td> : </td> <td>".$data['tahun_lulus']."</td></tr>
                                    <tr><td>Status</td> <td> : </td> <td>".$data['status_user']."</td></tr>
                                    <tr><td>Keahlian</td> <td> : </td> <td>".$data['keahlian']."</td></tr>
                                    <tr><td>Tinggi badan</td> <td> : </td> <td>".$data['tinggi']." cm</td></tr>
                                    <tr><td>Berat Badan</td> <td> : </td> <td>".$data['berat']." kg</td></tr>
                                    
                                    ";
								}
                            }
                        

                        }elseif (isset($_GET["edit"]))
                        {
                            
                            $pesan = $_GET["pesan"];
                            
							$id = $_GET["edit"];
                            $detail=mysqli_query($koneksi,"SELECT * FROM users, jurusan where id=$id AND users.id_jurusan=jurusan.id_jurusan");
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
                                    
                                    <a href='siswa.php?detail=".$data['id']."' class='btn btn-warning'>Kembali</a>
                                <br>
                                <br>
                                <div class='table-responsive-sm '>
                                    <table class='table table-bordered table-dark'>
                                    <form action='siswa.php?pupdate' method='POST'>
                                    <tr><td colspan='3'>Ubah Data Alumni</td></tr>
                                    <input type='hidden' id='id' name='id' value='".$data['id']."'>
                                    <tr><td>No. KTP</td> <td> : </td>
                                     <td>
                                     <input name='username' id='username' type='text' class='form-control' value='".$data['username']."'>
                                    <tr><td>Nama</td> <td> : </td>
                                     <td>
                                     <input name='nama' id='nama' type='text' class='form-control' value='".$data['nama']."'>
                                     </td></tr>
                                      <tr><td>Tempat Lahir</td> <td> : </td> <td><input name='tempat_lahir' id='tempat_lahir' type='text' class='form-control' value='".$data['tempat_lahir']."'></td></tr>
                                   
                                     <tr><td>Tanggal Lahir</td> <td> : </td> <td>".$data['tgl_lahir']."<br><input name='tgl_lahir' id='tgl_lahir'  type='date'('d-m-Y') class='date form-control'></td></tr>
                                     
                                     <tr><td>Jenis Kelamin</td><td> : </td><td>
                                     ".$data['jenis_kelamin']." |
                                    <input type='radio' name='jk' id='jk' value='Laki - Laki'>Laki - Laki
                                    <input type='radio' name='jk' id='jk' value='Perempuan'>Perempuan
                                    </td></tr>
                                    
                                    <tr><td>Telepon</td> <td> : </td> <td><input name='telepon' id='telepon' type='text' class='form-control' value='".$data['telepon']."'></td></tr>
                                    <tr><td>Email</td> <td> : </td> <td><input name='email' id='email' type='email' class='form-control' value='".$data['email']."'></td></tr>
                                    <tr><td>Alamat</td> <td> : </td> <td><input name='alamat' id='alamat' type='text' class='form-control' value='".$data['alamat']."'></td></tr>
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
                                    <tr><td>Tahun Lulus</td> <td> : </td> <td><input  name='tahun_lulus' id='tahun_lulus' type='text' class='form-control' value='".$data['tahun_lulus']."'></td></tr>
                                    <tr><td>Keahlian</td> <td> : </td> <td><input  name='keahlian' id='keahlian' type='text' class='form-control' value='".$data['keahlian']."'></td></tr>
                                    <tr><td>Tinggi badan ( cm ) </td> <td> : </td> <td><input name='tinggi' id='tinggi' type='number' class='form-control' value='".$data['tinggi']."'></td></tr>
                                    <tr><td>Berat Badan ( kg ) </td> <td> : </td> <td><input name='berat' id='berat' type='number' class='form-control' value='".$data['berat']."'></td></tr>
                                    <tr><td>Password</td> <td> : </td> <td><input  name='password' id='password' type='text' class='form-control' value='".$data['password']."'></td></tr>
                                    <tr><td><input type='submit' value='Simpan' class='btn btn-primary'></input></td></tr>
                                    </form>
                                    ";
								}
                            }
                        

                        }elseif (isset($_GET["pupdate"]))
                        {

							$id = $_POST["id"];
							$id_jurusan = $_POST["id_jurusan"];
							$username = $_POST["username"];
							$nama = $_POST["nama"];
							$alamat = $_POST["alamat"];
							$tempat_lahir = $_POST["tempat_lahir"];
							$jk = $_POST["jk"];
							$tgl = $_POST["tgl_lahir"];
							$telepon = $_POST["telepon"];
							$email = $_POST["email"];
							$tahun_lulus = $_POST["tahun_lulus"];
							$keahlian = $_POST["keahlian"];
							$tinggi = $_POST["tinggi"];
                            $berat = $_POST["berat"];
                            $password = $_POST["password"];
                            $result=explode('-',$tgl);
                            $date=$result[2];
                            $month=$result[1];
                            $year=$result[0];
                            
                            //lapo di echo di ilangi ae
                            $new=$date.'-'.$month.'-'.$year;
                            
                            $data = mysqli_query($koneksi,"UPDATE users SET username='$username',nama='$nama',id_jurusan='$id_jurusan', alamat='$alamat', tempat_lahir='$tempat_lahir',tgl_lahir='$new', jenis_kelamin='$jk',telepon='$telepon', email='$email' , tahun_lulus='$tahun_lulus', keahlian='$keahlian',tinggi='$tinggi', berat='$berat',password='$password'  where id=$id ");

                            if($data)
                            {
                                header('location:siswa.php?edit='.$id.'&pesan=sukses');
                                
                                 echo "<meta http-equiv='refresh' content='0;siswa.php?detail=$id'>";
                            }else
                            {
                                header('location:siswa.php?edit='.$id.'&pesan=gagal');
                            }

                            
                        }elseif (isset($_GET["tambah"]))
                        {
                            
                            $pesan = $_GET["pesan"];
							$id = $_GET["tambah"];
                            
                            $detail=mysqli_query($koneksi,"SELECT * FROM users where id=$id");
                                    if($pesan == 'sukses'){
                                        echo "
                                    <center><span class='alert alert-success'>Tambah Data Berhasil</span></center> ";
                                    }elseif($pesan == 'gagal')
                                    {
                                        echo " <center><span class='alert alert-danger'>Tambah Data Gagal</span></center>";
                                    }
                                    echo "
                                    
                                    <a href='siswa.php' class='btn btn-warning'>Kembali</a>
                                  
                                    <br>
                                <br>
                                <div class='table-responsive-sm '>
                                    <table class='table table-bordered table-dark'>
                                    <form action='siswa.php?ptambah' method='POST'>
                                    <tr><td colspan='3'>Tambah Data Alumni</td></tr>
                                    <tr><td>No. KTP</td> <td> : </td> <td><input name='username' id='username' type='number' class='form-control' ></td></tr>
                                    <tr><td>Nama</td> <td> : </td> <td><input name='nama' id='nama' type='text' class='form-control' ></td></tr>
                                     <tr><td>Tempat Lahir</td> <td> : </td> <td><input name='tempat_lahir' id='tempat_lahir' type='text' class='form-control' ></td></tr>
                                    <tr><td>Tanggal Lahir</td> <td> : </td> <td><input name='tgl_lahir' id='tgl_lahir'  type='date'('d-m-Y') class='date form-control'></td></tr>
                                    
                                     <tr><td>Jenis Kelamin</td><td> : </td><td>
                                    <input type='radio' name='jenis_kelamin' id='jenis_kelamin' value='Laki - Laki'>Laki - Laki
                                    <input type='radio' name='jenis_kelamin' id='jenis_kelamin' value='Perempuan'>Perempuan
                                    </td></tr>
                    
                                    <tr><td>Telepon</td> <td> : </td> <td><input name='telepon' id='telepon' type='text' class='form-control' ></td></tr>
                                    <tr><td>Email</td> <td> : </td> <td><input name='email' id='email' type='email' class='form-control' ></td></tr>
                                    <tr><td>Alamat</td> <td> : </td> <td><input name='alamat' id='alamat' type='text' class='form-control' ></td></tr>
                                    
                                    <tr><td>Jurusan</td> <td> : </td> <td>
							        <select name='id_jurusan' id='id_jurusan 'class='form-control' >
                                    <option value='1'>AKUNTANSI</option>
                                    <option value='2'>MULTIMEDIA</option>
                                    <option value='3'>PERHOTELAN</option>
                                    <option value='4'>TEKNIK KOMPUTER DAN JARINGAN</option>
                                    <option value='5'>TATA BOGA</option>
                                    <option value='6'>TEKNIK SEPEDA MOTOR</option>
                                    </select>
											
                                   </td></tr>
                                   
                                    <tr><td>Tahun Lulus</td> <td> : </td> <td><input name='tahun_lulus' id='tahun_lulus' type='text' class='form-control' ></td></tr>
                                    <tr><td>Keahlian</td> <td> : </td> <td><input name='keahlian' id='keahlian' type='text' class='form-control' ></td></tr>
                                    <tr><td>Tinggi badan</td> <td> : </td> <td><input name='tinggi' id='tinggi' type='number' class='form-control' ></td></tr>
                                    <tr><td>Berat Badan</td> <td> : </td> <td><input name='berat' id='berat' type='number' class='form-control' ></td></tr>
                                    <tr><td>Password</td> <td> : </td> <td><input name='password' id='password' type='text' class='form-control' ></td></tr>
                                    
                                    <tr><td><input type='submit' class='btn btn-primary' value='Simpan'></td></tr>
                                    </form>
                                    ";
								
                            
                        

                        }elseif (isset($_GET["ptambah"]))
                        {

							$id = $_POST["id"];
							$id_jurusan = $_POST["id_jurusan"];
							$role_id = $_POST["role_id"];
							$username = $_POST["username"];
							$nama = $_POST["nama"];
							$telepon = $_POST["telepon"];
							$email = $_POST["email"];
							$tempat_lahir = $_POST["tempat_lahir"];
							$tgl = $_POST["tgl_lahir"];
							$jenis_kelamin = $_POST["jenis_kelamin"];
							$tahun_lulus = $_POST["tahun_lulus"];
							$alamat = $_POST["alamat"];
							$keahlian = $_POST["keahlian"];
							$tinggi = $_POST["tinggi"];
                            $berat = $_POST["berat"];
                            $gambar = $_POST["gambar"];
                            $password = $_POST["password"];
                            $role_id = '2';
                            $gambar = 'user.jpg';
                            $result=explode('-',$tgl);
                            $date=$result[2];
                            $month=$result[1];
                            $year=$result[0];
                            
                            //lapo di echo di ilangi ae
                            $new=$date.'-'.$month.'-'.$year;
                            
                         
                            $data = mysqli_query($koneksi,"INSERT into users ( id_jurusan,role_id,username,nama,telepon,email,tempat_lahir,tgl_lahir,jenis_kelamin,tahun_lulus,alamat,keahlian,tinggi, berat,gambar,password )
                            VALUES ('$id_jurusan','$role_id','$username','$nama','$telepon','$email','$tempat_lahir','$new','$jenis_kelamin','$tahun_lulus','$alamat','$keahlian','$tinggi','$berat','$gambar','$password') ");

                            if($data)
                            {
                                header('location:siswa.php?tambah&pesan=sukses');
                                
                                echo "<meta http-equiv='refresh' content='0;siswa.php?'>";
                            }else
                            {
                                header('location:siswa.php?tambah&pesan=gagal');
                            }

                            
                        }elseif (isset($_GET["hapus"]))
                        {
                            
							$id = $_GET["hapus"];
                            
                            $data = mysqli_query($koneksi,"DELETE FROM users where id=$id");
                            
                            if($data)
                            {
                                header('location:siswa.php?pesan=sukses');
                                
                                 echo "<meta http-equiv='refresh' content='0;siswa.php?'>";
                            }else
                            {
                                header('location:siswa.php?pesan=gagal');
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
                              <a href='validasi_siswa.php' class='btn btn-primary'>Validasi Alumni</a>
                               <a href='keterserapan_kerja.php?tambah' class='btn btn-success'>Keterserapan Kerja</a>
                            <a href='siswa.php?tambah' class='btn btn-primary'>Tambah Data</a>
                    
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
                                        <a href='siswa.php?detail=".$data['id']."' class='btn btn-warning'>Detail</a>
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

<script type="text/javascript">
    // $('.date').datepicker({
    //   format: 'dd-mm-yyyy'
    //  });
    	$(function(){
		$("#tgl_lahir").datepicker({
			autoclose: true,
			todayHighlight: true,
			dateFormat: 'dd/mm/yyyy'
		}).datepicker('update', new Date());
	});
</script>

</body>
</html>