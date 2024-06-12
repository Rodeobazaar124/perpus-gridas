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

    $modul = $_GET['modul'];
    $act = $_GET['act'];

    if ($modul == 'anggota' and $act == 'hapus') {
        $data = mysqli_fetch_array(mysqli_query(KONEKSI, "SELECT foto FROM anggota WHERE id='$_GET[id]'"));
        if ($data['foto'] != '') {
            mysqli_query(KONEKSI, "DELETE FROM anggota WHERE id='$_GET[id]'");
            unlink("../../images/foto/$_GET[namafile]");
        } else {
            mysqli_query(KONEKSI, "DELETE FROM anggota WHERE id='$_GET[id]'");
        }
        header('location:../../home.php?modul='.$modul);
    }

    // Input anggota
    elseif ($modul == 'anggota' and $act == 'input') {
        $lokasi_file = $_FILES['fupload']['tmp_name'];
        $tipe_file = $_FILES['fupload']['type'];
        $nama_file = $_FILES['fupload']['name'];

        // Apabila ada gambar yang diupload
        if (! empty($lokasi_file)) {
            if ($tipe_file != 'image/jpeg' and $tipe_file != 'image/pjpeg') {
                echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../home.php?modul=anggota')</script>";
            } else {
                UploadAnggota($nama_file);
                mysqli_query(KONEKSI, "INSERT INTO anggota(noanggota,
                                    nama,
                                    tgllahir,
                                    jenis,
									alamat,
									notelp,
									pekerjaan,
									tglanggota,
									foto,
									status) 
                            VALUES('$_POST[noanggota]',
                                   '$_POST[nama]',
								   '$_POST[tgllahir]',
								   '$_POST[jk]',
								   '$_POST[alamat]',
								   '$_POST[notelp]',
								   '$_POST[pekerjaan]',
                                   '$tgl_sekarang',
                                   '$nama_file',
								   'AKTIF')");
                header('location:../../home.php?modul='.$modul);
            }
        } else {
            mysqli_query(KONEKSI, "INSERT INTO anggota(noanggota,
                                    nama,
                                    tgllahir,
                                    jenis,
									alamat,
									notelp,
									pekerjaan,
									tglanggota,
									status) 
                            VALUES('$_POST[noanggota]',
                                   '$_POST[nama]',
								   '$_POST[tgllahir]',
								   '$_POST[jk]',
								   '$_POST[alamat]',
								   '$_POST[notelp]',
								   '$_POST[pekerjaan]',
                                   '$tgl_sekarang',
								   'AKTIF')");
            header('location:../../home.php?modul='.$modul);
        }
    }

    // Update
    elseif ($modul == 'anggota' and $act == 'update') {
        $lokasi_file = $_FILES['fupload']['tmp_name'];
        $tipe_file = $_FILES['fupload']['type'];
        $nama_file = $_FILES['fupload']['name'];

        // Apabila gambar tidak diganti
        if (empty($lokasi_file)) {
            mysqli_query(KONEKSI, "UPDATE anggota SET noanggota     = '$_POST[noanggota]',
                                   nama       = '$_POST[nama]',
								   tgllahir       = '$_POST[tgllahir]',
								   jenis       = '$_POST[jk]',
								   alamat       = '$_POST[alamat]',
								    notelp       = '$_POST[notelp]',
									 pekerjaan       = '$_POST[pekerjaan]',
									  status       = '$_POST[status]'
                             WHERE id = '$_POST[id]'");
            header('location:../../home.php?modul='.$modul);
        } else {
            if ($tipe_file != 'image/jpeg' and $tipe_file != 'image/pjpeg') {
                echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../home.php?modul=anggota')</script>";
            } else {
                UploadAnggota($nama_file);
                mysqli_query(KONEKSI, "UPDATE anggota SET noanggota     = '$_POST[noanggota]',
                                   nama       = '$_POST[nama]',
								   tgllahir       = '$_POST[tgllahir]',
								   jenis       = '$_POST[jk]',
								   alamat       = '$_POST[alamat]',
								    notelp       = '$_POST[notelp]',
									 pekerjaan       = '$_POST[pekerjaan]',
									  status       = '$_POST[status]',
									  foto			= '$nama_file'
                             WHERE id = '$_POST[id]'");
                header('location:../../home.php?modul='.$modul);
            }
        }
    }
}
