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
  <h4 align=center>Rekap Anggota Perpustakaan</h4>
  <hr>
  <div class='row'>
  <div class='span1'>
  </div>
   <div class='span8'>
   <form method='POST' action='modul/lapanggota/cetakanggota.php'>
        
  
</select>

          <input type=submit class='btn btn-warning' value='Cetak Laporan Rekap Anggota'>
          </form>
               
                 </div>
  <div class='span3'>
    <a href='modul/lapanggota/exportanggota.php'>
  <button class='btn btn-info'  type='button'>Export Excel Rekap Anggota</button></a>  
  </div>
</div>  
  <hr>";
            break;
    }
}
