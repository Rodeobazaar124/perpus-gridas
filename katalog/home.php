<?php
include 'config/koneksi.php';
include 'config/library.php';
include 'config/fungsi_indotgl.php';
include 'config/fungsi_combobox.php';
include 'config/class_paging.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Ekatalog - Smart Library</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/logo.png">
  
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript" src="js/scriptshome.js"></script>
	<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
</head>

<body>


	<div class="row clearfix">
		<div class="col-md-12 column">
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="nb">
				<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="#"><img src="img/logo.png" height="40">  </a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active">
							<a href="beranda.html">Beranda</a>
						</li>
						<li >
							<a href="katalog.html">Katalog</a>
						</li>
						<li >
							<a href="jurnal.html">Jurnal</a>
						</li>
						
						</li>
					</ul>
                    
					<form class="navbar-form navbar-left" role="search" action="carijudul.html" method="post">
						<div class="form-group" style="width:220px;float:left;">
                         <span class="label label-warning">Cari Buku Berdasarkan Judul</span>
							<input class="form-control" type="text" name="kata">
						</div> <button type="submit" class="btn btn-default" >Cari</button>
					</form>
                    <form class="navbar-form navbar-left" role="search" action="caripenulis.html" method="post">
						<div class="form-group " style="width:220px;float:left;">
                         <span class="label label-warning">Cari Buku Berdasarkan Pengarang</span>
							<input class="form-control" type="text" name="kata">
						</div> <button type="submit" class="btn btn-default" >Cari</button>
					</form>
					
				
				
			</nav>
		</div>
	</div>
    
 <div class="container" id="konten" >   
    
	<div class="row clearfix">
   
        
  <!--konten kanan-->     
  <!--ini jurnal-->  
		<div class="col-md-12 column" style="margin-left:-3%">
			<div class="row" >
			<?php

            if ($_GET['modul'] == 'home') {
                echo "
			<div class='col-md-1'></div>
			<div class='col-md-4 kotak ' style='margin-bottom:20px;'  >
			<h4 align='center'>Isi Pengunjung</h4>
  </hr>
			<form role='form' method='POST' action='aksipengunjung.php'>
  <div class='form-group '>
    <label for='noanggota'>No. Anggota</label>
    <input type='text' name='noanggota' class='form-control'  placeholder='Silakan Masukan No. Anggota' autofocus>
  </div>
  
  <button type='submit' class='btn btn-default kuning' style='margin-top:-10px;margin-bottom:10px;'>Submit</button>
</form>";

                echo "	
			</div>
			
			
  <div class='col-md-6 kotak'>
  <div class='table-responsive'>
  <h4 align='center'>Daftar Pengunjung</h4>
  </hr>
  <table class='table table-striped'>
    <thead>
	<tr><th>No </th><th>Nama </th><th>Tanggal Kunjungan </th><th>Jam</th></tr>
	</thead>";
                include 'config/koneksi.php';
                $kunjung = mysqli_query(KONEKSI, 'select tblpengunjung.noanggota, tblpengunjung.tglkunjungan, tblpengunjung.jam, tblpengunjung.id_pengunjung,
						anggota.nama
						from tblpengunjung left join anggota on anggota.noanggota = tblpengunjung.noanggota order by tblpengunjung.id_pengunjung DESC LIMIT 10');
                $no = 1;
                while ($r = mysqli_fetch_array($kunjung)) {

                    echo "	
	<tr><td>$no</td><td>$r[nama]</td><td>$r[tglkunjungan]</td><td>$r[jam]</td></tr>";
                    $no++;
                }
                echo '
  </table>
</div>

</div>      
  
  </div>';

            }
?>
            <?php
 if ($_GET['modul'] == 'katalog') {
     echo " 
 <div class='col-md-12 column'>
 <div class='well well-sm'>
        <strong>Category Title</strong>
        <div class='btn-group'>
            <a href='#' id='list' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-th-list'>
            </span>List</a> <a href='#' id='grid' class='btn btn-default btn-sm'><span
                class='glyphicon glyphicon-th'></span>Grid</a>
				</div>
				 
				 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Kategori <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role=21483
  'menu'>";
     include 'config/koneksi.php';
     $kategori = mysqli_query(KONEKSI, 'select refkategori.nama_kategori, refkategori.id_kategori,
                         count(tblbuku.id_kategori) as jml 
                         from refkategori left join tblbuku 
                         on tblbuku.id_kategori=refkategori.id_kategori
                         group by refkategori.nama_kategori');
     while ($k = mysqli_fetch_array($kategori)) {

         echo "  
   <li><a href='kategori-$k[id_kategori].html'> $k[nama_kategori] </a></li>
    ";
     }
     echo "	
  </ul>
</div>

 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Subjek <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>";
     include 'config/koneksi.php';
     $subjek = mysqli_query(KONEKSI, 'select * from refsubjek');
     while ($s = mysqli_fetch_array($subjek)) {

         echo "  
   <li><a href='subjek-$s[id_subjek].html'> $s[nama_subjek] </a></li>
    ";
     }
     echo "
  </ul>
</div>

 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Klasifikasi <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>
    ";
     include 'config/koneksi.php';
     $klas = mysqli_query(KONEKSI, 'select * from refklasifikasi');
     while ($c = mysqli_fetch_array($klas)) {

         echo "  
   <li><a href='klasifikasi-$c[id_klasifikasi].html'> $c[nama_klasifikasi] </a></li>
    ";
     }
     echo "
  </ul>
</div>
		
    </div>
	
	<div id='products' class='row list-group'>
	";
     if (empty($_GET['kata'])) {
         $p = new Paging2();
         $batas = 9;
         $posisi = $p->cariPosisi($batas);

         $tampil = mysqli_query(KONEKSI, "SELECT tblbuku.id_buku, tblbuku.judul, tblbuku.id_pengarang, tblbuku.id_penerbit, tblbuku.jumlahbuku,
						refpengarang.id_pengarang, refpengarang.nama_pengarang, tblbuku.tersedia,
						penerbit.id_penerbit, penerbit.nama_penerbit
						FROM tblbuku
						left join penerbit 		on penerbit.id_penerbit		= tblbuku.id_penerbit
						left join refpengarang		on refpengarang.id_pengarang		= tblbuku.id_pengarang
					
						ORDER BY tblbuku.id_buku DESC LIMIT $posisi,$batas
						");
         $no = 1;
         while ($r = mysqli_fetch_array($tampil)) {
             $tgl = tgl_indo($r['tgl_posting']);
             echo "
            
			<div class='item  col-xs-4'>
            <div class='thumbnail'>
                <img class='group list-group-image'  alt='' />
                <div class='caption'>
                    <h5 class='group inner list-group-item-heading' align='center'>
                        <strong>$r[judul]</strong></h5>
                    <p class='group inner list-group-item-text'>
                        <table class='table table-striped table-responsive'>
						<tr><td>Pengarang</td><td>:</td><td><b>$r[nama_pengarang]<b></td></tr>
						<tr><td>Penerbit</td><td>:</td><td><b>$r[nama_penerbit]<b></td></tr>
						</table>
						
						</p>
                    <div class='row abu' >
                        <div class='col-xs-12 col-md-6'>
						Tersedia
                            <p class='lead jml'>
                                $r[tersedia]</p>
                        </div>
                        <div class='col-xs-12 col-md-6'>
                            <a class='btn btn-success' href='buku-$r[id_buku].html'>View Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
			
			
				";
         }
         $jmldata = mysqli_num_rows(mysqli_query(KONEKSI, 'SELECT * FROM tblbuku'));
         $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
         $linkHalaman = $p->navHalaman($_GET['halbuku'], $jmlhalaman);

         echo "	
				</div>
			</div>
		</div>
	</div>
	<div class='row clearfix'>
		<div class='col-md-4 column'>
		</div>
		<div class='col-md-4 column'>
			
			<div class='pages'>	$linkHalaman</div>
			
		</div>
		<div class='col-md-4 column'>
		</div>
	</div>";

     }
 }

if ($_GET['modul'] == 'detailbuku') {
    $detail = mysqli_query(KONEKSI, "SELECT tblbuku.judul,tblbuku.keterangan,tblbuku.edisi, tblbuku.asal, tblbuku.tahun, tblbuku.kota, tblbuku.biblio,
							tblbuku.bahasa, tblbuku.tahun,tblbuku.abstraksi,tblbuku.kolasi,tblbuku.jdlseri,
							tblbuku.isbn,tblbuku.kdbuku, tblbuku.id_buku, refpengarang.id_pengarang, penerbit.id_penerbit, 
							refpengarang.nama_pengarang, penerbit.nama_penerbit, refsubjek.nama_subjek,tblbuku.tersedia,
							refkategori.id_kategori, refkategori.nama_kategori,refklasifikasi.id_klasifikasi, refklasifikasi.nama_klasifikasi,
							tblrak.id_rak , tblrak.koderak,
							tblbuku.jumlahbuku FROM tblbuku, refpengarang, penerbit , refsubjek , refkategori, refklasifikasi,tblrak
							WHERE tblbuku.id_buku ='$_GET[id]' AND tblbuku.id_pengarang = refpengarang.id_pengarang AND 
							tblbuku.id_subjek = refsubjek.id_subjek AND tblbuku.id_penerbit = penerbit.id_penerbit
							AND refkategori.id_kategori = tblbuku.id_kategori AND refklasifikasi.id_klasifikasi = tblbuku.id_klasifikasi
							AND tblrak.id_rak = tblbuku.id_rak AND tblbuku.id_buku='".$val->validasi($_GET['id'], 'sql')."'");
    $d = mysqli_fetch_array($detail);

    echo "
	
	
	
	<div class='panel panel-default'>
				<div class='panel-heading' id='abu'>
					<h3 class='panel-title'>
					
				<p>
					<h4>$d[judul]</h4>
				</p> 
			
						
					</h3>
				</div>
				<div class='panel-body'>
				   <table id='tbl'>
				    <tr><td class='kc'>Kode Buku <td class='bc'>:</td></td> <td><b>  $d[kdbuku]</b></td><td class='kc'>pengarang <td class='bc'>:</td></td> <td><b>  $d[nama_pengarang]</b></td></tr>
				   <tr><td class='kc'>penerbit <td class='bc' >:</td></td> <td> <b>  $d[nama_penerbit]</b></td><td class='kc'>ISBN <td class='bc'>:</td></td> <td> <b>   $d[isbn]</b></td></tr>
				   <tr><td class='kc'>isbn <td>:</td class='bc'></td><td>  <b> $d[nama_kategori]<b></td><td class='kc'>Subjek <td>:</td class='bc'></td><td>  <b> $d[nama_subjek]<b></td></tr>
				   <tr><td class='kc'>edisi <td>:</td class='bc'></td><td>  <b> $d[edisi]<b></td><td class='kc'>Asal <td>:</td class='bc'></td><td>  <b> $d[asal]<b></td></tr>
				  <tr><td class='kc'>Tahun Terbit <td>:</td class='bc'></td><td>  <b> $d[tahun]<b></td><td class='kc'>Kota Terbit <td>:</td class='bc'></td><td>  <b> $d[kota]<b></td></tr>
				  <tr><td class='kc'>Bahasa <td>:</td class='bc'></td><td>  <b> $d[bahasa]<b></td><td class='kc'>biblio <td>:</td class='bc'></td><td>  <b> $d[biblio]<b></td></tr>
				 <tr><td class='kc'>Kategori <td>:</td class='bc'></td><td>  <b> $d[nama_kategori]<b></td><td class='kc'>kolasi <td>:</td class='bc'></td><td>  <b> $d[kolasi]<b></td></tr>
				 <tr><td class='kc'>Keterangan <td>:</td class='bc'></td><td>  <b> $d[keterangan]<b></td><td class='kc'>Rak Penyimpanan <td>:</td class='bc'></td><td>  <b> $d[koderak]<b></td></tr>		 
				 <tr><td class='kc'>Jumlah Buku <td>:</td class='bc'></td><td>  <b> $d[jumlahbuku]<b></td><td class='kc'>Tersedia<td>:</td class='bc'></td><td><b> $d[tersedia] <b> </td></tr>
				 <tr><td class='kc'>Sampul Buku <td>:</td class='bc'></td><td>  <b> <img scr='../../images/sampul/$d[file]'><b></td><td class='kc'><td></td class='bc'></td><td>  </td></tr> 
				   </table>
				</div>
				<div class='panel-footer'>
				
					 <a href='katalog.html'><button type='button' class='btn btn-default'>Kembali</button></a>
				
				</div>
			</div>";

}

//ini bagian detailkategori
if ($_GET['modul'] == 'detailkategori') {

    echo " 
 <div class='col-md-12 column'>
 <div class='well well-sm'>
        <strong>Category Title</strong>
        <div class='btn-group'>
            <a href='#' id='list' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-th-list'>
            </span>List</a> <a href='#' id='grid' class='btn btn-default btn-sm'><span
                class='glyphicon glyphicon-th'></span>Grid</a>
				</div>
				 
				 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Kategori <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>";
    include 'config/koneksi.php';
    $kategori = mysqli_query(KONEKSI, 'select refkategori.nama_kategori, refkategori.id_kategori,
                         count(tblbuku.id_kategori) as jml 
                         from refkategori left join tblbuku 
                         on tblbuku.id_kategori=refkategori.id_kategori
                         group by refkategori.nama_kategori');
    while ($k = mysqli_fetch_array($kategori)) {

        echo "  
   <li><a href='kategori-$k[id_kategori].html'> $k[nama_kategori] </a></li>
    ";
    }
    echo "	
  </ul>
</div>

 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Subjek <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>";
    include 'config/koneksi.php';
    $subjek = mysqli_query(KONEKSI, 'select * from refsubjek');
    while ($s = mysqli_fetch_array($subjek)) {

        echo "  
   <li><a href='subjek-$s[id_subjek].html'> $s[nama_subjek] </a></li>
    ";
    }
    echo "
  </ul>
</div>

 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Klasifikasi <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>
    ";
    include 'config/koneksi.php';
    $klas = mysqli_query(KONEKSI, 'select * from refklasifikasi');
    while ($c = mysqli_fetch_array($klas)) {

        echo "  
   <li><a href='klasifikasi-$c[id_klasifikasi].html'> $c[nama_klasifikasi] </a></li>
    ";
    }
    echo "
  </ul>
</div>
		
    </div>
	
	<div id='products' class='row list-group'>
	";

    $p = new Paging3();
    $batas = 9;
    $posisi = $p->cariPosisi($batas);

    $kat = mysqli_query(KONEKSI, "SELECT tblbuku.id_buku, tblbuku.judul, tblbuku.id_pengarang, tblbuku.id_penerbit, tblbuku.jumlahbuku,
						refpengarang.id_pengarang, refpengarang.nama_pengarang,
						penerbit.id_penerbit, penerbit.nama_penerbit
						FROM tblbuku
						left join penerbit 		on penerbit.id_penerbit		= tblbuku.id_penerbit
						left join refpengarang		on refpengarang.id_pengarang		= tblbuku.id_pengarang
						WHERE tblbuku.id_kategori='".$val->validasi($_GET['id'], 'sql')."'  ORDER BY tblbuku.id_buku DESC LIMIT $posisi,$batas");
    $no = 1;
    $d = mysqli_fetch_array($kat);

    $no = 1;

    $jumlah = mysqli_num_rows($kat);
    // Apabila ditemukan berita dalam kategori
    if ($jumlah > 0) {

        while ($r = mysqli_fetch_array($kat)) {

            echo "
	  <div class='item  col-xs-4'>
            <div class='thumbnail'>
                <img class='group list-group-image'  alt='' />
                <div class='caption'>
                    <h5 class='group inner list-group-item-heading'>
                        $r[judul]</h5>
                    <p class='group inner list-group-item-text'>
                        <table class='table table-striped table-responsive'>
						<tr><td>Pengarang</td><td>:</td><td><b>$r[nama_pengarang]<b></td></tr>
						<tr><td>Penerbit</td><td>:</td><td><b>$r[nama_penerbit]<b></td></tr>
						</table>
						
						</p>
                    <div class='row abu' >
                        <div class='col-xs-12 col-md-6'>
						Jumlah
                            <p class='lead jml'>
                                $r[jumlahbuku]</p>
                        </div>
                        <div class='col-xs-12 col-md-6'>
                            <a class='btn btn-success' href='buku-$r[id_buku].html'>View Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	  ";
        }
        $jmldata = mysqli_num_rows(mysqli_query(KONEKSI, "SELECT * FROM tblbuku WHERE id_kategori='".$val->validasi($_GET['id'], 'sql')."' "));
        $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
        $linkHalaman = $p->navHalaman($_GET['halkategori'], $jmlhalaman);
        echo "	
				
			</div>
		</div>
	</div>
	<div class='row clearfix'>
		<div class='col-md-4 column'>
		</div>
		<div class='col-md-4 column'>
			
			<div class='pages'>	$linkHalaman</div>
			
		</div>
		<div class='col-md-4 column'>
		</div>
	</div>";

    } else {
        echo "
	<div class='alert alert-dismissable alert-danger'>
				 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<h4>
					Info 
				</h4> <strong>Maaf</strong> Tidak ditemukan buku dalam kategori ini <b>$kata</b> <a href='#' class='alert-link'> </a>
			</div>
	";
    }
}

//ini bagian detailsubjek
if ($_GET['modul'] == 'detailsubjek') {

    echo " 
 <div class='col-md-12 column'>
 <div class='well well-sm'>
        <strong>Category Title</strong>
        <div class='btn-group'>
            <a href='#' id='list' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-th-list'>
            </span>List</a> <a href='#' id='grid' class='btn btn-default btn-sm'><span
                class='glyphicon glyphicon-th'></span>Grid</a>
				</div>
				 
				 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Kategori <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>";
    include 'config/koneksi.php';
    $kategori = mysqli_query(KONEKSI, 'select refkategori.nama_kategori, refkategori.id_kategori,
                         count(tblbuku.id_kategori) as jml 
                         from refkategori left join tblbuku 
                         on tblbuku.id_kategori=refkategori.id_kategori
                         group by refkategori.nama_kategori');
    while ($k = mysqli_fetch_array($kategori)) {

        echo "  
   <li><a href='kategori-$k[id_kategori].html'> $k[nama_kategori] </a></li>
    ";
    }
    echo "	
  </ul>
</div>

 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Subjek <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>";
    include 'config/koneksi.php';
    $subjek = mysqli_query(KONEKSI, 'select * from refsubjek');
    while ($s = mysqli_fetch_array($subjek)) {

        echo "  
   <li><a href='subjek-$s[id_subjek].html'> $s[nama_subjek] </a></li>
    ";
    }
    echo "
  </ul>
</div>

 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Klasifikasi <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>
    ";
    include 'config/koneksi.php';
    $klas = mysqli_query(KONEKSI, 'select * from refklasifikasi');
    while ($c = mysqli_fetch_array($klas)) {

        echo "  
   <li><a href='klasifikasi-$c[id_klasifikasi].html'> $c[nama_klasifikasi] </a></li>
    ";
    }
    echo "
  </ul>
</div>
		
    </div>
	
	<div id='products' class='row list-group'>
	";

    $p = new Paging4();
    $batas = 9;
    $posisi = $p->cariPosisi($batas);

    $kat = mysqli_query(KONEKSI, "SELECT tblbuku.id_buku, tblbuku.judul, tblbuku.id_pengarang, tblbuku.id_penerbit, tblbuku.jumlahbuku,
						refpengarang.id_pengarang, refpengarang.nama_pengarang,
						penerbit.id_penerbit, penerbit.nama_penerbit, refsubjek.id_subjek, refsubjek.nama_subjek, tbl_buku.id_subjek
						FROM tblbuku
						left join penerbit 		on penerbit.id_penerbit		= tblbuku.id_penerbit
						left join refpengarang		on refpengarang.id_pengarang		= tblbuku.id_pengarang
						left join refsubjek		on refsubjek.id_subjek		= tblbuku.id_subjek
						WHERE tbbuku.id_subjek='".$val->validasi($_GET['id'], 'sql')."'  ORDER BY tblbuku.id_buku DESC LIMIT $posisi,$batas");
    $no = 1;
    $d = mysqli_fetch_array($kat);

    $no = 1;

    $jumlah = mysqli_num_rows($kat);
    // Apabila ditemukan berita dalam kategori
    if ($jumlah > 0) {

        while ($r = mysqli_fetch_array($kat)) {

            echo "
	  <div class='item  col-xs-4'>
            <div class='thumbnail'>
                <img class='group list-group-image'  alt='' />
                <div class='caption'>
                    <h5 class='group inner list-group-item-heading'>
                        $r[judul]</h5>
                    <p class='group inner list-group-item-text'>
                        <table class='table table-striped table-responsive'>
						<tr><td>Pengarang</td><td>:</td><td><b>$r[nama_pengarang]<b></td></tr>
						<tr><td>Penerbit</td><td>:</td><td><b>$r[nama_penerbit]<b></td></tr>
						</table>
						
						</p>
                    <div class='row abu' >
                        <div class='col-xs-12 col-md-6'>
						Jumlah
                            <p class='lead jml'>
                                $r[jumlahbuku]</p>
                        </div>
                        <div class='col-xs-12 col-md-6'>
                            <a class='btn btn-success' href='buku-$r[id_buku].html'>View Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	  ";
        }
        $jmldata = mysqli_num_rows(mysqli_query(KONEKSI, "SELECT * FROM tblbuku WHERE id_subjek='".$val->validasi($_GET['id'], 'sql')."' "));
        $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
        $linkHalaman = $p->navHalaman($_GET['halsubjek'], $jmlhalaman);
        echo "	
				
			</div>
		</div>
	</div>
	<div class='row clearfix'>
		<div class='col-md-4 column'>
		</div>
		<div class='col-md-4 column'>
			
			<div class='pages'>	$linkHalaman</div>
			
		</div>
		<div class='col-md-4 column'>
		</div>
	</div>";

    } else {
        echo "
	<div class='alert alert-dismissable alert-danger'>
				 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<h4>
					Info 
				</h4> <strong>Maaf</strong> Tidak ditemukan buku dalam kategori ini <b>$kata</b> <a href='#' class='alert-link'> </a>
			</div>
	";
    }
}

//ini bagian klasifikasi
if ($_GET['modul'] == 'detailklasifikasi') {

    echo " 
 <div class='col-md-12 column'>
 <div class='well well-sm'>
        <strong>Category Title</strong>
        <div class='btn-group'>
            <a href='#' id='list' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-th-list'>
            </span>List</a> <a href='#' id='grid' class='btn btn-default btn-sm'><span
                class='glyphicon glyphicon-th'></span>Grid</a>
				</div>
				 
				 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Kategori <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>";
    include 'config/koneksi.php';
    $kategori = mysqli_query(KONEKSI, 'select refkategori.nama_kategori, refkategori.id_kategori,
                         count(tblbuku.id_kategori) as jml 
                         from refkategori left join tblbuku 
                         on tblbuku.id_kategori=refkategori.id_kategori
                         group by refkategori.nama_kategori');
    while ($k = mysqli_fetch_array($kategori)) {

        echo "  
   <li><a href='kategori-$k[id_kategori].html'> $k[nama_kategori] </a></li>
    ";
    }
    echo "	
  </ul>
</div>

 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Subjek <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>";
    include 'config/koneksi.php';
    $subjek = mysqli_query(KONEKSI, 'select * from refsubjek');
    while ($s = mysqli_fetch_array($subjek)) {

        echo "  
   <li><a href='subjek-$s[id_subjek].html'> $s[nama_subjek] </a></li>
    ";
    }
    echo "
  </ul>
</div>

 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Klasifikasi <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>
    ";
    include 'config/koneksi.php';
    $klas = mysqli_query(KONEKSI, 'select * from refklasifikasi');
    while ($c = mysqli_fetch_array($klas)) {

        echo "  
   <li><a href='klasifikasi-$c[id_klasifikasi].html'> $c[nama_klasifikasi] </a></li>
    ";
    }
    echo "
  </ul>
</div>
		
    </div>
	
	<div id='products' class='row list-group'>
	";

    $p = new Paging5();
    $batas = 9;
    $posisi = $p->cariPosisi($batas);

    $kat = mysqli_query(KONEKSI, "SELECT tblbuku.id_buku, tblbuku.judul, tblbuku.id_pengarang, tblbuku.id_penerbit, tblbuku.jumlahbuku,
						refpengarang.id_pengarang, refpengarang.nama_pengarang,tblbuku.id_klasifikasi,
						refklasifikasi.id_klasifikasi,refklasifikasi.nama_klasifikasi,
						penerbit.id_penerbit, penerbit.nama_penerbit
						FROM tblbuku
						left join penerbit 		on penerbit.id_penerbit		= tblbuku.id_penerbit
						left join refpengarang		on refpengarang.id_pengarang		= tblbuku.id_pengarang
						left join refklasifikasi		on refklasifikasi.id_klasifikasi		= tblbuku.id_klasifikasi
						WHERE tblbuku.id_klasifikasi='".$val->validasi($_GET['id'], 'sql')."'  ORDER BY tblbuku.id_buku DESC LIMIT $posisi,$batas");
    $no = 1;
    $d = mysqli_fetch_array($kat);

    $no = 1;

    $jumlah = mysqli_num_rows($kat);
    // Apabila ditemukan berita dalam kategori
    if ($jumlah > 0) {

        while ($r = mysqli_fetch_array($kat)) {

            echo "
	  <div class='item  col-xs-4'>
            <div class='thumbnail'>
                <img class='group list-group-image'  alt='' />
                <div class='caption'>
                    <h5 class='group inner list-group-item-heading'>
                        $r[judul]</h5>
                    <p class='group inner list-group-item-text'>
                        <table class='table table-striped table-responsive'>
						<tr><td>Pengarang</td><td>:</td><td><b>$r[nama_pengarang]<b></td></tr>
						<tr><td>Penerbit</td><td>:</td><td><b>$r[nama_penerbit]<b></td></tr>
						</table>
						
						</p>
                    <div class='row abu' >
                        <div class='col-xs-12 col-md-6'>
						Jumlah
                            <p class='lead jml'>
                                $r[jumlahbuku]</p>
                        </div>
                        <div class='col-xs-12 col-md-6'>
                            <a class='btn btn-success' href='buku-$r[id_buku].html'>View Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	  ";
        }
        $jmldata = mysqli_num_rows(mysqli_query(KONEKSI, "SELECT * FROM tblbuku WHERE id_klasifikasi='".$val->validasi($_GET['id'], 'sql')."' "));
        $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
        $linkHalaman = $p->navHalaman($_GET['halklasifikasi'], $jmlhalaman);
        echo "	
				
			</div>
		</div>
	</div>
	<div class='row clearfix'>
		<div class='col-md-4 column'>
		</div>
		<div class='col-md-4 column'>
			
			<div class='pages'>	$linkHalaman</div>
			
		</div>
		<div class='col-md-4 column'>
		</div>
	</div>";

    } else {
        echo "
	<div class='alert alert-dismissable alert-danger'>
				 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<h4>
					Info 
				</h4> <strong>Maaf</strong> Tidak ditemukan buku dalam kategori ini <b>$kata</b> <a href='#' class='alert-link'> </a>
			</div>
	";
    }
}

//mencari jurnal berdasarkan judul

if ($_GET['modul'] == 'carijudul') {
    echo "
 <div class='col-md-12 column'>
 <div class='well well-sm'>
        <strong>Category Title</strong>
        <div class='btn-group'>
            <a href='#' id='list' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-th-list'>
            </span>List</a> <a href='#' id='grid' class='btn btn-default btn-sm'><span
                class='glyphicon glyphicon-th'></span>Grid</a>
				</div>
				 
				 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Kategori <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>";
    include 'config/koneksi.php';
    $kategori = mysqli_query(KONEKSI, 'select refkategori.nama_kategori, refkategori.id_kategori,
                         count(tblbuku.id_kategori) as jml 
                         from refkategori left join tblbuku 
                         on tblbuku.id_kategori=refkategori.id_kategori
                         group by refkategori.nama_kategori');
    while ($k = mysqli_fetch_array($kategori)) {

        echo "  
   <li><a href='kategori-$k[id_kategori].html'> $k[nama_kategori] </a></li>
    ";
    }
    echo "	
  </ul>
</div>

 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Subjek <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>";
    include 'config/koneksi.php';
    $subjek = mysqli_query(KONEKSI, 'select * from refsubjek');
    while ($s = mysqli_fetch_array($subjek)) {

        echo "  
   <li><a href='subjek-$s[id_subjek].html'> $s[nama_subjek] </a></li>
    ";
    }
    echo "
  </ul>
</div>

 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Klasifikasi <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>
    ";
    include 'config/koneksi.php';
    $klas = mysqli_query(KONEKSI, 'select * from refklasifikasi');
    while ($c = mysqli_fetch_array($klas)) {

        echo "  
   <li><a href='klasifikasi-$c[id_klasifikasi].html'> $c[nama_klasifikasi] </a></li>
    ";
    }
    echo "
  </ul>
</div>
		
    </div>
	
	<div id='products' class='row list-group'>
	";

    $kata = trim($_POST['kata']);
    // mencegah XSS
    $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);

    // pisahkan kata per kalimat lalu hitung jumlah kata
    $pisah_kata = explode(' ', $kata);
    $jml_katakan = (int) count($pisah_kata);
    $jml_kata = $jml_katakan - 1;

    $cari = 'SELECT tblbuku.id_buku, tblbuku.judul, tblbuku.id_pengarang, tblbuku.id_penerbit, tblbuku.jumlahbuku,
						refpengarang.id_pengarang, refpengarang.nama_pengarang,
						penerbit.id_penerbit, penerbit.nama_penerbit
						FROM tblbuku
						left join penerbit 		on penerbit.id_penerbit		= tblbuku.id_penerbit
						left join refpengarang		on refpengarang.id_pengarang		= tblbuku.id_pengarang  WHERE ';
    for ($i = 0; $i <= $jml_kata; $i++) {
        $cari .= "tblbuku.judul LIKE '%$pisah_kata[$i]%' ";
        if ($i < $jml_kata) {
            $cari .= ' OR ';
        }
    }
    $cari .= ' ORDER BY tblbuku.id_buku DESC';
    $hasil = mysqli_query(KONEKSI, $cari);
    $ketemu = mysqli_num_rows($hasil);

    if ($ketemu > 0) {

        while ($t = mysqli_fetch_array($hasil)) {

            echo "		<div class='item  col-xs-4'>
            <div class='thumbnail'>
                <img class='group list-group-image'  alt='' />
                <div class='caption'>
                    <h5 class='group inner list-group-item-heading'>
                        $t[judul]</h5>
                    <p class='group inner list-group-item-text'>
                        <table class='table table-striped table-responsive'>
						<tr><td>Pengarang</td><td>:</td><td><b>$t[nama_pengarang]<b></td></tr>
						<tr><td>Penerbit</td><td>:</td><td><b>$t[nama_penerbit]<b></td></tr>
						</table>
						
						</p>
                    <div class='row abu' >
                        <div class='col-xs-12 col-md-6'>
						Jumlah
                            <p class='lead jml'>
                                $t[jumlahbuku]</p>
                        </div>
                        <div class='col-xs-12 col-md-6'>
                            <a class='btn btn-success' href='buku-$t[id_buku].html'>View Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }
    } else {
        echo "
	<div class='alert alert-dismissable alert-danger'>
				 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<h4>
					Info 
				</h4> <strong>Maaf</strong> Tidak ditemukan buku dengan Judul <b>$kata</b> <a href='#' class='alert-link'> link</a>
			</div>";
    }

    echo '	
				
			</div>
		</div>
	</div>';
}

//mencari jurnal berdasarkan penulis

if ($_GET['modul'] == 'caripenulis') {
    echo " 
 <div class='col-md-12 column'>
 <div class='well well-sm'>
        <strong>Category Title</strong>
        <div class='btn-group'>
            <a href='#' id='list' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-th-list'>
            </span>List</a> <a href='#' id='grid' class='btn btn-default btn-sm'><span
                class='glyphicon glyphicon-th'></span>Grid</a>
				</div>
				 
				 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Kategori <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>";
    include 'config/koneksi.php';
    $kategori = mysqli_query(KONEKSI, 'select refkategori.nama_kategori, refkategori.id_kategori,
                         count(tblbuku.id_kategori) as jml 
                         from refkategori left join tblbuku 
                         on tblbuku.id_kategori=refkategori.id_kategori
                         group by refkategori.nama_kategori');
    while ($k = mysqli_fetch_array($kategori)) {

        echo "  
   <li><a href='kategori-$k[id_kategori].html'> $k[nama_kategori] </a></li>
    ";
    }
    echo "	
  </ul>
</div>

 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Subjek <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>";
    include 'config/koneksi.php';
    $subjek = mysqli_query(KONEKSI, 'select * from refsubjek');
    while ($s = mysqli_fetch_array($subjek)) {

        echo "  
   <li><a href='subjek-$s[id_subjek].html'> $s[nama_subjek] </a></li>
    ";
    }
    echo "
  </ul>
</div>

 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Klasifikasi <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>
    ";
    include 'config/koneksi.php';
    $klas = mysqli_query(KONEKSI, 'select * from refklasifikasi');
    while ($c = mysqli_fetch_array($klas)) {

        echo "  
   <li><a href='klasifikasi-$c[id_klasifikasi].html'> $c[nama_klasifikasi] </a></li>
    ";
    }
    echo "
  </ul>
</div>
		
    </div>
	
	<div id='products' class='row list-group'>
	";
    $kata = trim($_POST['kata']);
    // mencegah XSS
    $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);

    // pisahkan kata per kalimat lalu hitung jumlah kata
    $pisah_kata = explode(' ', $kata);
    $jml_katakan = (int) count($pisah_kata);
    $jml_kata = $jml_katakan - 1;

    $cari = 'SELECT tblbuku.id_buku, tblbuku.judul, tblbuku.id_pengarang, tblbuku.id_penerbit, tblbuku.jumlahbuku,
						refpengarang.id_pengarang, refpengarang.nama_pengarang,
						penerbit.id_penerbit, penerbit.nama_penerbit
						FROM tblbuku
						left join penerbit 		on penerbit.id_penerbit		= tblbuku.id_penerbit
						left join refpengarang		on refpengarang.id_pengarang		= tblbuku.id_pengarang  WHERE ';
    for ($i = 0; $i <= $jml_kata; $i++) {
        $cari .= "refpengarang.nama_pengarang LIKE '%$pisah_kata[$i]%'";
        if ($i < $jml_kata) {
            $cari .= ' OR ';
        }
    }
    $cari .= ' ORDER BY tblbuku.id_buku DESC';
    $hasil = mysqli_query(KONEKSI, $cari);
    $ketemu = mysqli_num_rows($hasil);

    if ($ketemu > 0) {

        while ($t = mysqli_fetch_array($hasil)) {

            echo "				<div class='item  col-xs-4'>
            <div class='thumbnail'>
                <img class='group list-group-image'  alt='' />
                <div class='caption'>
                    <h5 class='group inner list-group-item-heading'>
                        $t[judul]</h5>
                    <p class='group inner list-group-item-text'>
                        <table class='table table-striped table-responsive'>
						<tr><td>Pengarang</td><td>:</td><td><b>$t[nama_pengarang]<b></td></tr>
						<tr><td>Penerbit</td><td>:</td><td><b>$t[nama_penerbit]<b></td></tr>
						</table>
						
						</p>
                    <div class='row abu' >
                        <div class='col-xs-12 col-md-6'>
						Jumlah
                            <p class='lead jml'>
                                $t[jumlahbuku]</p>
                        </div>
                        <div class='col-xs-12 col-md-6'>
                            <a class='btn btn-success' href='buku-$t[id_buku].html'>View Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }
    } else {
        echo "
	<div class='alert alert-dismissable alert-danger'>
				 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<h4>
					Info 
				</h4> <strong>Maaf</strong> Tidak ditemukan buku dengan Pengarang <b>$kata</b> <a href='#' class='alert-link'> </a>
			</div>";
    }

    echo '	
				
			</div>
		</div>
	</div>';
}

if ($_GET['modul'] == 'jurnal') {
    echo " 
 <div class='col-md-12 column'>
 <div class='well well-sm'>
        <strong>Category Title</strong>
        
				 
				 <div class='btn-group'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
    Kategori <span class='caret'></span>
  </button>
  <ul class='dropdown-menu' role='menu'>";
    include 'config/koneksi.php';
    $kategori = mysqli_query(KONEKSI, 'select katjurnal.nama_kategori, katjurnal.id_kategori,
                         count(jurnal.id_kategori) as jml 
                         from katjurnal left join jurnal 
                         on jurnal.id_kategori=katjurnal.id_kategori
                         group by katjurnal.nama_kategori');
    while ($k = mysqli_fetch_array($kategori)) {

        echo "  
   <li><a href='katjurnal-$k[id_kategori].html'> $k[nama_kategori] </a></li>
    ";
    }
    echo "	
  </ul>
</div>


		
    </div>
	
	<div id='products' class='row list-group'>
	";
    if (empty($_GET['kata'])) {
        $p = new Paging2();
        $batas = 9;
        $posisi = $p->cariPosisi($batas);

        $tampil = mysqli_query(KONEKSI, "SELECT jurnal.id_jurnal,jurnal.abstrak, jurnal.judul, jurnal.penulis, jurnal.tgl_posting,
						katjurnal.id_kategori, katjurnal.nama_kategori
						FROM jurnal , katjurnal
						WHERE jurnal.id_kategori = katjurnal.id_kategori				
						ORDER BY jurnal.id_jurnal DESC LIMIT $posisi,$batas
						");
        $no = 1;
        while ($r = mysqli_fetch_array($tampil)) {
            $tgl = tgl_indo($r['tgl_posting']);
            echo "
            
				<div class='col-md-4'>
					<div class='thumbnail'>
						<img src='img/jurnal.jpg'>
						<div class='caption'>
							<blockquote>
				<p>";
            $position1 = 100; // Define how many character you want to display.

            $message1 = "$r[judul]";
            $post1 = substr($message1, 0, $position1);

            echo $post1;
            echo "...
					 
				</p> <small>$r[penulis]</cite></small>
			</blockquote>
							<p>";

            $position = 150; // Define how many character you want to display.

            $message = "$r[abstrak]";
            $post = substr($message, 0, $position);

            echo $post;
            echo '...';

            echo "
	
								
							</p>
							<p>
								<a class='btn btn-primary' href='jurnal-$r[id_jurnal].html'>Tampilkan</a> 
							</p>
						</div>
					</div>
				</div>";
        }
        $jmldata = mysqli_num_rows(mysqli_query(KONEKSI, 'SELECT * FROM jurnal'));
        $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
        $linkHalaman = $p->navHalaman($_GET['haljurnal'], $jmlhalaman);

        echo "	
				</div>
			</div>
		</div>
	</div>
	<div class='row clearfix'>
		<div class='col-md-4 column'>
		</div>
		<div class='col-md-4 column'>
			
			<div class='pages'>	$linkHalaman</div>
			
		</div>
		<div class='col-md-4 column'>
		</div>
	</div>";

    }
}

//detailjurnal

if ($_GET['modul'] == 'detailjurnal') {
    $detail = mysqli_query(KONEKSI, "SELECT * FROM jurnal,katjurnal    
                      WHERE katjurnal.id_kategori=jurnal.id_kategori AND jurnal.status='PUBLISH'
                      AND id_jurnal='".$val->validasi($_GET['id'], 'sql')."'");
    $d = mysqli_fetch_array($detail);

    echo "
	
	
	
	<div class='panel panel-default'>
				<div class='panel-heading' id='abu'>
					<h3 class='panel-title'>
					
				<p>
					<h4>$d[judul]</h4>
				</p> 
			
						
					</h3>
				</div>
				<div class='panel-body'>
				   <table id='tbl'>
				   <tr><td class='kc'>Penulis <td class='bc'>:</td></td> <td><b>  $d[penulis]</b></td></tr>
				   <tr><td class='kc'>Kategori <td class='bc' >:</td></td> <td> <b>  $d[nama_kategori]</b></td></tr>
				   <tr><td class='kc'>Tanggal Posting <td class='bc'>:</td></td> <td> <b>   $d[tgl_posting]</b></td></tr>
				   <tr><td class='kc'>Abstrak <td>:</td class='bc'></td><td>   $d[abstrak]</td></tr>
				   </table>
				</div>
				<div class='panel-footer'>
				
					 <a href='downlot.php?file=$d[file]'><button type='button' class='btn btn-primary'>Download</button></a>
				
				</div>
			</div>";

}

?>
    
    
    
    
    
</div>
</body>
<script>
$(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
});
</script>
</html>
