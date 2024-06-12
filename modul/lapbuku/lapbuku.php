<?php

$aksi = 'modul/jadwal/aksi_jadwal.php';

switch ($_GET['act']) {
    default:
        echo "
   <div class='span12 kotak' >
  <h4 align=center>Rekap Buku</h4>
  <hr>
  <div class='row'>
  <div class='span1'>
  </div>
   <div class='span8'>
   <form method='POST' action='modul/lapbuku/cetakbuku.php'>
</select>
          <input type=submit class='btn btn-warning' value='Cetak Laporan Rekap Buku'>
          </form>
               
                 </div>
  <div class='span3'>
    <a href='modul/lapbuku/exportbuku.php'>
  <button class='btn btn-info'  type='button'>Export Excel Rekap Buku</button></a>  
  </div>
</div>  
  <hr>";

        break;
}
