<?php

include 'configure.php';

header('Content-type: application/json');
$query = mysqli_query(KONEKSI, "SELECT tblbuku.*,
						refpengarang.id_pengarang, refpengarang.nama_pengarang,tblbuku.tersedia,
						penerbit.id_penerbit, penerbit.nama_penerbit , tblrak.id_rak, tblrak.koderak, refkategori.id_kategori, refkategori.nama_kategori
						FROM tblbuku
						left join penerbit 		on penerbit.id_penerbit		= tblbuku.id_penerbit
						left join tblrak 		on tblrak.id_rak		= tblbuku.id_rak
						left join refkategori 		on refkategori.id_kategori		= tblbuku.id_kategori
						left join refpengarang		on refpengarang.id_pengarang		= tblbuku.id_pengarang  WHERE tblbuku.id_buku = $_GET[id]");
$total = mysqli_num_rows($query);

$show = [];
while ($k = mysqli_fetch_array($query)) {
    $show = [
        'id' => $k['id_buku'],
        'judul' => $k['judul'],
        'koderak' => $k['koderak'],
        'jumlahbuku' => $k['jumlahbuku'],
        'penerbit' => $k['nama_penerbit'],
        'bahasa' => $k['bahasa'],
        'kategori' => $k['nama_kategori'],
        'tersedia' => $k['tersedia'],
        'pengarang' => $k['nama_pengarang']];
}
echo '{"item":'.json_encode($show).'}';
