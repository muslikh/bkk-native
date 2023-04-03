<?php
include'koneksi2.php';

$id = $_POST['id'];
$gambar = $_POST['gambar'];

$random = random_word(20);

        $path = "image".$random.".jpg";
        $actualpath = "http://muslikh.my.id/bkk/image/$path";
    
        $insert = "UPDATE users set gambar='$path' WHERE id=$id";
        
        
        $response = array();
		
                $save = mysqli_query($koneksi,$insert);
                if($save){
                   file_put_contents($path,base64_decode($gambar));
                   
                   $response['code'] =1;
                   $response['message'] = "Sukses ! Menyimpan Foto";
                }else{

                   $response['code'] =0;
                   $response['message'] = "Gagal ! Menyimpan Foto";
                 }
        
        function random_word($id = 20){
		$pool = '1234567890abcdefghijkmnpqrstuvwxyz';
		
		$word = '';
		for ($i = 0; $i < $id; $i++){
			$word .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
		}
		return $word; 
	}
	
     echo json_encode($response);
?>