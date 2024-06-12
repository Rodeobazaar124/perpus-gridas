<?php
error_reporting(0);

include 'timeout.php';
include 'config/library.php';
include 'config/rupiah.php';
include 'config/koneksi.php';
include 'config/class_paging.php';
include 'config/fungsi_indotgl.php';
include 'config/fungsi_combobox.php';

if ($_SESSION['login'] == 1) {
    if (! cek_login()) {
        $_SESSION['login'] = 0;
    }
}
if ($_SESSION['login'] == 0) {
    header('location:logout.php');
} else {
    if (empty($_SESSION['username']) and empty($_SESSION['passuser']) and $_SESSION['login'] == 0) {
        echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
        echo '<a href=index.php><b>LOGIN</b></a></center>';
    } else {
        ?>
		<!DOCTYPE html>
		<html lang="en">

		<head>

			<meta charset="utf-8">
			<title>Smart Library </title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="description" content="">
			<meta name="author" content="">

			<!-- CSS -->

			<!-- Ionicons -->
			<link href="assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
			<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="assets/css/style.css">
			<link rel="stylesheet" href="css/datepicker.css">
			<script src="tinymcpuk/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
			<script src="tinymcpuk/jscripts/tiny_mce/tiny_lokomedia.js" type="text/javascript"></script>
			<script src="tinymcpuk/jscripts/tiny_mce/tiny_lokomedia2.js" type="text/javascript"></script>
			<script src="js/jquery-1.11.0.min.js"></script>
			<script src="js/bootstrap-datepicker.js"></script>
			<script type="text/javascript">
				// When the document is ready
				$(document).ready(function() {

					$('#example1').datepicker({
						format: "yyyy-mm-dd"
					});

				});
			</script>
			<script type="text/javascript">
				// When the document is ready
				$(document).ready(function() {

					$('#example2').datepicker({
						format: "yyyy-mm-dd"
					});

				});
			</script>
			<script type="text/javascript">
				// When the document is ready
				$(document).ready(function() {

					$('#example3').datepicker({
						format: "yyyy-mm-dd"
					});

				});
			</script>
			<script type="text/javascript">
				// When the document is ready
				$(document).ready(function() {

					$('#example4').datepicker({
						format: "yyyy-mm-dd"
					});

				});
			</script>

		</head>

		<body>



			<div class="container">
				<div class="row">
					<?php
                            require_once 'components/navbar.php';
        ?>
				</div>

			</div>

			<script type="text/javascript">
				var bulan = new Array();
				bulan[1] = "Jan";
				bulan[2] = "Feb";
				bulan[3] = "Mar";
				bulan[4] = "Apr";
				bulan[5] = "Mei";
				bulan[6] = "Jun";
				bulan[7] = "Jul";
				bulan[8] = "Aug";
				bulan[9] = "Sept";
				bulan[10] = "Oct";
				bulan[11] = "Nov";
				bulan[12] = "Dec";
				var categori = new Array();
				var data = new Array();
				var tahun;
				var title;
				var subtitle;
				var suffix;
				var yAx;
				var name;
				var modul;
			</script>




			<div class="container">
				<?php
                if ($_GET['modul'] == 'home') {
                    echo "	
		<div class='row'>
                        <div class='span3'>
                            
                            <div class='small-box bg-aqua'>
                                <div class='inner'>
                                    ";
                    $jmlb = mysqli_query(KONEKSI, 'SELECT count(id_buku) as jml from tblbuku ');
                    while ($b = mysqli_fetch_array($jmlb)) {
                        echo "<h3>$b[jml]</h3>";
                    }
                    echo "   
                                    
                                    <p>
                                        Jumlah Buku
                                    </p>
                                </div>
                                <div class='icon'>
                                    <i class='ion ion-android-book'></i>
                                </div>
                                <a href='?modul=rekapbuku' class='small-box-footer'>
                                    More info <i class='fa fa-arrow-circle-right'></i>
                                </a>
                            </div>
                        </div>
                        <div class='span3'>
                          
                            <div class='small-box bg-green'>
                                <div class='inner'>";
                    $qry = mysqli_query(KONEKSI, 'SELECT count(notransaksi) as jml from sirkulasi  ');
                    while ($rs = mysqli_fetch_array($qry)) {
                        echo "
                                    <h3>
                                        $rs[jml] </h3>";
                    }
                    echo "
									
                                    
                                    <p>
                                        Jumlah Sirkulasi
                                    </p>
                                </div>
                                <div class='icon'>
                                    <i class='ion ion-stats-bars'></i>
                                </div>
                                <a href='?modul=lapsirkulasi' class='small-box-footer'>
                                    More info <i class='fa fa-arrow-circle-right'></i>
                                </a>
                            </div>
                        </div>
                        <div class='span3'>
                           
                            <div class='small-box bg-yellow'>
                                <div class='inner'>";
                    $qry = mysqli_query(KONEKSI, 'SELECT count(id) as jml from anggota  ');
                    while ($rs = mysqli_fetch_array($qry)) {
                        echo "
                                    <h3>
                                        $rs[jml] </h3>";
                    }
                    echo "
                                    <p>
                                        Jumlah Anggota
                                    </p>
                                </div>
                                <div class='icon'>
                                    <i class='ion ion-person-add'></i>
                                </div>
                                <a href='?modul=rekapanggota' class='small-box-footer'>
                                    More info <i class='fa fa-arrow-circle-right'></i>
                                </a>
                            </div>
                        </div>
                        <div class='span3'>
                           
                            <div class='small-box bg-red'>
                                <div class='inner'>
                                   ";
                    $qry = mysqli_query(KONEKSI, 'SELECT count(id_pengunjung) as jml from tblpengunjung  ');
                    while ($rs = mysqli_fetch_array($qry)) {
                        echo "
                                    <h3>
                                        $rs[jml] </h3>";
                    }
                    echo "
                                    <p>
                                        Jumlah Pengunjung
                                    </p>
                                </div>
                                <div class='icon'>
                                    <i class='ion ion-pie-graph'></i>
                                </div>
                                <a href='?modul=lappengunjung' class='small-box-footer'>
                                    More info <i class='fa fa-arrow-circle-right'></i>
                                </a>
                            </div>
                       </div>
                    </div>";
                    echo "
          
          <div class='row '>
		      <div class='span3 infouser'>
			  <h4 align=center>Login Status </h4>
			  <hr>
			   <div class='pht'> 
			  <img src='images/photo.jpg' width='180px'> 
			  </div>
			  <br>
			  <table class='table table-striped'>
			
				<tbody>
					<tr>
						<td>
							Hak Akses
						</td>
						<td>
							:
						</td>
						<td>
							<b>$_SESSION[hak]</b>
						</td>
						
					</tr>
					<tr >
						<td>
							Nama Lengkap
						</td>
						<td>
							:
						</td>
						<td>
							<b>$_SESSION[nama_lengkap]</b>
						</td>
						
					</tr>
					<tr >
						<td>
							Ip Address
						</td>
						<td>
							:
						</td>
						<td>
							<b>$_SERVER[REMOTE_ADDR]</b>
						</td>
						
					</tr>

					<tr >
						<td>
							Tangal Login
						</td>
						<td>
							:
						</td>
						<td>";
                    $tgl = date('l, d-m-Y');

                    echo "<b>$tgl</b>
						</td>
						
					</tr>
				</tbody>
			</table>
			 
			 </div>
                
                <div class='span9' >
						   <div style='text-align:right;'>
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
						   <div id ='grafik' class='blt'>
						   ";

                    include 'config/koneksi.php';

                    echo "<script>tahun=$tahun;title='Grafik Pengunjung';subtitle='Tahun: $tahun';yAx='Jumlah (org)';suffix=' org';name='Pengunjung';modul='home'</script>";
                    $i = 0;
                    $qry = mysqli_query(KONEKSI, 'SELECT Month(tglkunjungan) as bulan ,count(id_pengunjung) as jml from tblpengunjung where Year(tglkunjungan)='.$tahun.' group by Month(tglkunjungan)  ');
                    while ($rs = mysqli_fetch_array($qry)) {
                        echo "
								<script>
									categori[$i]=bulan[$rs[bulan]];
									data[$i] = $rs[jml];
								</script>";
                        $i++;
                    }
                    echo "
							</div>
							
							 
  

  <div class='kotaksirkulasi blt' style='margin-top:20px;height:120px;padding-right:20px;';>
  <h4 align=center>Peminjaman Buku</h4>
  <hr>
  <form class='form-horizontal' method=POST action='modul/peminjaman/aksi_peminjaman.php?modul=peminjaman&act=validasi' enctype='multipart/form-data'>
  <table>
  <tr><td>No. Anggota </td><td>:</td><td><input class='input-large' type='text' name='noanggota' placeholder='Masukan No anggota'></td>
  <td>Kode Eksemplar Buku </td><td>:</td><td><input class='input-large' type='text' name='kdeksemplar' placeholder='Masukan Kode Eksemplar Buku'></td>
  <td><input type=submit class='btn btn-warning'  value='Proses'></td> </tr>
  </table>
  
  </form>
  </div>
							
                         </div>
						
			              ";
                }
        if ($_GET['modul'] == 'pengarang') {
            include 'modul/pengarang/pengarang.php';
        }
        if ($_GET['modul'] == 'subjek') {
            include 'modul/subjek/subjek.php';
        }
        if ($_GET['modul'] == 'kategori') {
            include 'modul/kategori/kategori.php';
        }
        if ($_GET['modul'] == 'penerbit') {
            include 'modul/penerbit/penerbit.php';
        }
        if ($_GET['modul'] == 'rak') {
            include 'modul/rak/rak.php';
        }
        if ($_GET['modul'] == 'klasifikasi') {
            include 'modul/klasifikasi/klasifikasi.php';
        }
        if ($_GET['modul'] == 'anggota') {
            include 'modul/anggota/anggota.php';
        }

        if ($_GET['modul'] == 'buku') {
            include 'modul/buku/buku.php';
        }

        if ($_GET['modul'] == 'user') {
            include 'modul/user/user.php';
        }
        if ($_GET['modul'] == 'cari') {
            include 'modul/cari/cari.php';
        }
        if ($_GET['modul'] == 'peminjaman') {
            include 'modul/peminjaman/peminjaman.php';
        }
        if ($_GET['modul'] == 'pengembalian') {
            include 'modul/pengembalian/pengembalian.php';
        }

        if ($_GET['modul'] == 'laporan') {
            include 'modul/laporan/laporan.php';
        }
        if ($_GET['modul'] == 'jurnal') {
            include 'modul/jurnal/jurnal.php';
        }
        if ($_GET['modul'] == 'katjurnal') {
            include 'modul/katjurnal/katjurnal.php';
        }
        if ($_GET['modul'] == 'profil') {
            include 'modul/profil/profil.php';
        }
        if ($_GET['modul'] == 'jadwal') {
            include 'modul/jadwal/jadwal.php';
        }
        if ($_GET['modul'] == 'lappengunjung') {
            include 'modul/lappengunjung/lappengunjung.php';
        }
        if ($_GET['modul'] == 'rekapbuku') {
            include 'modul/lapbuku/lapbuku.php';
        }
        if ($_GET['modul'] == 'rekapanggota') {
            include 'modul/lapanggota/lapanggota.php';
        }
        if ($_GET['modul'] == 'lapsirkulasi') {
            include 'modul/lapsirkulasi/lapsirkulasi.php';
        }
        ?>

			</div>



			</div>
			</div>

			<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Peringatan</h3>
				</div>
				<div class="modal-body">
					<p>Apakah anda yakin akan keluar dari sistem</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
					<a href="logout.php">
						<button class="btn btn-danger">Logout</button>
					</a>

				</div>
			</div>

			<!-- Javascript -->
			<script src="assets/bootstrap/js/bootstrap.min.js"></script>
			<script src="assets/js/jquery.backstretch.min.js"></script>
			<script src="assets/js/scriptshome.js"></script>
			<script src="js/highcharts.js"></script>
			<?php

        ?>
			<script type="text/javascript">
				getChart();

				function getChart() {
					$('#grafik').highcharts({
						title: {
							text: title,
							x: -20 //center
						},
						subtitle: {
							text: subtitle,
							x: -20
						},
						xAxis: {
							categories: categori
						},
						yAxis: {
							title: {
								text: yAx
							},
							plotLines: [{
								value: 0,
								width: 1,
								color: '#808080'
							}]
						},
						tooltip: {
							valueSuffix: suffix
						},
						legend: {
							layout: 'vertical',
							align: 'right',
							verticalAlign: 'middle',
							borderWidth: 0
						},
						series: [{
							name: name,
							data: data
						}]
					});
				}

				function setYear() {
					window.location.assign("home.php?modul=" + modul + "&tahun=" + $('#tahun').val())
				}
			</script>
		</body>

		</html>
<?php
    }
}

?>