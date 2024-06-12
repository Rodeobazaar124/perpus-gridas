<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {
    switch ($_GET['act']) {
        default:

            echo "
   <div class='span12 kotak' >
  <h4 align=center>Grafik Pengunjung</h4>
  <hr>
  <div class='abu'>
  <form class='form-horizontal' method=POST action='laporan/lap_peminjaman.php' enctype='multipart/form-data'>
  <table style='margin-left:auto;margin-right:auto;'>
  <tr><td>Tgl. awal </td><td>:</td><td><input data-beatpicker='true' class='input-large' type='text' name='tglawal' placeholder='Masukan tgl. Awal Laporan'></td>
  <td>Tgl. Akhir</td><td>:</td><td><input data-beatpicker='true' class='input-large' type='text' name='tglakhir' placeholder='Masukan tgl. Akhir Laporan'></td>
  <td><input type=submit class='btn btn-warning'  value='Proses'></td> </tr>
  </table> 
  </form>
  </div>
  <hr>";

            echo "
  <h4 align=center>Laporan Peminjaman Buku</h4>
  <hr>
  <div class='abu' >
  <form class='form-horizontal' method=POST action='laporan/lap_peminjaman.php' enctype='multipart/form-data'>
  <table style='margin-left:auto;margin-right:auto;>
  <tr><td>dari </td><td>:</td><td><input class='input-large' type='text' name='noanggota' placeholder='masukan tglawal' data-beatpicker='true'></td>
  <td>Sampai dengan</td><td>:</td><td><input class='input-large' type='text' name='tglakhir' placeholder='Masukan Kode Eksemplar Buku'></td>
  <td><input type=submit class='btn btn-warning'  value='Proses'></td> </tr>
  </table> 
  </form>
  </div>
  <hr>";

            echo "
  <h4 align=center>Laporan Buku yang masih dipinjam</h4>
  <hr>
  <div >
  <form class='form-horizontal' method=POST action='laporan/lap_peminjaman.php' enctype='multipart/form-data'>
  <table>
  <tr><td>No. Anggota </td><td>:</td><td><input class='input-large' type='text' name='noanggota' placeholder='Masukan No anggota'></td>
  <td>Kode Eksemplar Buku </td><td>:</td><td><input class='input-large' type='text' name='kdeksemplar' placeholder='Masukan Kode Eksemplar Buku'></td>
  <td><input type=submit class='btn btn-warning'  value='Proses'></td> </tr>
  </table> 
  </form>
  </div>
  <hr>";

            break;

    }
}
