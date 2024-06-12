<?php

include 'configure.php';

$kat = $_GET['id'];

header('Content-type: application/json');
$arr = [];
$rs = mysqli_query(KONEKSI, "SELECT left(jurnal.judul,25) as jdl,jurnal.id_jurnal,jurnal.penulis,jurnal.hits, katjurnal.id_kategori,katjurnal.nama_kategori
						FROM jurnal, katjurnal
						WHERE jurnal.id_kategori = katjurnal.id_kategori AND
					    jurnal.id_kategori = '$kat'");
while ($obj = mysqli_fetch_object($rs)) {
    $arr[] = $obj;
}
echo '{"items":'.json_encode($arr).'}';
