<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {
    $act = $_POST['act'];
    $result = '';
    include '../../config/koneksi.php';
    switch ($act) {
        case 'new_peng':
            $nama_pengarang = $_POST['nama_pengarang'];
            mysqli_query(KONEKSI, "insert into refpengarang values ('','$nama_pengarang')");
            $query = mysqli_query(KONEKSI, 'select * from refpengarang');
            $result .= '<option value=0 selected>- Pilih Pengarang -</option>';
            while ($rs = mysqli_fetch_array($query)) {
                $result .= "<option value=$rs[id_pengarang]>$rs[nama_pengarang]</option>";
            }
            break;
        case 'new_penerbit':
            $nama_penerbit = $_POST['nama_penerbit'];
            $alamat = $_POST['alamat'];
            mysqli_query(KONEKSI, "insert into penerbit values ('','$nama_penerbit','$alamat')");
            $query = mysqli_query(KONEKSI, 'select * from penerbit');
            $result .= '<option value=0 selected>- Pilih Penerbit -</option>';
            while ($rs = mysqli_fetch_array($query)) {
                $result .= "<option value=$rs[id_penerbit]>$rs[nama_penerbit]</option>";
            }
            break;
        case 'new_sub':
            $nama_subjek = $_POST['nama_subjek'];
            mysqli_query(KONEKSI, "insert into refsubjek values ('','$nama_subjek')");
            $query = mysqli_query(KONEKSI, 'select * from refsubjek');
            $result .= '<option value=0 selected>- Pilih Pengarang -</option>';
            while ($rs = mysqli_fetch_array($query)) {
                $result .= "<option value=$rs[id_subjek]>$rs[nama_subjek]</option>";
            }
            break;
        case 'new_kat':
            $nama_kategori = $_POST['nama_kategori'];
            mysqli_query(KONEKSI, "insert into refkategori values ('','$nama_kategori')");
            $query = mysqli_query(KONEKSI, 'select * from refkategori');
            $result .= '<option value=0 selected>- Pilih Kategori -</option>';
            while ($rs = mysqli_fetch_array($query)) {
                $result .= "<option value=$rs[id_kategori]>$rs[nama_kategori]</option>";
            }
            break;
        case 'new_klas':
            $nama_klasifikasi = $_POST['nama_klasifikasi'];
            mysqli_query(KONEKSI, "insert into refklasifikasi values ('','$nama_klasifikasi')");
            $query = mysqli_query(KONEKSI, 'select * from refklasifikasi');
            $result .= '<option value=0 selected>- Pilih Klasifikasi -</option>';
            while ($rs = mysqli_fetch_array($query)) {
                $result .= "<option value=$rs[id_klasifikasi]>$rs[nama_klasifikasi]</option>";
            }
            break;
        case 'new_rak':
            $koderak = $_POST['koderak'];
            mysqli_query(KONEKSI, "insert into tblrak values ('','$koderak')");
            $query = mysqli_query(KONEKSI, 'select * from tblrak');
            $result .= '<option value=0 selected>- Pilih rak -</option>';
            while ($rs = mysqli_fetch_array($query)) {
                $result .= "<option value=$rs[id_rak]>$rs[koderak]</option>";
            }
            break;
    }
    exit($result);
}
