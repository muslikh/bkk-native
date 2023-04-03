<?php
include'koneksi2.php';
 
$query = "select * from  (lowongan LEFT JOIN industri ON lowongan.id_industri = industri.id_industri) LEFT JOIN jurusan ON lowongan.id_jurusan = jurusan.id_jurusan";
$hasil  = mysqli_query($koneksi,$query);
 
 
if(mysqli_num_rows($hasil) > 0 ){
  $response = array();
  while($w = mysqli_fetch_array($hasil)){
  
    $m['id_lowongan'] = $w["id_lowongan"];
    $m['judul'] = $w["judul"];
    $m['deskripsi'] = $w["deskripsi"];
    $m['tutup'] = $w["tutup"];
    $m['kualifikasi'] = $w["kualifikasi"];
    $m['lain'] = $w["lain"];
    $m['created_at'] = $w["created_at"];
		 
	$m['nama'] = $w["nama"];
    $m['alamat'] = $w["alamat"];
    $m['gambar'] = $w["gambar"];
    
    $m['jurusan'] = $w["jurusan"];
 
     
    array_push($response, $m);
  }
  echo json_encode($response);
}else {
  $response["message"]="tidak ada data";
  echo json_encode($response);
}
?>
