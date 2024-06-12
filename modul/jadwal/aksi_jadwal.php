<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {

    include '../../config/koneksi.php';

    $modul = $_GET['modul'];
    $act = $_GET['act'];

    if ($modul == 'jadwal' and $act == 'hapus') {
        mysqli_query(KONEKSI, "DELETE FROM jadwal WHERE id_jadwal='$_GET[id]'");
        header('location:../../home.php?modul='.$modul);
    } elseif ($modul == 'jadwal' and $act == 'input') {

        mysqli_query(KONEKSI, "INSERT INTO jadwal(hari,
								  jam_buka,
								  jam_tutup,
								  ket) 
					                VALUES(
								 '$_POST[hari]',
								 '$_POST[jam_buka]',
								 '$_POST[jam_tutup]',
								 '$_POST[ket]'
								 )");
        header('location:../../home.php?modul='.$modul);
    } elseif ($modul == 'jadwal' and $act == 'update') {

        mysqli_query(KONEKSI, "UPDATE jadwal SET hari        = '$_POST[hari]',
								 jam_buka    = '$_POST[jam_buka]',
								 jam_tutup        = '$_POST[jam_tutup]',
								 ket        = '$_POST[ket]'
                           WHERE id_jadwal   = '$_POST[id]'");
        header('location:../../home.php?modul='.$modul);
    }
}
