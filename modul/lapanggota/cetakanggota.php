<?php
include '../../config/koneksi.php';
include '../../config/library.php';
include '../../config/fungsi_thumb.php';
include '../../config/fungsi_indotgl.php';
?>
<html>

<head>
  <title>Smart Library - Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="../../css/bt3/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/bt3/costum.css" rel="stylesheet">



</head>

<body>
  <div class='row'>
    <div class='col-lg-1'>
    </div>
    <div class='col-lg-10'>
      <?php
      $tampil = mysqli_query(KONEKSI, 'SELECT * FROM profil');

while ($p = mysqli_fetch_array($tampil)) {
    echo "
  <table id='kop'>
  <tr><td><img src='../../images/$p[logo]' width=60px></td><td> <p align=center><b>$p[nama_perpus] </b>
                          
						   <br>$p[alamat] </td></tr>
  </table>
  <div class=garis></div>
  ";
}
?>


    </div>
    <div class='col-lg-1'>
    </div>


    <?php
    $tglawal = $_POST['tglawal'];
$tglakhir = $_POST['tglakhir'];

$ambildata = mysqli_query(KONEKSI, 'SELECT * FROM anggota ORDER by noanggota DESC');
$cekdata = mysqli_num_rows($ambildata);
echo "<div class='container' id='konten'>
	<div class='row clearfix'>
		<div class='col-md-12 column'>";

if ($cekdata == 0) {
    echo 'Maaf Data Yang anda cari tidak ada';
} else {
    echo "
<h4 align=center>Laporan Rekap Anggota Perpustakaan</h4>

<br>
<br>
 <table class='table table-striped table-bordered'>
 <thead><tr><th width='50px'>No</th><th>No Anggota</th><th>Nama</th><th>Jenis Kelamin</th><th>No. Telp</th><th>Pekerjaan</th><th>Status</th></tr>
		</thead>
 <tbody>";
    $no = 1;
    while ($r = mysqli_fetch_array($ambildata)) {

        $tgl = tgl_indo($r['tglkunjungan']);
        echo "
<tr><td>$no</td>
                <td>$r[noanggota]</td>
				<td>$r[nama]</td>
                <td>$r[jenis]</td>
                <td>$r[notelp]</td>
				<td>$r[pekerjaan]</td>
                <td>$r[status]</td>
";
        $no++;
    }
    echo '
	</tbody>
 </table>	
 
 
';
}
echo " <div class='row' id='ttd'>
  <div class='kolom'>
        <br>
                    <br>
                    <br>
                    <br>
                    <br>            				
  </div>
  <div class='kolom'>
  <br>
  <br>
                    <br>
                    <br>
                    <br>
                    <br>
  </div>
    <div class='kolom'>
<br>
                    <br>
                    <br>
                    <br>
                    <br>	</div>
	  <div class='kolom'><br>............  ,............ 20...
                    <br><strong>Kepala Perpustakaan</strong>,
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>";

$tampil = mysqli_query(KONEKSI, 'SELECT * FROM profil');

while ($p = mysqli_fetch_array($tampil)) {

    echo "<br><strong>$p[kepala_perpus]</strong>
                    <br>
					<br>";
}
echo '
					
					<br></div>
</div>
 
		</div>
	</div>
	</div>';

?>