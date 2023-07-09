<?php 
session_start();

if( !isset($_SESSION['login'])){
	header("Location: login.php");
	exit;
} 
require 'functions.php';

//ambil data di URL
$id = $_GET["id"];
// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id=$id")[0];

//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST['submit'])) {

	//cek apakah data berhasil diubah atau tidk
	if( ubah($_POST) > 0 ){
		echo "
			<script>
				alert('data berhasil diubah');
				document.location.href = 'index.php'
			</script>
		";
	} else {
		echo "data gagal diubah";
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<title>Ubah Data Mahasiswa</title>
</head>
<body>
<div class="mx-4 my-4">
	<figure class="text-center">
  	<blockquote class="blockquote">
	<h1>Ubah Data Mahasiswa</h1>
	</blockquote>
	</figure>

	<div class="row justify-content-center">
	<div class="bg-light mx-5 my-5 py-5 px-5" style="width: 50%; border-radius: 10px;">

	<div id="container">
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $mhs["id"]; ?>">
		<input type="hidden" name="gambarLama" value="<?php echo $mhs["gambar"]; ?>">
			<div class="mb-3">
				<label for="nim" class="form-label">NIM :</label>
				<input type="text"  class="form-control" name="nim" id="nim" required value="<?php echo $mhs["nim"] ?>">
	  		</div>
	  		<div class="mb-3">
				<label for="nama" class="form-label">Nama :</label>
				<input type="text"  class="form-control" name="nama" id="nama"
				required value="<?php echo $mhs["nama"] ?>">
	  		</div>
	  		<div class="mb-3">
				<label for="email" class="form-label">Email :</label>
				<input type="text"  class="form-control" name="email" id="email"value="<?php echo $mhs["email"] ?>">
	  		</div>
	  		<div class="mb-3">
				<label for="jurusan" class="form-label">Jurusan :</label>
				<input type="text"  class="form-control" name="jurusan" id="jurusan"
				required value="<?php echo $mhs["jurusan"] ?>">
	  		</div>
	  		<div class="mb-3">
				<label for="gambar" class="form-label">Gambar :</label>
				<img src="img/<?php echo $mhs['gambar']; ?>" width="40"><br>
				<input type="file"  class="form-control" name="gambar" id="gambar" >
	  		</div>
	  		<div class="d-inline block mb-3">
				<button type="submit" class="btn btn-primary" name="submit">ubah data</button>
				<a href="index.php" class="btn btn-dark">Kembali</a>
	  		</div>	
	  </form>
   	</div>
  	</div>
  	</div>

</div>
</body>
</html>