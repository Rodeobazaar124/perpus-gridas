<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {

    $aksi = 'modul/anggota/aksi_anggota.php';
    switch ($_GET['act']) {
        // Tampil User
        default:

            echo "
	  <div class='span12 kotak' >
	  <h4 align=center>Manajemen Anggota  </h4>
	  <hr>
	   <div class='row'>
       <div class='span6'>
          <input  class='btn btn-info' style='margin-left:10px;' type=button  value='Tambah Anggota' onclick=\"window.location.href='?modul=anggota&act=tambahanggota';\">
       </div>
	   <div class='span6'>
	   <form method=get action='$_SERVER[PHP_SELF]'>
          <input type=hidden name=modul value=anggota>
          <div id=paging>Cari Nama Anggota  : <input type=text name='kata'> <input type=submit class='btn btn-warning' value=Cari></div>
          </form>
	   </div>
	   </div>
	   <hr>";
            if (empty($_GET['kata'])) {
                $p = new Paging();
                $batas = 20;
                $posisi = $p->cariPosisi($batas);
                $tampil = mysqli_query(KONEKSI, "SELECT * FROM anggota ORDER BY id DESC LIMIT $posisi,$batas");
                echo "<table class='table table-hover table-striped'>
          <tr><th>no</th><th>No. Anggota</th><th>Nama Lengkap</th><th>Jenis Kelamin</th><th>No. Telp</th><th>Status</th><th>Aksi</th></tr>";
                $no = 1;
                while ($r = mysqli_fetch_array($tampil)) {
                    echo "<tr><td>$no</td>
             <td>$r[noanggota]</td>
             <td>$r[nama]</td>
			  <td>$r[jenis]</td>
			   <td>$r[notelp]</td>
			   <td>$r[status]</td>
             <td>
			  <a href='cetakanggota.php?id=$r[id]'>
						<input type=button class='btn btn-warning btn-mini' value='cetak'/>
					  </a>
			 <a href=?modul=anggota&act=edit&id=$r[id]>
						<input type=button class='btn btn-success btn-mini' value='Edit'/>
					</a>
	                  <a href=$aksi?modul=anggota&act=hapus&id=$r[id]>
						<input type=button class='btn btn-danger btn-mini' value='Hapus'/>
					  </a>
					  
			 </td></tr>";
                    $no++;
                }
                echo '</table>';
                $jmldata = mysqli_num_rows(mysqli_query(KONEKSI, 'SELECT * FROM anggota '));

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
                $p = new Paging();
                $batas = 20;
                $posisi = $p->cariPosisi($batas);
                $tampil = mysqli_query(KONEKSI, "SELECT * FROM anggota WHERE nama LIKE '%$_GET[kata]%'  ORDER BY id DESC LIMIT $posisi,$batas");
                echo "<table class='table table-hover table-striped'>
          <tr><th>no</th><th>No. Anggota</th><th>Nama Lengkap</th><th>Jenis Kelamin</th><th>No. Telp</th><th>Status</th><th>Aksi</th></tr>";
                $no = 1;
                while ($r = mysqli_fetch_array($tampil)) {
                    echo "<tr><td>$no</td>
             <td>$r[noanggota]</td>
             <td>$r[nama]</td>
			  <td>$r[jenis]</td>
			   <td>$r[notelp]</td>
			   <td>$r[status]</td>
             <td>
			  <a href='cetakanggota.php?id=$r[id]'>
						<input type=button class='btn btn-warning btn-mini' value='cetak'/>
					  </a>
			 <a href=?modul=anggota&act=edit&id=$r[id]>
						<input type=button class='btn btn-success btn-mini' value='Edit'/>
					</a>
	                  <a href=$aksi?modul=anggota&act=hapus&id=$r[id]>
						<input type=button class='btn btn-danger btn-mini' value='Hapus'/>
					  </a>
					  
			 </td></tr>";
                    $no++;
                }
                echo '</table>';
                $jmldata = mysqli_num_rows(mysqli_query(KONEKSI, "SELECT * FROM anggota WHERE nama LIKE '%$_GET[kata]%' "));

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

        case 'tambahanggota':

            echo "
	<div class='span12 kotak' >
	<h4 align=center>Tambah Anggota</h4>
  <hr>
          <form method='POST' action='$aksi?modul=anggota&act=input' enctype='multipart/form-data'>
          <table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
          <tr><td>No. Anggota</td>     <td> : <input type=text name='noanggota'></td></tr>
          <tr><td>Nama</td>     <td> : <input type=text name='nama'></td></tr>
		  <tr><td>Tgl. Lahir</td>     <td> : <input data-format='yyyy-MM-dd' data-beatpicker='true' type='text' name='tgllahir'></input>
    
	</td></tr>
		  <tr><td>Jenis Kelamin</td>     <td> : <input type=radio name='jk' value='L'> Laki-laki   
                                           <input type=radio name='jk' value='P' > Perempuan
												</td></tr>
		  <tr><td>Alamat</td>     <td> : <textarea name='alamat' ></textarea></td></tr>
          <tr><td>No. Telp</td> <td> : <input type=text name='notelp' ></td></tr>  
		  <tr><td>Pekerjaan</td> <td> : <input type=text name='pekerjaan' ></td></tr>  
		   <tr><td>Foto</td> <td> : <input type='file' name='fupload' ></td></tr>  
          <tr><td colspan=2><input type=submit class='btn btn-primary' style='margin-left:400px;' value=Simpan>
                            <input type=button class='btn btn-default'  value=Batal onclick=self.history.back()></td></tr>
          </table></form>";

            break;

        case 'edit':
            $edit = mysqli_query(KONEKSI, "SELECT * FROM anggota WHERE id='$_GET[id]'");
            $r = mysqli_fetch_array($edit);

            echo "
	<div class='span12 kotak' >
	<h4 align=center>Edit Anggota</h4>
  <hr>
          <form method=POST action=$aksi?modul=anggota&act=update enctype='multipart/form-data'>
          <input type=hidden name=id value='$r[id]'>
          <table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
          <tr><td>No. Anggota</td>     <td> : <input type=text name='noanggota' value='$r[noanggota]'></td></tr>
          <tr><td>Nama</td>     <td> : <input type=text name='nama' value='$r[nama]'></td></tr>
		  <tr><td>Tgl. Lahir</td>     <td> : <input type=text name='tgllahir' value='$r[tgllahir]'></td></tr>";
            if ($r['jenis'] == 'P') {
                echo "<tr><td>Jenis Kelamin</td>     <td><input type=radio name='jk' value='L'> Laki - Laki   
                                           <input type=radio name='jk' value='P' checked> Perempuan </td></tr>";
            } else {
                echo "<tr><td>Jenis Kelamin</td>     <td><input type=radio name='jk' value='L' checked> Laki-Laki 
                                          <input type=radio name='jk' value='P'> Perempuan </td></tr>";
            }
            echo "									
		  <tr><td>Alamat</td>     <td> : <textarea name='alamat' >$r[alamat]</textarea></td></tr>
          <tr><td>No. Telp</td> <td> : <input type=text name='notelp' value='$r[notelp]'></td></tr>  
		  <tr><td>Pekerjaan</td> <td> : <input type=text name='pekerjaan' value='$r[pekerjaan]' ></td></tr>  
		   <tr><td>Foto</td> <td> : <img src='images/foto/$r[foto]' class='imganggota'></td></tr>  
		   <tr><td>Foto</td> <td> : <input type='file' name='fupload' ></td></tr> ";
            if ($r['status'] == 'NONAKTIF') {
                echo "<tr><td>Status Aktif</td>     <td><input type=radio name='status' value='AKTIF'> AKTIF   
                                           <input type=radio name='status' value='NONAKTIF' checked> NONAKTIF </td></tr>";
            } else {
                echo "<tr><td>STATUS AKTIF</td>     <td><input type=radio name='status' value='AKTIF' checked> AKTIF 
                                          <input type=radio name='status' value='NONAKTIF'> NONAKTIF </td></tr>";
            }

            echo "				 
          <tr><td colspan=2><input type=submit class='btn btn-primary' style='margin-left:400px;'  value=Update>
                            <input type=button class='btn btn-default' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";

            break;
    }
}
