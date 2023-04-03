<?php
$db_host = "localhost";
$db_user = "muslikhm_root";
$db_pass = "Muslikh32";
$db_name = "muslikhm_bkkcoba";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno()){
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
}
?>