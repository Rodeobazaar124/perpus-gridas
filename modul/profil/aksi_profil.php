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
    include '../../config/library.php';
    include '../../config/fungsi_thumb.php';

    $module = $_GET['modul'];
    $act = $_GET['act'];

    // Update kurnal
    if ($module == 'profil' and $act == 'update') {
        $lokasi_file = $_FILES['fupload']['tmp_name'];
        $tipe_file = $_FILES['fupload']['type'];
        $nama_file = $_FILES['fupload']['name'];
        $acak = rand(1, 99);
        $nama_file_unik = $acak.$nama_file;

        // Apabila gambar tidak diganti
        if (empty($lokasi_file)) {
            mysqli_query(KONEKSI, "UPDATE profil SET nama_perpus     = '$_POST[nama]',
								   alamat     = '$_POST[alamat]',
								   kepala_perpus     = '$_POST[kepala_perpus]',
								   visi     = '$_POST[visi]',
								   misi     = '$_POST[misi]'
                             WHERE id_profil = '$_POST[id]'");
            header('location:../../home.php?modul='.$module);
        } else {

            UploadLogo($nama_file);
            mysqli_query(KONEKSI, "UPDATE profil SET nama_perpus     = '$_POST[nama]',
                                    alamat     = '$_POST[alamat]',
									 kepala_perpus     = '$_POST[kepala_perpus]',
								   visi     = '$_POST[visi]',
								   misi     = '$_POST[misi]',
                                   logo    = '$nama_file'   
                             WHERE id_profil= '$_POST[id]'");
            header('location:../../home.php?modul='.$module);

        }
    }
}
