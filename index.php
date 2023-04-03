<?php
session_start();
if($_SESSION){
	header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SMK NEGERI 1 PRIGEN</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<!-- Bootstrap -->
	<!--<link href="css/bootstrap.min.css" rel="stylesheet" >-->
	<style>
		body {
			background-color:#eee;
		}
		.row {
			margin:100px auto;
			width:350px;
			text-align:center;
		}
		.login {
			background-color:#fff;
			padding-top:35px;
			padding-right:50px;
			padding-left:50px;
			padding-bottom:35px;
			margin-top:20px
		}
	</style>
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
    
   
    <nav class="navbar navbar-dark bg-dark">
  <p style ="color:white;">Bursa Kerja Khusus</p>
  
  </nav>
	
	<div class="container text-center">
	     
		<div class="row">
		   
		     <p style ="color:#eee;">--------------.</p>
			<h2>Log In</h2>
			<div class="login">
				
				<?php
				if(isset($_POST['login'])){
					include("koneksi.php");
					
					$username	= $_POST['username'];
					$password	=  $_POST['password'];
					// $level		= $_POST['level'];
					
					$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
					if(mysqli_num_rows($query) == 0){
						echo '<div class="alert alert-danger">Upss...!!! Login gagal.</div>';
					}else{
						$row = mysqli_fetch_assoc($query);
						
						if($row['role_id'] == 1){
							$_SESSION['username']=$username;
							header("Location: home.php");
						}else{
							echo '<div class="alert alert-danger">Upss...!!! Tidak punya akses.</div>';
						
						} 
						
					}
				}
				?>
				<form role="form" action="" method="post">
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Username" required autofocus />
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" required autofocus />
					</div>
					<div class="form-group">
						<input type="submit" name="login" class="btn btn-primary btn-block" value="Log in" />
					</div>
				</form>
			</div>
			Copyright &copy; 2020 SMK NEGERI 1 PRIGEN
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>