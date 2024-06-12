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

    if ($modul == 'rak' and $act == 'hapus') {
        mysqli_query(KONEKSI, "DELETE FROM tblrak WHERE id_rak='$_GET[id]'");
        header('location:../../home.php?modul='.$modul);
    } elseif ($modul == 'rak' and $act == 'input') {

        mysqli_query(KONEKSI, "INSERT INTO tblrak(koderak) 
					                VALUES(
								 '$_POST[rak]')");
        header('location:../../home.php?modul='.$modul);
    } elseif ($modul == 'rak' and $act == 'update') {

        mysqli_query(KONEKSI, "UPDATE tblrak SET koderak        = '$_POST[rak]'
                           WHERE id_rak  = '$_POST[id]'");
        header('location:../../home.php?modul='.$modul);
    }
}
