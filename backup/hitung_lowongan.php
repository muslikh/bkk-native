<?php
include'koneksi2.php';
 
 $result=mysqli_query($koneksi,"SELECT count(*) as total from lowongan");
        $data=mysqli_fetch_assoc($result);
 echo $data['total'];

?>
