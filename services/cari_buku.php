<?php

$judul = $_GET['judul'];

include 'configure.php';

header('Content-type: application/json');
$query = mysqli_query(KONEKSI, "SELECT tblbuku.id_buku, tblbuku.judul, tblbuku.id_pengarang, tblbuku.id_penerbit, tblbuku.jumlahbuku,
						refpengarang.id_pengarang, refpengarang.nama_pengarang,tblbuku.tersedia,
						penerbit.id_penerbit, penerbit.nama_penerbit
						FROM tblbuku
						left join penerbit 		on penerbit.id_penerbit		= tblbuku.id_penerbit
						left join refpengarang		on refpengarang.id_pengarang		= tblbuku.id_pengarang  
						WHERE tblbuku.judul LIKE '%$judul%'");
$total = mysqli_num_rows($query);
$arr = [];
while ($obj = mysqli_fetch_object($query)) {
    $arr[] = $obj;
}
echo '{"cr":'.json_encode($arr).'}';
