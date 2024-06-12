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
    include '../../config/fungsi_thumb.php';

    $modul = $_GET['modul'];
    $act = $_GET['act'];

    if ($modul == 'buku' and $act == 'hapus') {

        mysqli_query(KONEKSI, "DELETE FROM tblbuku WHERE kdbuku='$_POST[kode]'");
        mysqli_query(KONEKSI, "DELETE FROM tbleksemplar WHERE kdbuku='$_POST[kode]'");

        header('location:../../home.php?modul='.$modul);
    } elseif ($modul == 'buku' and $act == 'input') {
        $lokasi_file = $_FILES['fupload']['tmp_name'];
        $tipe_file = $_FILES['fupload']['type'];
        $nama_file = $_FILES['fupload']['name'];
        $acak = rand(1, 99);
        $nama_file_unik = $acak.$nama_file;

        // Apabila ada gambar yang diupload
        if (! empty($lokasi_file)) {
            if ($tipe_file != 'image/jpeg' and $tipe_file != 'image/pjpeg') {
                echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../home.php?modul=galerifoto')</script>";
            } else {
                UploadSampul($nama_file_unik);
                mysqli_query(KONEKSI, "INSERT INTO tblbuku(kdbuku,
                                  id_klasifikasi, 
                                  id_pengarang,
                                  judul,
								  id_penerbit,
								  kolasi,
								  keterangan,
								  jdlseri,
								  isbn,
								  id_subjek,
								  jumlahbuku,
								  id_rak,
								  id_kategori,
								  tahun,
								  asal,
								  file,
								  edisi,
								  abstraksi,
								  bahasa,
								  biblio,
								  kota,
								  tersedia) 
					                VALUES(
								 '$_POST[kode]',
                                 '$_POST[klasifikasi]',
                                 '$_POST[pengarang]',
                                 '$_POST[judul]',
								 '$_POST[penerbit]',
								 '$_POST[kolasi]',
								 '$_POST[keterangan]',
								 '$_POST[judulseri]',
								 '$_POST[isbn]',
								 '$_POST[subjek]',
								 '$_POST[jumlah]',
								 '$_POST[rak]',
								 '$_POST[kategori]',
								 '$_POST[tahun]',
								 '$_POST[asal]',
								 '$nama_file_unik',
								 '$_POST[edisi]',
								 '$_POST[abstraksi]',
								 '$_POST[bahasa]',
								 '$_POST[biblio]',
                                 '$_POST[kota]',
								 '$_POST[jumlah]')");

                $kode = $_POST['kode'];
                $jumlah = $_POST['jumlah'];
                $sfs = '/';
                $i = 1;
                while ($i <= $jumlah) {
                    $ek = $kode.$sfs.$i;
                    mysqli_query(KONEKSI, "INSERT INTO tbleksemplar(kdbuku,kdeksemplar) 
					                VALUES(
								 '$_POST[kode]',
								 '$ek')");
                    $i++;
                }
                header('location:../../home.php?modul='.$modul);
            }
        } else {
            mysqli_query(KONEKSI, "INSERT INTO tblbuku(kdbuku,
                                  id_klasifikasi, 
                                  id_pengarang,
                                  judul,
								  id_penerbit,
								  kolasi,
								  keterangan,
								  jdlseri,
								  isbn,
								  id_subjek,
								  jumlahbuku,
								  id_rak,
								  id_kategori,
								  tahun,
								  asal,
								  edisi,
								  abstraksi,
								  bahasa,
								  biblio,
								  kota,
								  tersedia) 
					                VALUES(
								 '$_POST[kode]',
                                 '$_POST[klasifikasi]',
                                 '$_POST[pengarang]',
                                 '$_POST[judul]',
								 '$_POST[penerbit]',
								 '$_POST[kolasi]',
								 '$_POST[keterangan]',
								 '$_POST[judulseri]',
								 '$_POST[isbn]',
								 '$_POST[subjek]',
								 '$_POST[jumlah]',
								 '$_POST[rak]',
								 '$_POST[kategori]',
								 '$_POST[tahun]',
								 '$_POST[asal]',
								 '$_POST[edisi]',
								 '$_POST[abstraksi]',
								 '$_POST[bahasa]',
								 '$_POST[biblio]',
                                 '$_POST[kota]',
								 '$_POST[jumlah]')");

            $kode = $_POST['kode'];
            $jumlah = $_POST['jumlah'];
            $sfs = '/';
            $i = 1;
            while ($i <= $jumlah) {
                $ek = $kode.$sfs.$i;
                mysqli_query(KONEKSI, "INSERT INTO tbleksemplar(kdbuku,kdeksemplar) 
					                VALUES(
								 '$_POST[kode]',
								 '$ek')");
                $i++;
            }
            header('location:../../home.php?modul='.$modul);
        }
    }

    // Update buku
    elseif ($modul == 'buku' and $act == 'update') {

        mysqli_query(KONEKSI, "UPDATE tblbuku SET kdbuku    = '$_POST[kode]',
                                id_klasifikasi    = '$_POST[klasifikasi]',
                                 id_pengarang  = '$_POST[pengarang]',
                                 judul   = '$_POST[judul]',
                                 id_penerbit = '$_POST[penerbit]',
								 kolasi = '$_POST[kolasi]',
								 keterangan = '$_POST[keterangan]',
								 jdlseri = '$_POST[judulseri]',
								 isbn = '$_POST[isbn]',
								 id_subjek = '$_POST[subjek]',
								 jumlahbuku = '$_POST[jumlah]',
								 id_rak = '$_POST[rak]',
								 id_kategori = '$_POST[kategori]',
								 tahun = '$_POST[tahun]',
								 asal = '$_POST[asal]',
								 edisi = '$_POST[edisi]',
								 abstraksi = '$_POST[abstraksi]',
								 bahasa = '$_POST[bahasa]',
								 biblio = '$_POST[biblio]',
								 kota = '$_POST[kota]',
								 tersedia = '$_POST[jumlah]'
                           WHERE id_buku   = '$_POST[id]'");

        $kode = $_POST['kode'];
        $jumlah = $_POST['jumlah'];
        $sfs = '/';
        $i = 1;
        while ($i <= $jumlah) {
            $ek = $kode.$sfs.$i;
            mysqli_query(KONEKSI, "UPDATE SET tbleksemplar kdbuku = '$_POST[kode]',
									kdeksemplar = '$ek'
					                WHERE kdbuku = '$_POST[kode]'");
            $i++;
        }

        mysqli_query(KONEKSI, "DELETE FROM tbleksemplar WHERE kdbuku='$_POST[kode]'");

        $kode = $_POST['kode'];
        $jumlah = $_POST['jumlah'];
        $sfs = '/';
        $i = 1;
        while ($i <= $jumlah) {
            $ek = $kode.$sfs.$i;
            mysqli_query(KONEKSI, "INSERT INTO tbleksemplar(kdbuku,kdeksemplar) 
					                VALUES(
								 '$_POST[kode]',
								 '$ek')");
            $i++;
        }
        header('location:../../home.php?modul='.$modul);

    }
}
