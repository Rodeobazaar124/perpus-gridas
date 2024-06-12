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
  <div class='row'>
	  <div class='span12 head'>
  <h4 align=center>Rekap Sirkulasi Pengembalian Buku</h4>
       </div>
	 </div>  
  <div class='row bdg'>
  <div class='span1'>
  </div>
   <div class='span7'>
   <form method='POST' action='modul/lapsirkulasi/cetakpengembalian.php'>
        Dari <input  id='example1' type='text' name='tglawal' placeholder='Masukan tgl awal'> Sampai Dengan 
               <input  id='example2' type='text' name='tglakhir'  placeholder='Masukan tgl akhir'> 		
          <input type=submit class='btn btn-warning' value=Cetak>
          </form>
               
                 </div>
  <div class='span3'>
    <a href='modul/lapsirkulasi/exportsirkulasi.php'>
  <button class='btn btn-success' style='margin-left:10px;' type='button'>Export Excel Semua Sirkulasi</button></a>  
  </div>
</div>  ";
            echo "
    <div class='row'>
	  <div class='span12 head'>
  <h4 align=center>Rekap Sirkulasi Peminjaman Buku</h4>
       </div>
	 </div>  
  <div class='row bdg'>
  <div class='span1'>
  </div>
   <div class='span8'>
   <form method='POST' action='modul/lapsirkulasi/cetakpeminjaman.php'>
        Dari <input  id='example3' type='text' name='tglawal' placeholder='Masukan tgl awal'> Sampai Dengan 
               <input  id='example4' type='text' name='tglakhir'  placeholder='Masukan tgl akhir'> 		
          <input type=submit class='btn btn-warning' value=Cetak>
          </form>
               
                 </div>
  <div class='span3'>
    
  </div>
</div>  
							<div style='width:100%; text-align:center;'>
								<select id='tahun' onchange='setYear()'>";
            if (empty($_GET['tahun'])) {
                $tahun = date('Y');
            } else {
                $tahun = $_GET['tahun'];
            }
            for ($x = 2011; $x <= date('Y'); $x++) {
                if ($x == $tahun) {
                    echo "<option selected value='$x'>$x</option>";
                } else {
                    echo "<option value='$x'>$x</option>";
                }
            }
            echo "
									
								</select>
						   </div>
						<div id ='grafik'>
						   ";

            include 'config/koneksi.php';

            echo "<script>tahun=$tahun;title='Grafik Sirkulasi (Peminjaman)';subtitle='Tahun: $tahun';yAx='Jumlah (transaksi)';suffix=' transaksi';name='Sirkulasi';modul='lapsirkulasi'</script>";
            $i = 0;
            $qry = mysqli_query(KONEKSI, 'SELECT Month(tglpinjam) as bulan ,count(notransaksi) as jml from sirkulasi where Year(tglpinjam)='.$tahun.' group by Month(tglpinjam)  ');
            while ($rs = mysqli_fetch_array($qry)) {
                echo "
								<script>
									categori[$i]=bulan[$rs[bulan]];
									data[$i] = $rs[jml];
								</script>";
                $i++;
            }
            echo '
						</div>
		';

            break;
    }
}
