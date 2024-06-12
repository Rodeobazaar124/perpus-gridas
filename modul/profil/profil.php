<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {
    $aksi = 'modul/profil/aksi_profil.php';
    switch ($_GET['act']) {
        default:
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM profil');

            while ($r = mysqli_fetch_array($tampil)) {
                echo "
   <div class='span12 kotak' >
  <h4 align=center>Profil Perpustakaan</h4>
  <hr>
  <a href='?modul=profil&act=editprofil'>
  <button class='btn btn-danger' style='margin-left:10px;' type='button'>Edit Profil</button></a>
  <hr>
        <table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
		 <tr><td>Logo</td><td>:</td><td> <img src='images/$r[logo]' width='150px' ></td></tr>
         <tr><td>Nama Perpustakaan</td><td>:</td><td> $r[nama_perpus]</td></tr>
		 <tr><td>Kepala Perpustakaan</td><td>:</td><td> $r[kepala_perpus]</td></tr>
		 <tr><td>Alamat</td><td>:</td><td> $r[alamat]</td></tr>
		 <tr><td>Visi</td><td>:</td><td> $r[visi]</td></tr>
		 <tr><td>Misi</td><td>:</td><td> $r[misi]</td></tr>
		 
	         
		 </table>";

            }

            break;

        case 'tambahjurnal':
            echo "
  <h4 align=center>Tambah Jurnal</h4>
  <hr>
        <form class='form-horizontal' method=POST action='$aksi?modul=jurnal&act=input' enctype='multipart/form-data'>
		
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
		 <tr><td>Judul</td><td>:</td><td> <input class='input-xxlarge' type='text' name='judul' placeholder='Masukan Judul Jurnal'></td></tr>
         <tr><td>Penulis</td><td>:</td><td> <input class='input-xxlarge' type='text' name='penulis' placeholder='Masukan nama Penulis'></td></tr>
		
		  <tr><td>Kategori</td><td>:</td><td>
		 <select name='kategori' class='form-control' >
            <option value=0 selected>- Pilih Kategori -</option>";
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM katjurnal ORDER BY nama_kategori ');
            while ($r = mysqli_fetch_array($tampil)) {
                echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
            echo "	
		 </td></tr>
		 
		 <tr><td>File</td><td>:</td><td> <input type=file name='fupload' ></td></tr>
		 <tr><td>Abstrak</td><td>:</td><td> <textarea name='abstrak'></textarea></td></tr>
	         
		 </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;

        case 'editprofil':
            $edit = mysqli_query(KONEKSI, 'SELECT * FROM profil');

            $r = mysqli_fetch_array($edit);

            echo "
		  <div class='span12 kotak' >
  <h4 align=center>Edit Profil</h4>
  <hr>
        <form class='form-horizontal' method='POST' action='$aksi?modul=profil&act=update' enctype='multipart/form-data'>
		 <input type=hidden name=id value=$r[id_profil]>
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
		 <tr><td>Nama Perpustakaan</td><td>:</td><td> <input class='input-xxlarge' value='$r[nama_perpus]' type='text' name='nama' placeholder='Masukan Nama Perpustakaan'></td></tr>
         <tr><td>Kepala Perpustakaan</td><td>:</td><td> <input class='input-xxlarge' value='$r[kepala_perpus]' type='text' name='kepala_perpus' placeholder='Masukan Nama Kepala Perpustakaan'></td></tr>
         <tr><td>Logo Sebelumnya</td><td>:</td><td> <img src='images/$r[logo]' width='150px'></td></tr>
		 <tr><td>Logo</td><td>:</td><td> <input type=file name='fupload' ></td></tr>
		 <tr><td>Alamat</td><td>:</td><td> <textarea name='alamat'>$r[alamat]</textarea></td></tr>
	     <tr><td>Visi</td><td>:</td><td> <textarea id='loko'  name='visi'>$r[visi]</textarea></td></tr>    
		 <tr><td>Misi</td><td>:</td><td> <textarea id='loko2'  name='misi'>$r[misi]</textarea></td></tr>   
		 </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;

    }
}
