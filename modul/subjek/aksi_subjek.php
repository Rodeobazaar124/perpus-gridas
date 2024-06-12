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

    if ($modul == 'subjek' and $act == 'hapus') {
        mysqli_query(KONEKSI, "DELETE FROM refsubjek WHERE id_subjek='$_GET[id]'");
        header('location:../../home.php?modul='.$modul);
    } elseif ($modul == 'subjek' and $act == 'input') {

        mysqli_query(KONEKSI, "INSERT INTO refsubjek(nama_subjek) 
					                VALUES(
								 '$_POST[nama]')");
        header('location:../../home.php?modul='.$modul);
    } elseif ($modul == 'subjek' and $act == 'update') {

        mysqli_query(KONEKSI, "UPDATE refsubjek SET nama_subjek        = '$_POST[nama]'
                           WHERE id_subjek   = '$_POST[id]'");
        header('location:../../home.php?modul='.$modul);
    }
}
