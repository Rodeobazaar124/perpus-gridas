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

    $module = $_GET['modul'];
    $act = $_GET['act'];

    if ($module == 'user' and $act == 'hapus') {
        mysqli_query(KONEKSI, "DELETE FROM users WHERE id_user='$_GET[id]'");
        header('location:../../home.php?modul='.$module);
    }

    // Input user
    if ($module == 'user' and $act == 'input') {
        $pass = md5($_POST['password']);
        mysqli_query(KONEKSI, "INSERT INTO users(username,
                                 password,
                                 nama_lengkap) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]')");
        header('location:../../home.php?modul='.$module);
    } elseif ($module == 'user' and $act == 'update') {
        if (empty($_POST['password'])) {
            mysqli_query(KONEKSI, "UPDATE users SET nama_lengkap   = '$_POST[nama_lengkap]'                          
                           WHERE  id_user     = '$_POST[id]'");
        } else {
            $pass = md5($_POST['password']);
            mysqli_query(KONEKSI, "UPDATE users SET password        = '$pass',
                                 nama_lengkap    = '$_POST[nama_lengkap]'
                           WHERE id_user      = '$_POST[id]'");
        }
        header('location:../../home.php?modul='.$module);
    }
}
