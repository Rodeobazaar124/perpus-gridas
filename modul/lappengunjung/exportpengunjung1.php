<?php

$ambil = $_GET['id'];
$dbHost = 'localhost';  //nama server
$dbUser = 'root';       // user
$dbPass = '';           //password
$dbName = 'db_perpus';        // database yang akan dipake

// Koneksi dan memilih database di server
$koneksi = mysqli_connect($dbHost, $dbUser, $dbPass) or exit('Koneksi gagal');
mysqli_select_db($koneksi, $dbName) or exit('Database tidak bisa dibuka');

header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename=export.xls'); //ganti nama sesuai keperluan
header('Pragma: no-cache');
header('Expires: 0');

echo "
<div class='row' >
  <div class='col-lg-1'>
  </div>
    <div class='col-lg-10'>
";
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

$ambildata = mysqli_query(KONEKSI, 'SELECT anggota.noanggota ,anggota.nama ,tblpengunjung.tglkunjungan,tblpengunjung.jam   FROM tblpengunjung 
         LEFT JOIN 	anggota ON anggota.noanggota = tblpengunjung.noanggota
		 
		ORDER BY tblpengunjung.tglkunjungan DESC');
$cekdata = mysqli_num_rows($ambildata);
echo "<div class='container' id='konten'>
	<div class='row clearfix'>
		<div class='col-md-12 column'>";

if ($cekdata == 0) {
    echo 'Maaf Data Yang anda cari tidak ada';
} else {
    echo "
<h4 align=center>Laporan Pengunjung Perpustakaan</h4>

<br>
<br>
 <table class='table table-striped table-bordered' border='1'>
 <thead><tr><th>No</th><th>No Anggota</th><th>Nama </th><th>Tgl. Kunjungan</th><th>Jam Kunjungan</th></thead>
 <tbody>";
    $no = 1;
    while ($r = mysqli_fetch_array($ambildata)) {

        echo "
<tr><td>$no</td><td>$r[noanggota]</td><td>$r[nama]</td><td>$r[tglkunjungan]</td><td>$r[jam]</td></tr>
 
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