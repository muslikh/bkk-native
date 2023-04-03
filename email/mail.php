<?php
$email = $_POST['email'];
$nama = $_POST['nama'];
$pesan = $_POST['pesan'];
$subjek = $_POST['subjek'];


include "classes/class.phpmailer.php";
$mail = new PHPMailer; 
$mail->IsSMTP();
$mail->SMTPSecure = 'tls'; 
$mail->Host = "mail.muslikh.my.id"; //host masing2 provider email
$mail->SMTPDebug = 2;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "admin@muslikh.my.id"; //user email
$mail->Password = "Muslikh32"; //password email 
$mail->SetFrom("bkk@smknprigen.sch.id","Admin BKK"); //set email pengirim
$mail->Subject = $subjek; //subyek email
$mail->AddAddress($email,$nama );  //tujuan email
$mail->MsgHTML($pesan);
if($mail->Send()) echo "Message has been sent";
else echo "Failed to sending message";
?>
