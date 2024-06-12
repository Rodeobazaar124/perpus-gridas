<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {
    $aksi = 'modul/penerbit/aksi_penerbit.php';
    switch ($_GET['act']) {
        default:
            echo "
   <div class='span12 kotak' >
  <h4 align=center>Referensi Penerbit</h4>
  <hr>
  <a href='?modul=penerbit&act=tambahpenerbit'>
  <button class='btn btn-info' style='margin-left:10px;' type='button'>Tambah Penerbit</button></a>
  <hr>
        <table class='table table-hover table-striped'>  
		<thead>
          <tr><th width='50px'>No</th><th>Nama Penerbit</th><th>Alamat</th><th width='105px'>Pilihan</th></tr>
		</thead>";

            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM penerbit ORDER BY id_penerbit DESC ');

            $no = $posisi + 1;
            while ($r = mysqli_fetch_array($tampil)) {

                echo "<tr><td>$no</td>
                <td>$r[nama_penerbit]</td>
				<td>$r[alamat]</td>
                <td><a href=?modul=penerbit&act=edit&id=$r[id_penerbit]>
		    <input type=button class='btn btn-success btn-mini' value='Edit'/></a>
	                  <a href=$aksi?modul=penerbit&act=hapus&id=$r[id_penerbit]>
						<input type=button class='btn btn-danger btn-mini' value='Hapus'/>
					  </a>
		        </tr>";
                $no++;
            }

            break;

        case 'tambahpenerbit':
            echo "
  <div class='span12 kotak' >
  <h4 align=center>Tambah Penerbit</h4>
  <hr>
        <form class='form-horizontal' method=POST action='$aksi?modul=penerbit&act=input'>
		
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
         <tr><td>Nama Penerbit</td><td>:</td><td> <input class='input-xxlarge' type='text' name='nama' placeholder='Masukan nama penerbit'></td></tr>
		 <tr><td>Alamat Penerbit</td><td>:</td><td> <input class='input-xxlarge' type='text' name='alamat' placeholder='Masukan alamat penerbit'></td></tr>
		 
         </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;

        case 'edit':
            $edit = mysqli_query(KONEKSI, "SELECT * FROM penerbit WHERE id_penerbit ='$_GET[id]'");

            $r = mysqli_fetch_array($edit);

            echo "
		  <div class='span12 kotak' >
  <h4 align=center>Edit Penerbit</h4>
  <hr>
        <form class='form-horizontal' method='POST' action='$aksi?modul=penerbit&act=update'>
		 <input type=hidden name=id value=$r[id_penerbit]>
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
         <tr><td>Nama Penerbit</td><td>:</td><td> <input class='input-xxlarge' type='text' value='$r[nama_penerbit]' name='nama' ></td></tr>
		 <tr><td>Alamat Penerbit</td><td>:</td><td> <input class='input-xxlarge' type='text' value='$r[alamat]' name='alamat' ></td></tr>
		 </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;
    }
}
