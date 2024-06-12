<?php

include 'configure.php';
header('Content-type: application/json');
$arr = [];
$rs = mysqli_query(KONEKSI, 'SELECT tblbuku.id_buku, tblbuku.judul, tblbuku.id_pengarang, tblbuku.id_penerbit, tblbuku.jumlahbuku,
						refpengarang.id_pengarang, refpengarang.nama_pengarang,tblbuku.tersedia,
						penerbit.id_penerbit, penerbit.nama_penerbit
						FROM tblbuku
						left join penerbit 		on penerbit.id_penerbit		= tblbuku.id_penerbit
						left join refpengarang		on refpengarang.id_pengarang		= tblbuku.id_pengarang
					    
						ORDER BY tblbuku.id_buku');
while ($obj = mysqli_fetch_object($rs)) {
    $arr[] = $obj;
}
echo '{"items":'.json_encode($arr).'}';
