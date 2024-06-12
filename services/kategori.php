<?php

include 'configure.php';

$kat = $_GET['id'];

header('Content-type: application/json');
$arr = [];
$rs = mysqli_query(KONEKSI, "SELECT tblbuku.id_buku, tblbuku.judul, tblbuku.id_pengarang, tblbuku.id_penerbit, tblbuku.jumlahbuku,
						refpengarang.id_pengarang, refpengarang.nama_pengarang,tblbuku.tersedia,
						penerbit.id_penerbit, penerbit.nama_penerbit , refkategori.id_kategori, refkategori.nama_kategori, tblbuku.id_kategori
						FROM tblbuku
						left join penerbit 		on penerbit.id_penerbit		= tblbuku.id_penerbit
						left join refpengarang		on refpengarang.id_pengarang		= tblbuku.id_pengarang
						left join refkategori	on refkategori.id_kategori = tblbuku.id_kategori
					    WHERE tblbuku.id_kategori = '$kat'");
while ($obj = mysqli_fetch_object($rs)) {
    $arr[] = $obj;
}
echo '{"items":'.json_encode($arr).'}';
/*
//The json object is :
{"members":[{"id":"1","title":"Mr","firstname":"Peter","surname":"Ventouris"},{"id":"2","title":"Mr","firstname":"David","surname":"Dabel"},{"id":"3","title":"Mr","firstname":"John","surname":"Merkel"},{"id":"4","title":"Mr","firstname":"James","surname":"Eltons"}]}
*/
