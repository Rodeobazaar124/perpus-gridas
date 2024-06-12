<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {
    $aksi = 'modul/klasifikasi/aksi_klasifikasi.php';
    switch ($_GET['act']) {
        default:
            echo "
   <div class='span12 kotak' >
  <h4 align=center>Referensi klasifikasi</h4>
  <hr>
  <a href='?modul=klasifikasi&act=tambahklasifikasi'>
  <button class='btn btn-info' style='margin-left:10px;' type='button'>Tambah klasifikasi</button></a>
  <hr>
        <table class='table table-hover table-striped'>  
		<thead>
          <tr><th width='50px'>No</th><th>klasifikasi</th><th width='105px'>Pilihan</th></tr>
		</thead>";

            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM refklasifikasi ORDER BY id_klasifikasi DESC ');

            $no = $posisi + 1;
            while ($r = mysqli_fetch_array($tampil)) {

                echo "<tr><td>$no</td>
                <td>$r[nama_klasifikasi]</td>
                <td><a href=?modul=klasifikasi&act=edit&id=$r[id_klasifikasi]>
		    <input type=button class='btn btn-success btn-mini' value='Edit'/></a>
	                  <a href=$aksi?modul=klasifikasi&act=hapus&id=$r[id_klasifikasi]>
						<input type=button class='btn btn-danger btn-mini' value='Hapus'/>
					  </a>
		        </tr>";
                $no++;
            }

            break;

        case 'tambahklasifikasi':
            echo "
  <div class='span12 kotak' >
  <h4 align=center>Tambah klasifikasi</h4>
  <hr>
        <form class='form-horizontal' method=POST action='$aksi?modul=klasifikasi&act=input'>
		
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
         <tr><td>Nama klasifikasi</td><td>:</td><td> <input class='input-xxlarge' type='text' name='nama' placeholder='Masukan nama klasifikasi'></td></tr>
		 
         </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;

        case 'edit':
            $edit = mysqli_query(KONEKSI, "SELECT * FROM refklasifikasi WHERE id_klasifikasi ='$_GET[id]'");

            $r = mysqli_fetch_array($edit);

            echo "
		  <div class='span12 kotak' >
  <h4 align=center>Edit klasifikasi</h4>
  <hr>
        <form class='form-horizontal' method='POST' action='$aksi?modul=klasifikasi&act=update'>
		 <input type=hidden name=id value=$r[id_klasifikasi]>
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
         <tr><td>Nama klasifikasi</td><td>:</td><td> <input class='input-xxlarge' type='text' value='$r[nama_klasifikasi]' name='nama' ></td></tr>
		 </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;
    }
}
