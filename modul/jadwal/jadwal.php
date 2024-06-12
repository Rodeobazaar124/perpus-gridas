<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {
    $aksi = 'modul/jadwal/aksi_jadwal.php';
    switch ($_GET['act']) {
        default:
            echo "
   <div class='span12 kotak' >
  <h4 align=center>Manajemen Jadwal</h4>
  <hr>
  <a href='?modul=jadwal&act=tambahjadwal'>
  <button class='btn btn-info' style='margin-left:10px;' type='button'>Tambah Jadwal</button></a>
  <hr>
        <table class='table table-hover table-striped'>  
		<thead>
          <tr><th width='50px'>No</th><th>Hari</th><th>Jam Buka</th><th>Jam Tutup</th><th>Keterangan</th><th>Pilihan</th></tr>
		</thead>";

            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM jadwal ORDER BY id_jadwal DESC ');

            $no = $posisi + 1;
            while ($r = mysqli_fetch_array($tampil)) {

                echo "<tr><td>$no</td>
                <td>$r[hari]</td>
				<td>$r[jam_buka]</td>
				<td>$r[jam_tutup]</td>
				<td>$r[ket]</td>
                <td><a href=?modul=jadwal&act=edit&id=$r[id_jadwal]>
		    <input type=button class='btn btn-success btn-mini' value='Edit'/></a>
	                  <a href=$aksi?modul=jadwal&act=hapus&id=$r[id_jadwal]>
						<input type=button class='btn btn-danger btn-mini' value='Hapus'/>
					  </a>
		        </tr>";
                $no++;
            }

            break;

        case 'tambahjadwal':
            echo "
  <div class='span12 kotak' >
  <h4 align=center>Tambah Jadwal</h4>
  <hr>
        <form class='form-horizontal' method=POST action='$aksi?modul=jadwal&act=input'>
		
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
         <tr><td>Hari</td><td>:</td><td> <select name='hari'>
										<option value='SENIN'>SENIN</option>
										<option value='SELASA'>SELASA</option>
										<option value='RABU'>RABU</option>
										<option value='KAMIS'>KAMIS</option>
										<option value='JUMAT'>JUM'AT</option>
										<option value='SABTU'>SABTU</option>
										<option value='MINGGU'>MINGGU</option>
										</select></td></tr>
		 <tr><td>Jam Buka</td><td>:</td><td> <input class='input-xxlarge' type='text'  name='jam_buka' ></td></tr>		
			<tr><td>Jam Tutup</td><td>:</td><td> <input class='input-xxlarge' type='text'  name='jam_tutup' ></td></tr>				 
		  <tr><td>Keterangan</td><td>:</td><td> <input class='input-xxlarge' type='text'  name='ket' ></td></tr>		
         </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;

        case 'edit':
            $edit = mysqli_query(KONEKSI, "SELECT * FROM jadwal WHERE id_jadwal ='$_GET[id]'");

            $r = mysqli_fetch_array($edit);

            echo "
		  <div class='span12 kotak' >
  <h4 align=center>Edit Jadwal</h4>
  <hr>
        <form class='form-horizontal' method='POST' action='$aksi?modul=jadwal&act=update'>
		 <input type=hidden name=id value=$r[id_jadwal]>
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
         <tr><td>Hari</td><td>:</td><td> <select name='hari'>
										<option value='SENIN'>SENIN</option>
										<option value='SELASA'>SELASA</option>
										<option value='RABU'>RABU</option>
										<option value='KAMIS'>KAMIS</option>
										<option value='JUMAT'>JUM'AT</option>
										<option value='SABTU'>SABTU</option>
										<option value='MINGGU'>MINGGU</option>
										</select></td></tr>
		 <tr><td>Jam Buka</td><td>:</td><td> <input class='input-xxlarge' type='text' value='$r[jam_buka]' name='jam_buka' ></td></tr>		
			<tr><td>Jam Tutup</td><td>:</td><td> <input class='input-xxlarge' type='text' value='$r[jam_tutup]' name='jam_tutup' ></td></tr>				 
		  <tr><td>Keterangan</td><td>:</td><td> <input class='input-xxlarge' type='text' value='$r[ket]' name='ket' ></td></tr>		
         </table>
		 <input type=submit class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
    </form>";
            break;
    }
}
