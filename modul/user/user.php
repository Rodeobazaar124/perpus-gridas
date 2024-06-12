<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {

    $aksi = 'modul/user/aksi_users.php';
    switch ($_GET['act']) {
        // Tampil User
        default:

            $tampil = mysqli_query(KONEKSI, 'SELECT * FROM users ORDER BY username');
            echo "
	   <div class='span12 kotak' >
	  <h4 align=center>Manajemen Users </h4>
	  <hr>
          <input  class='btn btn-info' style='margin-left:10px;' type=button  value='Tambah User' onclick=\"window.location.href='?modul=user&act=tambahuser';\">
       <hr>";

            echo "<table class='table table-hover table-striped'>
          <tr><th>no</th><th>username</th><th>nama lengkap</th><th>aksi</th></tr>";
            $no = 1;
            while ($r = mysqli_fetch_array($tampil)) {
                echo "<tr><td>$no</td>
             <td>$r[username]</td>
             <td>$r[nama_lengkap]</td>
             <td>
			 <a href=?modul=user&act=edit&id=$r[id_user]>
						<input type=button class='btn btn-success btn-mini' value='Edit'/>
					</a>
	                  <a href=$aksi?modul=user&act=hapus&id=$r[id_user]>
						<input type=button class='btn btn-danger btn-mini' value='Hapus'/>
					  </a>
			 </td></tr>";
                $no++;
            }
            echo '</table>';
            break;

        case 'tambahuser':

            echo "
	<div class='span12 kotak' >
	<h4 align=center>Tambah User</h4>
  <hr>
          <form method=POST action='$aksi?modul=user&act=input'>
          <table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
          <tr><td>Username</td>     <td> : <input type=text name='username'></td></tr>
          <tr><td>Password</td>     <td> : <input type=text name='password'></td></tr>
          <tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' size=30></td></tr>  
          <tr><td colspan=2><input type=submit class='btn btn-primary' style='margin-left:400px;' value=Simpan>
                            <input type=button class='btn btn-default'  value=Batal onclick=self.history.back()></td></tr>
          </table></form>";

            break;

        case 'edit':
            $edit = mysqli_query(KONEKSI, "SELECT * FROM users WHERE id_user='$_GET[id]'");
            $r = mysqli_fetch_array($edit);

            echo "
	<div class='span12 kotak' >
	<h4 align=center>Edit User</h4>
  <hr>
          <form method=POST action=$aksi?modul=user&act=update>
          <input type=hidden name=id value='$r[id_user]'>
          <table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
          <tr><td>Username</td>     <td> : <input type=text name='username' value='$r[username]' disabled> **)</td></tr>
          <tr><td>Password</td>     <td> : <input type=text name='password'> *) </td></tr>
          <tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'></td></tr>
  
    
		 <tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.<br />
                            **) Username tidak bisa diubah.</td></tr>
          <tr><td colspan=2><input type=submit class='btn btn-primary' style='margin-left:400px;'  value=Update>
                            <input type=button class='btn btn-default' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";

            break;
    }
}
