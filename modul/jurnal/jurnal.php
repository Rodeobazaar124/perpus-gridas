<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {
    $aksi = 'modul/jurnal/aksi_jurnal.php';
    switch ($_GET['act']) {
        default:
            $p = new Paging();
            $batas = 10;
            $posisi = $p->cariPosisi($batas);
            echo "
   <div class='span12 kotak' >
  <h4 align=center>Manajemen Jurnal</h4>
  <hr>
  <a href='?modul=jurnal&act=tambahjurnal'>
  <button class='btn btn-info' style='margin-left:10px;' type='button'>Tambah Jurnal</button></a>
  <hr>
        <table class='table table-hover table-striped'>  
		<thead>
          <tr><th width='50px'>No</th><th>Judul Jurnal</th><th>Penulis</th><th>Tanggal Posting</th><th>Kategori</th><th>Status</th><th >Pilihan</th></tr>
		</thead>";

            $tampil = mysqli_query(KONEKSI, "SELECT * FROM jurnal,katjurnal WHERE katjurnal.id_kategori = jurnal.id_kategori ORDER BY id_jurnal DESC LIMIT $posisi,$batas");

            $no = $posisi + 1;
            while ($r = mysqli_fetch_array($tampil)) {

                echo "<tr><td>$no</td>
                <td>$r[judul]</td>
				<td>$r[penulis]</td>
                <td>$r[tgl_posting]</td>
                <td>$r[nama_kategori]</td>
				 <td>$r[status]</td>	
				<td>  <a href=?modul=jurnal&act=editjurnal&id=$r[id_jurnal]>
						<input type=button class='btn btn-primary btn-small' value='edit' Detail'/>
						</a>
										
					</a>
				      <a href='$aksi?modul=jurnal&act=hapus&id=$r[id_jurnal]&namafile=$r[file]'>
						<input type=button class='btn btn-danger btn-small' value='hapus'/>
					</a>
	             </td>
						
		        </tr>";
                $no++;
            }
            echo '</table>';
            $jmldata = mysqli_num_rows(mysqli_query(KONEKSI, 'SELECT * FROM jurnal '));

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

            break;

        case 'tambahjurnal':
            echo "
  <div class='span12 kotak' >
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

        case 'editjurnal':
            $edit = mysqli_query(KONEKSI, "SELECT * FROM jurnal WHERE id_jurnal ='$_GET[id]'");

            $r = mysqli_fetch_array($edit);

            echo "
		  <div class='span12 kotak' >
  <h4 align=center>Edit Buku</h4>
  <hr>
        <form class='form-horizontal' method='POST' action='$aksi?modul=jurnal&act=update' enctype='multipart/form-data'>
		 <input type=hidden name=id value=$r[id_jurnal]>
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
		 <tr><td>Judul</td><td>:</td><td> <input class='input-xxlarge' value='$r[judul]' type='text' name='judul' placeholder='Masukan Judul Jurnal'></td></tr>
         <tr><td>Penulis</td><td>:</td><td> <input class='input-xxlarge' type='text' value='$r[penulis]' name='penulis' placeholder='Masukan nama Penulis'></td></tr>
		
		   <tr ><td>Kategori</td>  <td>:</td><td>  <select name='kategori'>";

            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM katjurnal ORDER BY nama_kategori');
            if ($r['id_kategori'] == 0) {
                echo '<option value=0 selected>- Pilih Kategori -</option>';
            }

            while ($w = mysqli_fetch_array($tampil)) {
                if ($r['id_kategori'] == $w['id_kategori']) {
                    echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
                } else {
                    echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
                }
            }

            echo "</select></td></tr>
		 <tr><td>Nama File</td><td>:</td><td>$r[file] </td></tr>";
            if ($r['status'] == 'PUBLISH') {
                echo "<tr><td>Status</td> <td>:</td> <td> <input type=radio name='status' value='PUBLISH' checked>PUBLISH  
                                      <input type=radio name='status' value='NONPUBLISH'> NON PUBLISH</td></tr>";
            } else {
                echo "<tr><td>Status</td> <td>:</td> <td>  <input type=radio name='status' value='PUBLISH'>PUBLISH  
                                      <input type=radio name='status' value='NONPUBLISH' checked>NON PUBLISH</td></tr>";
            }
            echo "		
		<tr><td>File</td><td>:</td><td> <input type=file name='fupload' ></td></tr>
		 <tr><td>Abstrak</td><td>:</td><td> <textarea name='abstrak'>$r[abstrak]</textarea></td></tr>
	         
		 </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;

    }
}
