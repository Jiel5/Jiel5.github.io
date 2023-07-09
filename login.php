<?php  
session_start();
require 'functions.php';

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key'])){
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	//ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	//cek cookie dan username
	if( $key === hash('sha256', $row['username'])){
		$_SESSION['login'] = true;
	}
}

if( isset($_SESSION['login'])){
	header("Location: index.php");
	exit;
}


if( isset($_POST['login'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];

	$result = mysqli_query($conn, "SELECT * FROM users WHERE username ='$username'");

		//cek username
		if( mysqli_num_rows($result) === 1 ){

		//cek password
		$row = mysqli_fetch_assoc($result);
		if(password_verify($password, $row["password"])) {

			// set session
			$_SESSION['login'] = true;

			//cek remember me
			if(isset($_POST['remember'])){
				//buat cookie

				setcookie('id', $row['id'], time()+60);
				setcookie('key', hash('sha256', $row['username']), time()+60);
			}

			header("Location: index.php");
			exit;
		}
	}

	$error = true;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Halaman Login</title>
</head>
<body>
<div class="row justify-content-center">
<div class="bg-light mx-5 my-5 py-5 px-5" style="width: 40%; border-radius: 10px;">

<h1 style="text-align: center;">Halaman Login</h1>

<?php if( isset($error)) : ?>
	<p style="color: red; font-style: italic;">username / password salah</p>
<?php endif; ?>

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
	  	    <input class="form-check-input" type="checkbox" name="remember" id="remember">
        	<label class="form-check-label" for="remember">
			Remember me
			</label>
	  </div>
	  <div class="d-inline block mb-3">
			<button type="submit" name="login" class="btn btn-primary" >Login</button>
			<!-- <a href="registrasi.php" class="btn btn-dark">Registrasi</a> -->
	  </div>

</form>	
</div>
</div>
</div>

</body>
</html>