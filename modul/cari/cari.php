<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {
    $aksi = 'modul/buku/aksi_buku.php';
    switch ($_GET['act']) {
        default:
            echo '
  ';

            // menghilangkan spasi di kiri dan kanannya
            $kata = trim($_POST['txt']);
            // mencegah XSS
            $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);

            // pisahkan kata per kalimat lalu hitung jumlah kata
            $pisah_kata = explode(' ', $kata);
            $jml_katakan = (int) count($pisah_kata);
            $jml_kata = $jml_katakan - 1;

            $cari = 'SELECT * FROM buku WHERE ';
            for ($i = 0; $i <= $jml_kata; $i++) {
                $cari .= "judul LIKE '%$pisah_kata[$i]%'";
                if ($i < $jml_kata) {
                    $cari .= ' OR ';
                }
            }
            $cari .= ' ORDER BY id_buku DESC ';
            $hasil = mysqli_query(KONEKSI, $cari);
            $ketemu = mysqli_num_rows($hasil);

            if ($ketemu > 0) {
                echo "<div class='alert alert-success'>Ditemukan <b>$ketemu</b> judul dengan kata <b>$kata</b></div>";
                echo "<h4 align=center>Manajemen Buku</h4>
  <hr>
  <a href='?modul=buku&act=tambahbuku'>
  <button class='btn btn-info' style='margin-left:10px;' type='button'>Tambah Buku</button></a>
  <hr>
        <table class='table table-hover table-striped'>  
		<thead>
          <tr><th width='50px'>No</th><th>Judul Buku</th><th>ISBN</th><th>Pengarang</th><th>Penerbit</th><th>Jumlah</th><th width='105px'>Pilihan</th></tr>
		</thead>";
                while ($r = mysqli_fetch_array($hasil)) {

                    echo "<tr><td>$no</td>
                <td>$r[judul]</td>
                <td>$r[isbn]</td>
                <td>$r[pengarang]</td>
				<td>$r[penerbit]</td>
                <td>$r[jumlah]</td>
				<td><a href=?modul=buku&act=edit&id=$r[id_buku]>
						<input type=button class='btn btn-success btn-mini' value='Edit'/>
					</a>
	                  <a href=$aksi?modul=buku&act=hapus&id=$r[id_buku]>
						<input type=button class='btn btn-danger btn-mini' value='Hapus'/>
					  </a>
		        </tr>";
                    $no++;
                }
            } else {
                echo "<div class='alert alert-error'>Tidak Ditemukan pencarian judul buku untuk kata <strong> $kata </strong>  <br> silakan masukan kata kembali  </div>";
            }

            break;

        case 'tambahbuku':
            echo "
  <h4 align=center>Tambah Buku</h4>
  <hr>
        <form class='form-horizontal' method=POST action='$aksi?modul=buku&act=input'>
		
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
         <tr><td>Judul Buku</td><td>:</td><td> <input class='input-xxlarge' type='text' name='judul' placeholder='Masukan Judul Buku'></td></tr>
		 <tr><td>ISBN</td><td>:</td><td> <input class='input-xxlarge' type='text' name='isbn' placeholder='Masukan ISBN Buku'></td></tr>
		 <tr><td>Pengarang</td><td>:</td><td> <input class='input-xxlarge' type='text' name='pengarang' placeholder='Masukan Pengarang Buku'></td></tr>
		 <tr><td>Penerbit</td><td>:</td><td> <input class='input-xxlarge' type='text' name='penerbit' placeholder='Masukan Penerbit Buku'></td></tr>
		 <tr><td>Jumlah</td><td>:</td><td> <input class='input-mini' type='text' name='jumlah' placeholder='Masukan Jumlah Buku'></td></tr>
         </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;

        case 'edit':
            $edit = mysqli_query(KONEKSI, "SELECT * FROM buku WHERE id_buku ='$_GET[id]'");

            $r = mysqli_fetch_array($edit);

            echo "
  <h4 align=center>Tambah Buku</h4>
  <hr>
        <form class='form-horizontal' method='POST' action='$aksi?modul=buku&act=update'>
		 <input type=hidden name=id value=$r[id_buku]>
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
         <tr><td>Judul Buku</td><td>:</td><td> <input class='input-xxlarge' type='text' value='$r[judul]' name='judul' placeholder='Masukan Judul Buku'></td></tr>
		 <tr><td>ISBN</td><td>:</td><td> <input class='input-xxlarge' type='text' name='isbn'  value='$r[isbn]' placeholder='Masukan ISBN Buku'></td></tr>
		 <tr><td>Pengarang</td><td>:</td><td> <input class='input-xxlarge' type='text' name='pengarang'  value='$r[pengarang]' placeholder='Masukan Pengarang Buku'></td></tr>
		 <tr><td>Penerbit</td><td>:</td><td> <input class='input-xxlarge' type='text' name='penerbit'  value='$r[penerbit]' placeholder='Masukan Penerbit Buku'></td></tr>
		 <tr><td>Jumlah</td><td>:</td><td> <input class='input-mini' type='text' name='jumlah'  value='$r[jumlah]' placeholder='Masukan Jumlah Buku'></td></tr>
         </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;
    }
}
