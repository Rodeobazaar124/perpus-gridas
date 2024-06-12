<?php

include 'configure.php';

header('Content-type: application/json');
$query = mysqli_query(KONEKSI, "SELECT jurnal.*,
						katjurnal.id_kategori, katjurnal.nama_kategori
						FROM jurnal, katjurnal
						WHERE jurnal.id_kategori = katjurnal.id_kategori AND jurnal.id_jurnal = $_GET[id]");
$total = mysqli_num_rows($query);

$show = [];
while ($k = mysqli_fetch_array($query)) {
    $show = [
        'id' => $k['id_buku'],
        'judul' => $k['judul'],
        'penulis' => $k['penulis'],
        'abstrak' => $k['abstrak'],
        'kategori' => $k['nama_kategori'],
        'tgl_posting' => $k['tgl_posting'],
        'kategori' => $k['nama_kategori'],
        'hits' => $k['hits'],
        'file' => $k['file']];
}
echo '{"item":'.json_encode($show).'}';
