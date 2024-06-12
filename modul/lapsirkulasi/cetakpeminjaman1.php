
<?php
if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {
    include '../../config/koneksi.php';
    include '../../config/rupiah.php';
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
  <div class='row' >
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

    $ambildata = mysqli_query(KONEKSI, "select 
				sirkulasi.notransaksi,		sirkulasi.tglpinjam,
				sirkulasi.tgljtempo,		sirkulasi.status,
				sirkulasi.tglkembali,		sirkulasi.denda,
				anggota.noanggota,			anggota.nama as nama_anggota,
				tblbuku.kdbuku,				tblbuku.judul,
				petugas.id,					petugas.nama,
				denda.notransaksi,			denda.telat, denda.denda as bayardenda,
                				
				tbleksemplar.kdeksemplar
			from sirkulasi
			left join anggota 		on anggota.noanggota		= sirkulasi.noanggota
			left join tblbuku 		on tblbuku.kdbuku			= sirkulasi.kdbuku
			left join petugas		on petugas.id				= sirkulasi.idpetugasserah
			left join denda			on denda.notransaksi		= sirkulasi.notransaksi
			left join tbleksemplar 	on tbleksemplar.kdeksemplar	= sirkulasi.kdeksemplar
		 WHERE sirkulasi.status = 'SUDAH' AND sirkulasi.tglpinjam BETWEEN '$tglawal' AND '$tglakhir' 
		ORDER BY sirkulasi.status DESC");
    $cekdata = mysqli_num_rows($ambildata);
    echo "<div class='container' id='konten'>
	<div class='row clearfix'>
		<div class='col-md-12 column'>";

    if ($cekdata == 0) {
        echo 'Maaf Data Yang anda cari tidak ada';
    } else {
        echo "
<h4 align=center>Laporan Sirkulasi Peminjaman Buku</h4>
<p align=center>dari Tanggal <b>$tglawal</b> sampai dengan Tanggal <b>$tglakhir</b></p>
<br>
<br>
 <table class='table table-striped table-bordered tg'>
 <thead>
          <tr><th width='50px'>No</th><th>Buku</th><th>Eksemplar</th><th>Peminjam</th><th>Status</th><th>Pinjam</th><th>Tempo</th><th>Kembali</th><th>Petugas</th></tr>
		</thead>
 <tbody>";
        $no = 1;
        while ($r = mysqli_fetch_array($ambildata)) {

            echo "
<tr><td>$no</td>
                <td>
					<b>$r[kdbuku]</b> <br>
					$r[judul]
				</td>
                <td>$r[kdeksemplar]</td>
				<td>
					<b>$r[noanggota]</b><br>
					$r[nama_anggota]
				</td>
                <td>$r[status]</td>
                <td>$r[tglpinjam]</td>
				<td>$r[tgljtempo]</td>
				<td>$r[tglkembali]</td>
				<td>$r[nama]</td>
				
	                 
		        </tr>
      
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
}
?>