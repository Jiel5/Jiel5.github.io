<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");
$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daftar Mahasiswa</title>
	<link rel="stylesheet" href="css/print.css">
</head>
<body>
	<h1 align="center">Daftar Mahasiswa</h1>
	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>No.</th>
			<th>gambar</th>
			<th>nim</th>
			<th>nama</th>
			<th>email</th>
			<th>jurusan</th>
		</tr>';

	$i = 1;
	foreach ($mahasiswa as $row) {
		$html .= '<tr>
			<td>'. $i++ .'</td>
			<td><img src="img/'. $row["gambar"].'" width="50"></td>
			<td>'. $row["nim"].'</td>
			<td>'. $row["nama"].'</td>
			<td>'. $row["email"].'</td>
			<td>'. $row["jurusan"].'</td>	
		</tr>';
	}

$html .='</table>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('daftar-mahasiswa.pdf', 'I');

?>
