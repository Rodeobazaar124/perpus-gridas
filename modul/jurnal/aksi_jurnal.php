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

    // Hapus banner
    if ($module == 'jurnal' and $act == 'hapus') {
        $data = mysqli_fetch_array(mysqli_query(KONEKSI, "SELECT file FROM jurnal WHERE id_jurnal='$_GET[id]'"));
        if ($data['file'] != '') {
            mysqli_query(KONEKSI, "DELETE FROM jurnal WHERE id_jurnal='$_GET[id]'");
            unlink("../../files/$_GET[namafile]");
        } else {
            mysqli_query(KONEKSI, "DELETE FROM jurnal WHERE id_jurnal='$_GET[id]'");
        }
        header('location:../../home.php?modul='.$module);
    }

    // Input banner
    elseif ($module == 'jurnal' and $act == 'input') {
        $lokasi_file = $_FILES['fupload']['tmp_name'];
        $tipe_file = $_FILES['fupload']['type'];
        $nama_file = $_FILES['fupload']['name'];

        // Apabila ada gambar yang diupload
        if (! empty($lokasi_file)) {

            $file_extension = strtolower(substr(strrchr($nama_file, '.'), 1));

            switch ($file_extension) {
                case 'pdf': $ctype = 'application/pdf';
                    break;
                default: $ctype = 'application/proses';
            }

            if ($file_extension == 'php') {
                echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload tidak bertipe *.PDF');
        window.location=('../../home.php?modul=jurnal')</script>";
            } else {
                UploadFile($nama_file);
                mysqli_query(KONEKSI, "INSERT INTO jurnal(judul,
                                    penulis,
                                    tgl_posting,
									abstrak,
									id_kategori,
                                    file,
									status) 
                            VALUES('$_POST[judul]',
                                   '$_POST[penulis]',
                                   '$tgl_sekarang',
								   '$_POST[abstrak]',
								   '$_POST[kategori]',
                                   '$nama_file',
								   'PUBLISH')");
                header('location:../../home.php?modul='.$module);
            }
        } else {
            mysqli_query(KONEKSI, "INSERT INTO jurnal(judul,
									penulis,
                                    tgl_posting,
									abstrak,
									id_kategori,
									status) 
                            VALUES('$_POST[judul]',
									'$_POST[penulis]',
                                   '$tgl_sekarang',
								   '$_POST[abstrak]',
								   '$_POST[kategori]',
								   'PUBLISH')");
            header('location:../../home.php?modul='.$module);
        }
    }

    // Update kurnal
    elseif ($module == 'jurnal' and $act == 'update') {
        $lokasi_file = $_FILES['fupload']['tmp_name'];
        $tipe_file = $_FILES['fupload']['type'];
        $nama_file = $_FILES['fupload']['name'];
        $acak = rand(1, 99);
        $nama_file_unik = $acak.$nama_file;

        // Apabila gambar tidak diganti
        if (empty($lokasi_file)) {
            mysqli_query(KONEKSI, "UPDATE jurnal SET judul     = '$_POST[judul]',
								   penulis     = '$_POST[penulis]',
								   abstrak     = '$_POST[abstrak]',
								   status     = '$_POST[status]',
                                   id_kategori       = '$_POST[kategori]'
                             WHERE id_jurnal = '$_POST[id]'");
            header('location:../../home.php?modul='.$module);
        } else {

            UploadFile($nama_file);
            mysqli_query(KONEKSI, "UPDATE jurnal SET judul     = '$_POST[judul]',
                                    penulis     = '$_POST[penulis]',
								   abstrak     = '$_POST[abstrak]',
								   status     = '$_POST[status]',
                                   id_kategori       = '$_POST[kategori]',
                                   file    = '$nama_file'   
                             WHERE id_jurnal= '$_POST[id]'");
            header('location:../../home.php?modul='.$module);

        }
    }
}
