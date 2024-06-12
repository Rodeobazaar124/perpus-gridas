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

    if ($modul == 'penerbit' and $act == 'hapus') {
        mysqli_query(KONEKSI, "DELETE FROM penerbit WHERE id_penerbit ='$_GET[id]'");
        header('location:../../home.php?modul='.$modul);
    } elseif ($modul == 'penerbit' and $act == 'input') {

        mysqli_query(KONEKSI, "INSERT INTO penerbit(nama_penerbit,alamat) 
					                VALUES(
								 '$_POST[nama]','$_POST[alamat]')");
        header('location:../../home.php?modul='.$modul);
    } elseif ($modul == 'penerbit' and $act == 'update') {

        mysqli_query(KONEKSI, "UPDATE penerbit SET nama_penerbit        = '$_POST[nama]',
									 alamat        = '$_POST[alamat]'
                           WHERE id_penerbit   = '$_POST[id]'");
        header('location:../../home.php?modul='.$modul);
    }
}
