<?php  

require '../functions.php';
$keyword = $_GET['keyword'];
$query = "SELECT * FROM mahasiswa
		WHERE
		nama LIKE '%$keyword%' OR 
		nim LIKE '%$keyword%' OR
		email LIKE '%$keyword%' OR
		jurusan LIKE '%$keyword%'
		";
$mahasiswa = query($query);

?>

<table class="table table-striped">
	<tr>
		<th>No.</th>
		<th>Aksi</th>
		<th>gambar</th>
		<th>nim</th>
		<th>nama</th>
		<th>email</th>
		<th>jurusan</th>
	</tr>
	<?php $i = 1; ?>
	<?php foreach( $mahasiswa as $row ) :?>
	<tr>
		<td><?php echo $i ?></td>
		<td>
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
	
</table>