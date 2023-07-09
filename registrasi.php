<?php 
session_start();

if( !isset($_SESSION['login'])){
	header("Location: login.php");
	exit;
} 
require 'functions.php';
if( isset($_POST['register'])){

	if( registrasi($_POST) > 0){

		echo "<script>
				alert('user baru berhasil ditambahkan!');
				</script>";
	} else {
		echo mysqli_error($conn);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Halaman Rgistrasi</title>
	<style type="text/css">
		label{
			display: block;
		}
	</style>
</head>
<body>
<div class="row justify-content-center">
<div class="bg-light mx-5 my-5 py-5 px-5" style="width: 40%; border-radius: 10px;">

<h1 style="text-align: center;">Halaman Registrasi</h1>
<div id="container">
<form action="" method="post">
	<div class="mb-3">
			<label class="form-label" for="username">Username :</label>
			<input class="form-control" type="text" name="username" id="username">
	  </div>
	  <div class="mb-3">
			<label for="password" class="form-label">Password :</label>
			<input class="form-control" type="password" name="password" id="password">
	  </div>
	  <div class="mb-3">
			<label for="password2" class="form-label">konfirmasi password :</label>
			<input class="form-control" type="password" name="password2" id="password2">
	  </div>
	  <div class="d-inline block mb-3">
			<button type="submit" name="login" class="btn btn-primary" >Register</button>
			<a href="registrasi.php" class="btn btn-dark">Login</a>
	  </div>
</form>	
</div>
</div>
</div>

</body>
</html>