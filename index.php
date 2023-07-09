<?php
session_start();

if( !isset($_SESSION['login'])){
	header("Location: login.php");
	exit;
} 

//menghubungkan halaman ini dan halaman functions
require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

//tombol cari ditekan
if (isset($_POST["cari"]) ) {
	$mahasiswa = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	  <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>

	<title>Halaman Admin</title>
	<style type="text/css">
		.form-cari{
			margin: 0 auto;
		}
		.loader{
			width: 170px;
			position: absolute;
			top: 200px;
			left: 410px;
			z-index: -1;
			display: none;

		}
		@media print {
			.logout, .tambah, .form-cari, .aksi{
				display: none;
			}
		}
	</style>
	<script src="js/jquery-3.6.3.min.js"></script>
	<script src="js/script.js"></script>
</head>

<body>
<div class="mx-4 my-4">

<div class="d-inline block col-md-4 ms-5">
	<div class="btn btn-dark" style="max-width: 18rem;">
	<a href="logout.php" class="logout" style="color: white; text-decoration: none;">Logout</a>
	</div>

	<div class="btn btn-light btn-lg" tabindex="-1" role="button" style="outline-style: solid; outline-width: 1.5px; margin: 10px; padding: 1px 10px 2px 7px; border-radius: 4px;">
	<a href="cetak.php" target="_blank" style="color: black;  font-size: 19px; text-decoration: none;"><span class="fa fa-print fa-1x col-md-4 my-1 mx-1" style="width: 20px;"></span>Cetak</a>
	</div>
</div>

<figure class="text-center">
  <blockquote class="blockquote">
	<h1>Daftar Mahasiswa</h1>
	<p>Aplikasi sederhana untuk Pendataan Mahasiswa</p>
  </blockquote>
</figure>


<div class="row justify-content-center">
	<span class="col-md-3 mt-5 ms-0">

		<form action="" method="post" class="form-cari">
		<input type="text" name="keyword" size="50" class="form-control form-control-lg" placeholder="masukkan keyword pencarian.." autocomplete="off" id="keyword">
		<!-- <button type="submit" name="cari" id="tombol-cari">cari!</button> -->
		<img src="img/Loading_icon.gif" class="loader">
		</form>

	</span>
	<span class="fa fa-search fa-3x col-md-4 my-5 p-0" style="width: 20px;"></span>
</div>

<div class="d-inline block col-md-4 ms-5 mb-0 mt-5">
<div class="btn btn-info" style="max-width: 18rem;">
<a href="tambah.php" class="tambah" style="color: white; text-decoration: none;">Tambah data mahasiswa</a>
</div>

<div class="bg-light mx-5 my-5">

<div id="container">
<div class="table-responsive">
<table class="table table-striped">
	<tr>
		<th>No.</th>
		<th class="aksi">Aksi</th>
		<th>Gambar</th>
		<th>Nim</th>
		<th>Nama</th>
		<th>Email</th>
		<th>Jurusan</th>
	</tr>
	<?php $i = 1; ?>
	<?php foreach( $mahasiswa as $row ) :?>
	<tr>
		<td><?php echo $i ?></td>
		<td class="aksi">
			<div class="btn btn-warning" style="max-width: 18rem;">
			<a href="ubah.php?id=<?php echo $row["id"]; ?>" style="color: white; text-decoration: none;">ubah</a>
			</div>
			<div class="btn btn-secondary" style="max-width: 18rem;">
			<a href="hapus.php?id=<?php echo $row["id"]; ?>" style="color: white; text-decoration: none;" onclick="return confirm('yakin?');">hapus</a>
		</div>
		</td>
		<td><img src="img/<?php echo $row["gambar"] ?>" width="50"></td>
		<td><?php echo $row["nim"] ?></td>
		<td><?php echo $row["nama"] ?></td>
		<td><?php echo $row["email"] ?></td>
		<td><?php echo $row["jurusan"] ?></td>

	</tr>
	<?php $i++; ?>
<?php endforeach; ?>
</div>	
</table>
</div>
</div>
</div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/206142bfe3.js" crossorigin="anonymous"></script>

</body>
</html>