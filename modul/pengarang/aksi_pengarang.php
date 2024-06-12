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

    if ($modul == 'pengarang' and $act == 'hapus') {
        mysqli_query(KONEKSI, "DELETE FROM refpengarang WHERE id_pengarang='$_GET[id]'");
        header('location:../../home.php?modul='.$modul);
    } elseif ($modul == 'pengarang' and $act == 'input') {

        mysqli_query(KONEKSI, "INSERT INTO refpengarang(nama_pengarang) 
					                VALUES(
								 '$_POST[nama]')");
        header('location:../../home.php?modul='.$modul);
    } elseif ($modul == 'pengarang' and $act == 'update') {

        mysqli_query(KONEKSI, "UPDATE refpengarang SET nama_pengarang        = '$_POST[nama]'
                           WHERE id_pengarang   = '$_POST[id]'");
        header('location:../../home.php?modul='.$modul);
    }
}
