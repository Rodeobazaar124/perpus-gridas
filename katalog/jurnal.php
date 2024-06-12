<?php

include 'config/koneksi.php';

$tampil = mysqli_query(KONEKSI, 'SELECT * FROM jurnal,kategori WHERE kategori.id_kategori = jurnal.id_kategori ORDER BY id_jurnal DESC LIMIT 5');
while ($r = mysqli_fetch_array($tampil)) {
    echo " <td>$r[judul]</td>";

}
