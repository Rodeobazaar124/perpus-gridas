<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {
    $aksi = 'modul/rak/aksi_rak.php';
    switch ($_GET['act']) {
        default:
            echo "
   <div class='span12 kotak' >
  <h4 align=center>Referensi Rak Buku</h4>
  <hr>
  <a href='?modul=rak&act=tambahrak'>
  <button class='btn btn-info' style='margin-left:10px;' type='button'>Tambah Rak</button></a>
  <hr>
        <table class='table table-hover table-striped'>  
		<thead>
          <tr><th width='50px'>No</th><th>Kode Rak</th><th width='105px'>Pilihan</th></tr>
		</thead>";

            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM tblrak ORDER BY id_rak DESC ');

            $no = $posisi + 1;
            while ($r = mysqli_fetch_array($tampil)) {

                echo "<tr><td>$no</td>
                <td>$r[koderak]</td>
                <td><a href=?modul=rak&act=edit&id=$r[id_rak]>
		    <input type=button class='btn btn-success btn-mini' value='Edit'/></a>
	                  <a href=$aksi?modul=rak&act=hapus&id=$r[id_rak]>
						<input type=button class='btn btn-danger btn-mini' value='Hapus'/>
					  </a>
		        </tr>";
                $no++;
            }

            break;

        case 'tambahrak':
            echo "
  <div class='span12 kotak' >
  <h4 align=center>Tambah Rak Buku</h4>
  <hr>
        <form class='form-horizontal' method=POST action='$aksi?modul=rak&act=input'>
		
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
         <tr><td>Kode Rak</td><td>:</td><td> <input class='input-xxlarge' type='text' name='rak' placeholder='Masukan nama Rak'></td></tr>
		 
         </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;

        case 'edit':
            $edit = mysqli_query(KONEKSI, "SELECT * FROM tblrak WHERE id_rak ='$_GET[id]'");

            $r = mysqli_fetch_array($edit);

            echo "
		  <div class='span12 kotak' >
  <h4 align=center>Edit Rak Buku</h4>
  <hr>
        <form class='form-horizontal' method='POST' action='$aksi?modul=rak&act=update'>
		 <input type=hidden name=id value=$r[id_rak]>
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
         <tr><td>Nama Rak</td><td>:</td><td> <input class='input-xxlarge' type='text' value='$r[koderak]' name='rak' ></td></tr>
		 </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;
    }
}
