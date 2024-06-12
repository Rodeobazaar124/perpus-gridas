<?php

include 'config/koneksi.php';
include 'config/library.php';

$anggota = $_POST['noanggota'];

$kunjung = mysqli_query(KONEKSI, "SELECT * FROM anggota WHERE noanggota='$anggota' AND status='AKTIF' ");
$ketemu = mysqli_num_rows($kunjung);
$r = mysqli_fetch_array($kunjung);

// Apabila username dan password ditemukan
if ($ketemu > 0) {

    mysqli_query(KONEKSI, "INSERT INTO tblpengunjung(noanggota,tglkunjungan,jam) 
                            VALUES('$_POST[noanggota]',
									'$tgl_sekarang',
                                   '$jam_sekarang')");
    header('location:home.php?modul=home');
} else {

    header('location:gagal.html');

}
