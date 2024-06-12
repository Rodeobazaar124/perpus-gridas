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
            $p = new Paging();
            $batas = 10;
            $posisi = $p->cariPosisi($batas);
            echo "
  <div class='span12 kotak' >
  <h4 align=center>Manajemen Buku</h4>
  <hr>
  <div class='row'>
   <div class='span6'>
  <a href='?modul=buku&act=tambahbuku'>
  <button class='btn btn-info' style='margin-left:10px;' type='button'>Tambah Buku</button></a>               
                 </div>
  <div class='span6'>
  <form method=get action='$_SERVER[PHP_SELF]'>
          <input type=hidden name=modul value=buku>
          <div id=paging>Cari Judul Buku : <input type=text name='kata'> <input type=submit class='btn btn-warning' value=Cari></div>
          </form>
  </div>
</div>  
  <hr>";
            if (empty($_GET['kata'])) {
                echo "
        <table class='table table-hover table-striped'>  
		<thead>
          <tr><th width='50px'>No</th><th>Judul Buku</th><th>Kode Buku</th><th>ISBN</th><th>Pengarang</th><th>Penerbit</th><th>Jumlah</th><th>Tersedia</th><th >Pilihan</th></tr>
		</thead>";

                $tampil = mysqli_query(KONEKSI, "SELECT tblbuku.judul,tblbuku.isbn,tblbuku.kdbuku, tblbuku.id_buku, refpengarang.id_pengarang, penerbit.id_penerbit, 
							  refpengarang.nama_pengarang, penerbit.nama_penerbit,tblbuku.tersedia,
							tblbuku.jumlahbuku FROM tblbuku
							LEFT JOIN refpengarang 	ON refpengarang.id_pengarang = tblbuku.id_pengarang
							LEFT JOIN penerbit 	ON penerbit.id_penerbit = tblbuku.id_penerbit
							ORDER BY tblbuku.kdbuku DESC LIMIT $posisi,$batas ");

                $no = $posisi + 1;
                while ($r = mysqli_fetch_array($tampil)) {

                    echo "<tr><td>$no</td>
                <td>$r[judul]</td>
				<td>$r[kdbuku]</td>
                <td>$r[isbn]</td>
                <td>$r[nama_pengarang]</td>
				<td>$r[nama_penerbit]</td>
                <td>$r[jumlahbuku]</td>
				<td>$r[tersedia]</td>
				<td>  <a href=?modul=buku&act=view&id=$r[id_buku]>
						<input type=button class='btn btn-primary btn-small' value='view' Detail'/>
						</a>
										
					</a>
				      <a href=?modul=buku&act=edit&id=$r[id_buku]>
						<input type=button class='btn btn-info btn-small' value='edit'/>
					</a>
	                 
		        </tr>";
                    $no++;
                }
                echo '</table>';
                $jmldata = mysqli_num_rows(mysqli_query(KONEKSI, 'SELECT * FROM tblbuku '));

                $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
                $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

                echo "
	<div class='span3'></div>
	<div class='span6'>
	<div class='pagination'>
	<ul> $linkHalaman<ul></div>
	<div>
	<div class='span3'></div>
	";
            } else {
                echo "
        <table class='table table-hover table-striped'>  
		<thead>
          <tr><th width='50px'>No</th><th>Judul Buku</th><th>Kode Buku</th><th>ISBN</th><th>Pengarang</th><th>Penerbit</th><th>Jumlah</th><th>Tersedia</th><th >Pilihan</th></tr>
		</thead>";

                $tampil = mysqli_query(KONEKSI, "SELECT tblbuku.judul,tblbuku.isbn,tblbuku.kdbuku, tblbuku.id_buku, refpengarang.id_pengarang, penerbit.id_penerbit, 
							  refpengarang.nama_pengarang, penerbit.nama_penerbit,tblbuku.tersedia,
							tblbuku.jumlahbuku FROM tblbuku
							LEFT JOIN refpengarang 	ON refpengarang.id_pengarang = tblbuku.id_pengarang
							LEFT JOIN penerbit 	ON penerbit.id_penerbit = tblbuku.id_penerbit
							WHERE tblbuku.judul LIKE '%$_GET[kata]%' 
							ORDER BY tblbuku.kdbuku DESC LIMIT $posisi,$batas ");

                $no = $posisi + 1;
                while ($r = mysqli_fetch_array($tampil)) {

                    echo "<tr><td>$no</td>
                <td>$r[judul]</td>
				<td>$r[kdbuku]</td>
                <td>$r[isbn]</td>
                <td>$r[nama_pengarang]</td>
				<td>$r[nama_penerbit]</td>
                <td>$r[jumlahbuku]</td>
				<td>$r[tersedia]</td>
				<td>  <a href=?modul=buku&act=view&id=$r[id_buku]>
						<input type=button class='btn btn-primary btn-small' value='view' Detail'/>
						</a>
										
					</a>
				      <a href=?modul=buku&act=edit&id=$r[id_buku]>
						<input type=button class='btn btn-info btn-small' value='edit'/>
					</a>
	                 
		        </tr>";
                    $no++;
                }
                echo '</table>';
                $jmldata = mysqli_num_rows(mysqli_query(KONEKSI, "SELECT * FROM tblbuku  WHERE judul LIKE '%$_GET[kata]%'  "));

                $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
                $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

                echo "
	<div class='span3'></div>
	<div class='span6'>
	<div class='pagination'>
	<ul> $linkHalaman<ul></div>
	<div>
	<div class='span3'></div>
	";

            }

            break;

        case 'tambahbuku':
            echo "
  <div class='span12 kotak' >
  <h4 align=center>Tambah Buku</h4>
  <hr>
        <form class='form-horizontal' method=POST action='$aksi?modul=buku&act=input' enctype='multipart/form-data'>
		
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
		 <tr><td>Kode Buku</td><td>:</td><td> <input class='input-mini' type='text' name='kode' placeholder='Masukan Kode Buku'></td></tr>
         <tr><td>Judul Buku</td><td>:</td><td> <input class='input-xxlarge' type='text' name='judul' placeholder='Masukan Judul Buku'></td></tr>
		 <tr><td>Judul Seri</td><td>:</td><td> <input class='input-xxlarge' type='text' name='judulseri' placeholder='Masukan Judul Seri'></td></tr>
		
		 <tr><td>ISBN</td><td>:</td><td> <input class='input-xxlarge' type='text' name='isbn' placeholder='Masukan ISBN Buku'></td></tr>
		 <tr><td>Pengarang</td><td>:</td><td> 
		 <select name='pengarang' id='cmb_pengarang' class='form-control' >
            <option value=0 selected>- Pilih Pengarang -</option>";
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM refpengarang ORDER BY nama_pengarang ');
            while ($r = mysqli_fetch_array($tampil)) {
                echo "<option value=$r[id_pengarang]>$r[nama_pengarang]</option>";
            }
            echo "	
		<input id='btn_new_peng' type=button class='btn btn-success btn-mini' value='Baru' onclick='showNewPeng()'>
		<input class='input' type='text' id='new_peng' name='new_peng' placeholder='Nama pengarang' style='display:none'>
		<input id='btn_save_new_peng' type=button class='btn btn-primary' value='Tambahkan' style='display:none' onclick='saveNewPeng()'>
		<input type=button id='btn_cancel_new_peng' class='btn btn-warning' value='Batal' style='display:none' onclick='cancelNewPeng()'>
		 </td>
		 </tr>
		 <tr><td>Penerbit</td><td>:</td><td>
		 <select id='cmb_penerbit' name='penerbit' class='form-control' >
            <option value=0 selected>- Pilih Penerbit -</option>";
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM penerbit ORDER BY nama_penerbit ');
            while ($r = mysqli_fetch_array($tampil)) {
                echo "<option value=$r[id_penerbit]>$r[nama_penerbit]</option>";
            }
            echo "
		<input id='btn_new_penerbit' type=button class='btn btn-success btn-mini' value='Baru' onclick='showNewPenerbit()'>
		<input class='input' type='text' id='new_penerbit' name='new_penerbit' placeholder='Penerbit' style='display:none'>
		<input class='input' type='text' id='new_alamat_penerbit' name='new_alamat_penerbit' placeholder='Alamat' style='display:none'>
		<input id='btn_save_new_penerbit' type=button class='btn btn-primary' value='Tambahkan' style='display:none' onclick='saveNewPenerbit()'>
		<input type=button id='btn_cancel_new_penerbit' class='btn btn-warning' value='Batal' style='display:none' onclick='cancelNewPenerbit()'>
		 </td></tr>
		 
		 <tr><td>Kolasi</td><td>:</td><td> <input class='input-xxlarge' type='text' name='kolasi' placeholder='Masukan kolasi Buku'></td></tr>
		 <tr><td>Subjek</td><td>:</td><td>
		 <select id='cmb_sub' name='subjek' class='form-control' >
            <option value=0 selected>- Pilih subjek -</option>";
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM refsubjek ORDER BY nama_subjek ');
            while ($r = mysqli_fetch_array($tampil)) {
                echo "<option value=$r[id_subjek]>$r[nama_subjek]</option>";
            }
            echo "
		<input id='btn_new_sub' type=button class='btn btn-success btn-mini' value='Baru' onclick='showNewSub()'>
		<input class='input' type='text' id='new_sub' name='new_sub' placeholder='Subjek' style='display:none'>
		<input id='btn_save_new_sub' type=button class='btn btn-primary' value='Tambahkan' style='display:none' onclick='saveNewSub()'>
		<input type=button id='btn_cancel_new_sub' class='btn btn-warning' value='Batal' style='display:none' onclick='cancelNewSub()'>
		 </td></tr>
		  <tr><td>Kategori</td><td>:</td><td>
		 <select id='cmb_kat' name='kategori' class='form-control' >
            <option value=0 selected>- Pilih Kategori -</option>";
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM refkategori ORDER BY nama_kategori ');
            while ($r = mysqli_fetch_array($tampil)) {
                echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
            echo "
		<input id='btn_new_kat' type=button class='btn btn-success btn-mini' value='Baru' onclick='showNewKat()'>
		<input class='input' type='text' id='new_kat' name='new_kat' placeholder='Kategori' style='display:none'>
		<input id='btn_save_new_kat' type=button class='btn btn-primary' value='Tambahkan' style='display:none' onclick='saveNewKat()'>
		<input type=button id='btn_cancel_new_kat' class='btn btn-warning' value='Batal' style='display:none' onclick='cancelNewKat()'>
		 </td></tr>
		 
		  <tr><td>Klasifikasi</td><td>:</td><td>
		 <select id='cmb_klas' name='klasifikasi' class='form-control' >
            <option value=0 selected>- Pilih Klasifikasi -</option>";
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM refklasifikasi ORDER BY nama_klasifikasi ');
            while ($r = mysqli_fetch_array($tampil)) {
                echo "<option value=$r[id_klasifikasi]>$r[nama_klasifikasi]</option>";
            }
            echo "
		<input id='btn_new_klas' type=button class='btn btn-success btn-mini' value='Baru' onclick='showNewKlas()'>
		<input class='input' type='text' id='new_klas' name='new_klas' placeholder='Klasifikasi' style='display:none'>
		<input id='btn_save_new_klas' type=button class='btn btn-primary' value='Tambahkan' style='display:none' onclick='saveNewKlas()'>
		<input type=button id='btn_cancel_new_klas' class='btn btn-warning' value='Batal' style='display:none' onclick='cancelNewKlas()'>
		 </td></tr>
		 <tr><td>Rak Penyimpanan</td><td>:</td><td>
		 <select id='cmb_rak' name='rak' class='form-control' >
            <option value=0 selected>- Pilih rak -</option>";
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM tblrak ORDER BY koderak ');
            while ($r = mysqli_fetch_array($tampil)) {
                echo "<option value=$r[id_rak]>$r[koderak]</option>";
            }
            echo "
		<input id='btn_new_rak' type=button class='btn btn-success btn-mini' value='Baru' onclick='showNewRak()'>
		<input class='input' type='text' id='new_rak' name='new_rak' placeholder='Kode Rak' style='display:none'>
		<input id='btn_save_new_rak' type=button class='btn btn-primary' value='Tambahkan' style='display:none' onclick='saveNewRak()'>
		<input type=button id='btn_cancel_new_rak' class='btn btn-warning' value='Batal' style='display:none' onclick='cancelNewRak()'>
		 </td></tr>
		 
		  <tr><td>Tahun Terbit</td><td>:</td><td> <input class='input-mini' type='text' name='tahun' placeholder='Masukan Tahun Terbit'></td></tr>
		  <tr><td>Asal Pengadaan</td><td>:</td><td> <input class='input-xxlarge' type='text' name='asal' placeholder='Masukan Asal Pengadaan'></td></tr>
		 <tr><td>Edisi Buku</td><td>:</td><td> <input class='input-xxlarge' type='text' name='edisi' placeholder='Masukan Edisi Buku'></td></tr>
		 <tr><td>Abstraksi</td><td>:</td><td> <textarea name='abstraksi'></textarea></td></tr>
        <tr><td>Biblio</td><td>:</td><td> <input class='input-xxlarge' type='text' name='biblio' placeholder='Masukan biblio Buku'></td></tr>
		<tr><td>Bahasa</td><td>:</td><td> <input class='input-xxlarge' type='text' name='bahasa' placeholder='Masukan Bahasa Buku'></td></tr>		
		<tr><td>Kota Terbit</td><td>:</td><td> <input class='input-xxlarge' type='text' name='kota' placeholder='Masukan kota Buku'></td></tr
		 <tr><td>Gambar Sampul</td><td>:</td><td> <input type=file name='fupload' ></td></tr>
		 <tr><td>Keterangan</td><td>:</td><td> <textarea name='keterangan'></textarea></td></tr>
		 <tr><td>Jumlah</td><td>:</td><td> <input class='input-mini' type='text' name='jumlah' placeholder='Masukan Jumlah Buku'></td></tr>
         
		 </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;

        case 'edit':
            $edit = mysqli_query(KONEKSI, "SELECT tblbuku.*, refpengarang.id_pengarang, penerbit.id_penerbit, 
							  refpengarang.nama_pengarang, penerbit.nama_penerbit,tblbuku.tersedia,
							  refkategori.nama_kategori,refkategori.id_kategori,
							  tblrak.*,tblrak.* FROM tblbuku
							LEFT JOIN refpengarang 	ON refpengarang.id_pengarang = tblbuku.id_pengarang
							LEFT JOIN penerbit 	ON penerbit.id_penerbit = tblbuku.id_penerbit
							LEFT JOIN refklasifikasi 	ON refklasifikasi.id_klasifikasi = tblbuku.id_klasifikasi
							LEFT JOIN refkategori 	ON refkategori.id_kategori = tblbuku.id_kategori
							LEFT JOIN tblrak 	ON tblrak.id_rak = tblbuku.id_rak
						     WHERE tblbuku.id_buku = '$_GET[id]'");

            $r = mysqli_fetch_array($edit);

            echo "
		  <div class='span12 kotak' >
  <h4 align=center>Edit Buku</h4>
  <hr>
        <form class='form-horizontal' method='POST' action='$aksi?modul=buku&act=update' enctype='multipart/form-data'>
		 <input type=hidden name=id value=$r[id_buku]>
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
         		 <tr><td>Kode Buku</td><td>:</td><td> <input class='input-mini' type='text' name='kode' value='$r[kdbuku]' placeholder='Masukan Kode Buku'></td></tr>
         <tr><td>Judul Buku</td><td>:</td><td> <input class='input-xxlarge' type='text' name='judul' value='$r[judul]' placeholder='Masukan Judul Buku'></td></tr>
		 <tr><td>Judul Seri</td><td>:</td><td> <input class='input-xxlarge' type='text' name='judulseri' value='$r[jdlseri]' placeholder='Masukan Judul Seri'></td></tr>
		
		 <tr><td>ISBN</td><td>:</td><td> <input class='input-xxlarge' value='$r[isbn]' type='text' value='$r[isbn]' name='isbn' placeholder='Masukan ISBN Buku'></td></tr>
		 <tr><td>Pengarang</td><td>:</td><td> ";
            echo "<select name='pengarang'>";
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM refpengarang ORDER BY nama_pengarang');
            if ($r['id_pengarang'] == 0) {
                echo '<option value=0 selected>- Pilih pengarang -</option>';
            }

            while ($w = mysqli_fetch_array($tampil)) {
                if ($r['id_pengarang'] == $w['id_pengarang']) {
                    echo "<option value=$w[id_pengarang] selected>$w[nama_pengarang]</option>";
                } else {
                    echo "<option value=$w[id_pengarang]>$w[nama_pengarang]</option>";
                }
            }

            echo '</select></td></tr>
		 <tr><td>Penerbit</td><td>:</td><td>';
            echo "<select name='penerbit'>";
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM penerbit ORDER BY nama_penerbit');
            if ($r['id_penerbit'] == 0) {
                echo '<option value=0 selected>- Pilih penerbit -</option>';
            }

            while ($w = mysqli_fetch_array($tampil)) {
                if ($r['id_penerbit'] == $w['id_penerbit']) {
                    echo "<option value=$w[id_penerbit] selected>$w[nama_penerbit]</option>";
                } else {
                    echo "<option value=$w[id_penerbit]>$w[nama_penerbit]</option>";
                }
            }

            echo "</select></td></tr>
		 
		 <tr><td>Kolasi</td><td>:</td><td> <input class='input-xxlarge' type='text' value='$r[kolasi]' name='kolasi' placeholder='Masukan kolasi Buku'></td></tr>
		 <tr><td>Subjek</td><td>:</td><td>";
            echo "<select name='subjek'>";
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM refsubjek ORDER BY nama_subjek');
            if ($r['id_subjek'] == 0) {
                echo '<option value=0 selected>- Pilih Subjek -</option>';
            }

            while ($w = mysqli_fetch_array($tampil)) {
                if ($r['id_subjek'] == $w['id_subjek']) {
                    echo "<option value=$w[id_subjek] selected>$w[nama_subjek]</option>";
                } else {
                    echo "<option value=$w[id_subjek]>$w[nama_subjek]</option>";
                }
            }

            echo '</select></td></tr>
		  <tr><td>Kategori</td><td>:</td><td>';
            echo "<select name='kategori'>";
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM refkategori ORDER BY nama_kategori');
            if ($r['id_kategori'] == 0) {
                echo '<option value=0 selected>- Pilih kategori -</option>';
            }

            while ($w = mysqli_fetch_array($tampil)) {
                if ($r['id_kategori'] == $w['id_kategori']) {
                    echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
                } else {
                    echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
                }
            }

            echo '</select></td></tr>
		 
		  <tr><td>Klasifikasi</td><td>:</td><td>';
            echo "<select name='klasifikasi'>";
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM refklasifikasi ORDER BY nama_klasifikasi');
            if ($r['id_klasifikasi'] == 0) {
                echo '<option value=0 selected>- Pilih Klasifikasi -</option>';
            }

            while ($w = mysqli_fetch_array($tampil)) {
                if ($r['id_klasifikasi'] == $w['id_klasifikasi']) {
                    echo "<option value=$w[id_klasifikasi] selected>$w[nama_klasifikasi]</option>";
                } else {
                    echo "<option value=$w[id_klasifikasi]>$w[nama_klasifikasi]</option>";
                }
            }

            echo "</select name='rak'></td></tr>
		 <tr><td>Rak Penyimpanan</td><td>:</td><td>";
            echo '<select>';
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM tblrak ORDER BY koderak');
            if ($r['id_rak'] == 0) {
                echo '<option value=0 selected>- Pilih rak -</option>';
            }

            while ($w = mysqli_fetch_array($tampil)) {
                if ($r['id_rak'] == $w['id_rak']) {
                    echo "<option value=$w[id_rak] selected>$w[koderak]</option>";
                } else {
                    echo "<option value=$w[id_rak]>$w[koderak]</option>";
                }
            }

            echo "</select></td></tr>
		 
		  <tr><td>Tahun Terbit</td><td>:</td><td> <input class='input-mini' type='text'  value='$r[tahun]' name='tahun' placeholder='Masukan Tahun Terbit'></td></tr>
		  <tr><td>Asal Pengadaan</td><td>:</td><td> <input class='input-xxlarge' type='text'  value='$r[asal]' name='asal' placeholder='Masukan Asal Pengadaan'></td></tr>
		 <tr><td>Edisi Buku</td><td>:</td><td> <input class='input-xxlarge' type='text'  value='$r[edisi]' name='edisi' placeholder='Masukan Edisi Buku'></td></tr>
		 <tr><td>Abstraksi</td><td>:</td><td> <textarea name='abstraksi'>$r[abstraksi]</textarea></td></tr>
        <tr><td>Biblio</td><td>:</td><td> <input class='input-xxlarge'  value='$r[biblio]' type='text' name='biblio' placeholder='Masukan biblio Buku'></td></tr>
		<tr><td>Bahasa</td><td>:</td><td> <input class='input-xxlarge'  value='$r[bahasa]' type='text' name='bahasa' placeholder='Masukan Bahasa Buku'></td></tr>		
		<tr><td>Kota Terbit</td><td>:</td><td> <input class='input-xxlarge' type='text'  value='$r[kota]' name='kota' placeholder='Masukan kota Buku'></td></tr
		 <tr><td>Gambar Sampul</td><td>:</td><td> <input type=file name='fupload' ></td></tr>
		 <tr><td>Keterangan</td><td>:</td><td> <textarea name='keterangan'> $r[keterangan]</textarea></td></tr>
		 <tr><td>Jumlah</td><td>:</td><td> <input class='input-mini' type='text'  value='$r[jumlahbuku]' name='jumlah' placeholder='Masukan Jumlah Buku'></td></tr>
         </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;

        case 'view':
            $edit = mysqli_query(KONEKSI, "SELECT tblbuku.*, refpengarang.id_pengarang, penerbit.id_penerbit, 
							  refpengarang.nama_pengarang, penerbit.nama_penerbit,tblbuku.tersedia,
							  refkategori.nama_kategori,refkategori.id_kategori,
							  tblrak.*,tblrak.* FROM tblbuku
							LEFT JOIN refpengarang 	ON refpengarang.id_pengarang = tblbuku.id_pengarang
							LEFT JOIN penerbit 	ON penerbit.id_penerbit = tblbuku.id_penerbit
							LEFT JOIN refklasifikasi 	ON refklasifikasi.id_klasifikasi = tblbuku.id_klasifikasi
							LEFT JOIN refkategori 	ON refkategori.id_kategori = tblbuku.id_kategori
							LEFT JOIN tblrak 	ON tblrak.id_rak = tblbuku.id_rak
						     WHERE tblbuku.id_buku = '$_GET[id]'
   	");

            $r = mysqli_fetch_array($edit);

            echo "
		   <div class='span12 kotak' >
  <h4 align=center>Detail Buku</h4>
  <hr>
       
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
         <tr><td>Kode Buku</td><td>:</td><td> <strong>$r[kdbuku] </strong></td></tr>
         <tr><td>Judul Buku</td><td>:</td><td> <strong>$r[judul]</strong></td></tr>
		 <tr><td>Judul Seri</td><td>:</td><td> <strong>$r[jdlseri]</strong></td></tr>
		 <tr><td>ISBN</td><td>:</td><td> <strong>$r[isbn]</strong></td></tr>
		 <tr><td>Pengarang</td><td>:</td><td>  <strong>$r[nama_pengarang]</strong></td></tr>
		 <tr><td>Penerbit</td><td>:</td><td> <strong>$r[nama_penerbit]</strong></td></tr>
		 <tr><td>Kolasi</td><td>:</td><td> <strong>$r[kolasi]</strong></td></tr>
		 <tr><td>Subjek</td><td>:</td><td> <strong>$r[nama_subjek]</strong></td></tr>
		  <tr><td>Kategori</td><td>:</td><td> <strong>$r[nama_kategori]</strong></td></tr>
		 <tr><td>Klasifikasi</td><td>:</td><td> <strong>$r[nama_klasifikasi]</strong> </td></tr>
		 <tr><td>Rak Penyimpanan</td><td>:</td><td> <strong>$r[koderak]</strong></td></tr>
		 <tr><td>Tahun Terbit</td><td>:</td><td> <strong>$r[tahun]</strong></td></tr>
		  <tr><td>Asal Pengadaan</td><td>:</td><td> <strong>$r[asal]</strong></td></tr>
		 <tr><td>Edisi Buku</td><td>:</td><td> <strong>$r[edisi]</strong></td></tr>
		 <tr><td>Abstraksi</td><td>:</td><td> <strong>$r[abstraksi]</strong></td></tr>
        <tr><td>Biblio</td><td>:</td><td> <strong>$r[biblio]</strong></td></tr>
		<tr><td>Bahasa</td><td>:</td><td> <strong>$r[bahasa]</strong></td></tr>		
		<tr><td>Kota Terbit</td><td>:</td><td> <strong>$r[kota]</strong></td></tr
		 <tr><td>Keterangan</td><td>:</td><td> <strong>$r[keterangan] </strong></td></tr>
		 <tr><td>Jumlah</td><td>:</td><td> <strong>$r[jumlahbuku]</strong></td></tr>
         </table>
		 <div class=span4>
		 </div>
		 <div class=span4>
		 <form method='POST' action='$aksi?modul=buku&act=hapus'>
		  <input type=hidden name=kode value=$r[kdbuku]>
	
		 <input type=submit class='btn btn-danger' style='margin-left:350px;' value='Hapus'>
       </form>
	   </div>
	    <div class=span2>
	       <form method='POST' action='cetakbarcode.php'>
		    
		 <input type=hidden name=kode value=$r[kdbuku]>
		  
		<input type=submit class='btn btn-primary' style='margin-left:100px;' value='Cetak Barcode'>
    </form>
	</div>";
            break;

    }
}
?>
<script>
	// pengarang
	function showNewPeng(){
		$('#new_peng').val("");
		$('#btn_new_peng').hide();
		$('#new_peng').show();
		$('#btn_save_new_peng').show();
		$('#btn_cancel_new_peng').show();
	}
	function saveNewPeng(){
		var nama_pengarang = $('#new_peng').val();
		if (nama_pengarang!=""){
			$.post('modul/buku/post_buku.php',{'act' : 'new_peng','nama_pengarang' : nama_pengarang},function(result)
				{
					$('#cmb_pengarang').html(result);
				}
			);
			$('#btn_new_peng').show();
			$('#new_peng').hide();
			$('#btn_save_new_peng').hide();
			$('#btn_cancel_new_peng').hide();
		}
		else{
			alert('Silahkan isi nama pengarang')
		}
	}
	function cancelNewPeng(){
		$('#btn_new_peng').show();
		$('#new_peng').hide();
		$('#btn_save_new_peng').hide();
		$('#btn_cancel_new_peng').hide();
	}
	
	//penerbit
	function showNewPenerbit(){
		$('#new_penerbit').val("");
		$('#new_alamat_penerbit').val("");
		$('#btn_new_penerbit').hide();
		$('#new_penerbit').show();
		$('#new_alamat_penerbit').show();
		$('#btn_save_new_penerbit').show();
		$('#btn_cancel_new_penerbit').show();
	}
	function saveNewPenerbit(){
		var nama_penerbit = $('#new_penerbit').val();
		var alamat = $('#new_alamat_penerbit').val();
		if (nama_penerbit!="" && alamat!=""){
			$.post('modul/buku/post_buku.php',{'act' : 'new_penerbit','nama_penerbit' : nama_penerbit, 'alamat' : alamat},function(result)
				{
					$('#cmb_penerbit').html(result);
				}
			);
			$('#btn_new_penerbit').show();
			$('#new_penerbit').hide();
			$('#new_alamat_penerbit').hide();
			$('#btn_save_new_penerbit').hide();
			$('#btn_cancel_new_penerbit').hide();
		}
		else{
			alert('Silahkan isi data penerbit')
		}
	}
	function cancelNewPenerbit(){
		$('#btn_new_penerbit').show();
		$('#new_penerbit').hide();
		$('#new_alamat_penerbit').hide();
		$('#btn_save_new_penerbit').hide();
		$('#btn_cancel_new_penerbit').hide();
	}
	
	//subjek
	function showNewSub(){
		$('#new_sub').val("");
		$('#btn_new_sub').hide();
		$('#new_sub').show();
		$('#btn_save_new_sub').show();
		$('#btn_cancel_new_sub').show();
	}
	function saveNewSub(){
		var nama_subjek = $('#new_sub').val();
		if (nama_subjek!=""){
			$.post('modul/buku/post_buku.php',{'act' : 'new_sub','nama_subjek' : nama_subjek},function(result)
				{
					$('#cmb_sub').html(result);
				}
			);
			$('#btn_new_sub').show();
			$('#new_sub').hide();
			$('#btn_save_new_sub').hide();
			$('#btn_cancel_new_sub').hide();
		}
		else{
			alert('Silahkan isi Subjek')
		}
	}
	function cancelNewSub(){
		$('#btn_new_sub').show();
		$('#new_sub').hide();
		$('#btn_save_new_sub').hide();
		$('#btn_cancel_new_sub').hide();
	}
	
	//kategori
	function showNewKat(){
		$('#new_kat').val("");
		$('#btn_new_kat').hide();
		$('#new_kat').show();
		$('#btn_save_new_kat').show();
		$('#btn_cancel_new_kat').show();
	}
	function saveNewKat(){
		var nama_kategori = $('#new_kat').val();
		if (nama_kategori!=""){
			$.post('modul/buku/post_buku.php',{'act' : 'new_kat','nama_kategori' : nama_kategori},function(result)
				{
					$('#cmb_kat').html(result);
				}
			);
			$('#btn_new_kat').show();
			$('#new_kat').hide();
			$('#btn_save_new_kat').hide();
			$('#btn_cancel_new_kat').hide();
		}
		else{
			alert('Silahkan isi Kategori')
		}
	}
	function cancelNewKat(){
		$('#btn_new_kat').show();
		$('#new_kat').hide();
		$('#btn_save_new_kat').hide();
		$('#btn_cancel_new_kat').hide();
	}
	
	//klasifikasi
	function showNewKlas(){
		$('#new_klas').val("");
		$('#btn_new_klas').hide();
		$('#new_klas').show();
		$('#btn_save_new_klas').show();
		$('#btn_cancel_new_klas').show();
	}
	function saveNewKlas(){
		var nama_klasifikasi = $('#new_klas').val();
		if (nama_klasifikasi!=""){
			$.post('modul/buku/post_buku.php',{'act' : 'new_klas','nama_klasifikasi' : nama_klasifikasi},function(result)
				{
					$('#cmb_klas').html(result);
				}
			);
			$('#btn_new_klas').show();
			$('#new_klas').hide();
			$('#btn_save_new_klas').hide();
			$('#btn_cancel_new_klas').hide();
		}
		else{
			alert('Silahkan isi klasifikasi')
		}
	}
	function cancelNewKlas(){
		$('#btn_new_klas').show();
		$('#new_klas').hide();
		$('#btn_save_new_klas').hide();
		$('#btn_cancel_new_klas').hide();
	}
	
	//rak
	function showNewRak(){
		$('#new_rak').val("");
		$('#btn_new_rak').hide();
		$('#new_rak').show();
		$('#btn_save_new_rak').show();
		$('#btn_cancel_new_rak').show();
	}
	function saveNewRak(){
		var koderak = $('#new_rak').val();
		if (koderak!=""){
			$.post('modul/buku/post_buku.php',{'act' : 'new_rak','koderak' : koderak},function(result)
				{
					$('#cmb_rak').html(result);
				}
			);
			$('#btn_new_rak').show();
			$('#new_rak').hide();
			$('#btn_save_new_rak').hide();
			$('#btn_cancel_new_rak').hide();
		}
		else{
			alert('Silahkan isi Kode Rak')
		}
	}
	function cancelNewRak(){
		$('#btn_new_rak').show();
		$('#new_rak').hide();
		$('#btn_save_new_rak').hide();
		$('#btn_cancel_new_rak').hide();
	}
</script>
