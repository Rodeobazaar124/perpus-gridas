<?php

$judul = $_GET['judul'];

include 'configure.php';

header('Content-type: application/json');
$query = mysqli_query(KONEKSI, "SELECT left(jurnal.judul,25) as jdl,jurnal.id_jurnal,jurnal.penulis,jurnal.hits, katjurnal.id_kategori,katjurnal.nama_kategori
						FROM jurnal, katjurnal
						WHERE jurnal.id_kategori = katjurnal.id_kategori AND jurnal.judul LIKE '%$judul%'");
$total = mysqli_num_rows($query);
$arr = [];
while ($obj = mysqli_fetch_object($query)) {
    $arr[] = $obj;
}
echo '{"jr":'.json_encode($arr).'}';
