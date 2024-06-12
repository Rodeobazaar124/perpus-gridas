<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {
    $aksi = 'modul/pengarang/aksi_pengarang.php';
    switch ($_GET['act']) {
        default:
            echo "
   <div class='span12 kotak' >
  <h4 align=center>Referensi Pengarang</h4>
  <hr>
  <a href='?modul=pengarang&act=tambahpengarang'>
  <button class='btn btn-info' style='margin-left:10px;' type='button'>Tambah Pengarang</button></a>
  <hr>
        <table class='table table-hover table-striped'>  
		<thead>
          <tr><th width='50px'>No</th><th>Nama Pengarang</th><th width='105px'>Pilihan</th></tr>
		</thead>";
            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM refpengarang ORDER BY id_pengarang DESC');
            $no = $posisi + 1;
            while ($r = mysqli_fetch_array($tampil)) {

                echo "<tr><td>$no</td>
                <td>$r[nama_pengarang]</td>
                <td><a href=?modul=pengarang&act=edit&id=$r[id_pengarang]>
		    <input type=button class='btn btn-success btn-mini' value='Edit'/></a>
	                  <a href=$aksi?modul=pengarang&act=hapus&id=$r[id_pengarang]>
						<input type=button class='btn btn-danger btn-mini' value='Hapus'/>
					  </a>
		        </tr>";
                $no++;
            }

            break;

        case 'tambahpengarang':
            echo "
  <div class='span12 kotak' >
  <h4 align=center>Tambah Pengarang</h4>
  <hr>
        <form class='form-horizontal' method=POST action='$aksi?modul=pengarang&act=input'>
		
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
         <tr><td>Nama Pengarang</td><td>:</td><td> <input class='input-xxlarge' type='text' name='nama' placeholder='Masukan nama Pengarang'></td></tr>
		 
         </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;

        case 'edit':
            $edit = mysqli_query(KONEKSI, "SELECT * FROM refpengarang WHERE id_pengarang ='$_GET[id]'");

            $r = mysqli_fetch_array($edit);

            echo "
  <h4 align=center>Edit Pengarang</h4>
  <hr>
        <form class='form-horizontal' method='POST' action='$aksi?modul=pengarang&act=update'>
		 <input type=hidden name=id value=$r[id_pengarang]>
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
         <tr><td>Nama Pengarang</td><td>:</td><td> <input class='input-xxlarge' type='text' value='$r[nama_pengarang]' name='nama' ></td></tr>
		 </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;
    }
}
