<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {
    $aksi = 'modul/peminjaman/aksi_peminjaman.php';
    switch ($_GET['act']) {
        default:

            $p = new Paging();
            $batas = 10;
            $posisi = $p->cariPosisi($batas);
            echo "
   <div class='span12 kotak' >
  <h4 align=center>Peminjaman Buku</h4>
  <hr>
  <div class='kotaksirkulasi'>
  <form class='form-horizontal' method=POST action='$aksi?modul=peminjaman&act=validasi' enctype='multipart/form-data'>
  <table>
  <tr><td>No. Anggota </td><td>:</td><td><input class='input-large' type='text' name='noanggota' placeholder='Masukan No anggota'></td>
  <td>Kode Eksemplar Buku </td><td>:</td><td><input class='input-large' type='text' name='kdeksemplar' placeholder='Masukan Kode Eksemplar Buku'></td>
  <td><input type=submit class='btn btn-warning'  value='Proses'></td> </tr>
  </table>
  
  </form>
  </div>
  
 
  <hr>
        <table class='table table-hover table-striped'>  
		<thead>
          <tr><th width='50px'>No</th><th>Buku</th><th>Peminjam</th><th>Status</th><th>Pinjam</th><th>Tempo</th><th>Kembali</th><th >Pilihan</th></tr>
		</thead>";

            $p = new Paging();
            $batas = 5;
            $posisi = $p->cariPosisi($batas);

            $tampil = mysqli_query(KONEKSI, "
			select 
				sirkulasi.notransaksi,		sirkulasi.tglpinjam,
				sirkulasi.tgljtempo,		sirkulasi.status,
				sirkulasi.tglkembali,		sirkulasi.denda,
				anggota.noanggota,			anggota.nama as nama_anggota,
				tblbuku.kdbuku,				tblbuku.judul
				
			from sirkulasi
			left join anggota 		on anggota.noanggota		= sirkulasi.noanggota
			left join tblbuku 		on tblbuku.kdbuku			= sirkulasi.kdbuku
		
			
			WHERE sirkulasi.status = 'BELUM'
	  ORDER BY sirkulasi.tglpinjam DESC LIMIT  $posisi,$batas
 ");

            $no = $posisi + 1;
            while ($r = mysqli_fetch_array($tampil)) {

                echo "<tr><td>$no</td>
                <td>
					<b>$r[kdbuku]</b> <br>
					$r[judul]
				</td>
               
				<td>
					<b>$r[noanggota]</b><br>
					$r[nama_anggota]
				</td>
                <td>$r[status]</td>
                <td>$r[tglpinjam]</td>
				<td>$r[tgljtempo]</td>
				<td>$r[tglkembali]</td>
				<td>  <a href=?modul=peminjaman&act=view&id=$r[notransaksi]>
						<input type=button class='btn btn-primary btn-small' value='view' Detail'/>
						</a>
										
					</a>
				      <a href=?modul=peminjaman&act=edit&id=$r[notransaksi]>
						<input type=button class='btn btn-info btn-small' value='edit'/>
					</a>
	                 
		        </tr>";
                $no++;
            }
            echo '</table>';
            $jmldata = mysqli_num_rows(mysqli_query(KONEKSI, "SELECT * FROM sirkulasi where status ='BELUM' "));

            $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
            $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

            echo "
	<div class='span3'></div>
	<div class='span6'>
	<div class='pagination'>
	<ul> $linkHalaman<ul></div>
	<div>
	<div class='span3'></div>
	";

            break;

        case 'step2' :
            echo "
	 <div class='span12 kotak' >
	  <h4 align=center>Lanjutkan</h4>
	  <hr>
	  <div class='kotaksirkulasi'>
	  <form class='form-horizontal' method=POST action='$aksi?modul=peminjaman&act=save' enctype='multipart/form-data'>
	  <table>
		  <tr>
			<input type='hidden' name='noanggota' value='".$_GET['noanggota']."' />
			<input type='hidden' name='kdeksemplar' value='".$_GET['kdeksemplar']."' />
			<td>Tgl jatuh tempo</td>
			<td>:</td>
			<td>
			<input id='example1' type='text' name='tgljtempo'  placeholder='Masukan tgl jatuh tempo' value='".$_GET['tgljtempo']."'></td>
			<td>Denda </td>
			<td>:</td>
			<td><input class='input-large' type='text' name='denda' placeholder='Masukan Denda per hari'></td>
			<td><input type=submit class='btn btn-warning'  value='Save'></td>
		  </tr>
	  </table>
	  
	  </form>
	  </div>
	  ";
            break;

        case 'edit':
            $edit = mysqli_query(KONEKSI, "
		select 
				sirkulasi.notransaksi,		sirkulasi.tglpinjam,
				sirkulasi.tgljtempo,		sirkulasi.status,
				sirkulasi.tglkembali,		sirkulasi.denda,
				anggota.noanggota,			anggota.nama as nama_anggota,
				tblbuku.kdbuku,				tblbuku.judul,
				petugas.id,					petugas.nama,
				tbleksemplar.kdeksemplar
			from sirkulasi
			left join anggota 		on anggota.noanggota		= sirkulasi.noanggota
			left join tblbuku 		on tblbuku.kdbuku			= sirkulasi.kdbuku
			left join petugas		on petugas.id				= sirkulasi.idpetugasserah
			left join tbleksemplar 	on tbleksemplar.kdeksemplar	= sirkulasi.kdeksemplar
		WHERE notransaksi ='$_GET[id]'
	");

            $r = mysqli_fetch_array($edit);

            echo "
		  <div class='span12 kotak' >
  <h4 align=center>Edit Peminjaman</h4>
  <hr>
        <form class='form-horizontal' method='POST' action='$aksi?modul=peminjaman&act=update' enctype='multipart/form-data'>
		 <input type=hidden name=id value=$r[notransaksi]>
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
			<tr>
				<td>Nomor Anggotas</td>
				<td><input type='text' class='input-xxlarge' value='$r[noanggota]' name='noanggota'/></td>
			</tr>
			<tr>
				<td>Kode buku</td>
				<td><input type='text' class='input-xxlarge' value='$r[kdbuku]' name='kdbuku'/></td>
			</tr>
			<tr>
				<td>Kode Eksemplar</td>
				<td><input type='text' class='input-xxlarge' value='$r[kdeksemplar]' name='kdeksemplar'/></td>
			</tr>
			<tr>
				<td>Tanggal pinjam</td>
				<td><input type='text' class='input-xxlarge' value='$r[tglpinjam]' name='tglpinjam'/></td>
			</tr>
			<tr>
				<td>Jatuh tempo</td>
				<td><input type='text' class='input-xxlarge' value='$r[tgljtempo]' name='tgljtempo'/></td>
			</tr>
			<tr>
				<td>Denda per-hari</td>
				<td><input type='text' class='input-xxlarge' value='$r[denda]' name='denda'/></td>
			</tr>
			<tr>
				<td>Status</td>
				<td>
					<select name='status' class='form-control' >";
            if ($r['status'] == 'BELUM') {
                echo "
								<option value='BELUM' selected>BELUM</option>
								<option value='SUDAH'>SUDAH</option>
							";
            } else {
                echo "
								<option value='BELUM'>BELUM</option>
								<option value='SUDAH' selected>SUDAH</option>
							";
            }
            echo "		</select>
				</td>
			</tr>
			<tr>
				<td><input type=submit class='btn btn-primary' value='Update'></td>
			</tr>
        </table>
		
    </form>";
            break;

        case 'view':
            $edit = mysqli_query(KONEKSI, "
		select 
				sirkulasi.notransaksi,		sirkulasi.tglpinjam,
				sirkulasi.tgljtempo,		sirkulasi.status,
				sirkulasi.tglkembali,		sirkulasi.denda,
				anggota.noanggota,			anggota.nama as nama_anggota,
				anggota.alamat,				anggota.notelp,
				anggota.status as status_anggota,
				tblbuku.kdbuku,				tblbuku.judul,
				petugas.id,					petugas.nama,
				tbleksemplar.kdeksemplar
			from sirkulasi
			left join anggota 		on anggota.noanggota		= sirkulasi.noanggota
			left join tblbuku 		on tblbuku.kdbuku			= sirkulasi.kdbuku
			left join petugas		on petugas.id				= sirkulasi.idpetugasserah
			left join tbleksemplar 	on tbleksemplar.kdeksemplar	= sirkulasi.kdeksemplar
		WHERE notransaksi ='$_GET[id]'");

            $r = mysqli_fetch_array($edit);

            echo "
		  <div class='span12 kotak' >
  <h4 align=center>Detail Peminjaman</h4>
  <hr>
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
			<tr>
				<td width=200px>Nomor transaksi</td>
				<td>: $r[notransaksi]</td>
			</tr>
			<tr>
				<td>Peminjam</td>
				<td></td>
			</tr>
			<tr>
				<td style='text-align:right;font-size:13px'>Nomor Anggota</td>
				<td>: $r[noanggota]</td>
			</tr>
			<tr>
				<td style='text-align:right;font-size:13px'>Nama</td>
				<td>: $r[nama_anggota]</td>
			</tr>
			<tr>
				<td style='text-align:right;font-size:13px'>Alamat</td>
				<td>: $r[alamat]</td>
			</tr>
			<tr>
				<td style='text-align:right;font-size:13px'>Phone</td>
				<td>: $r[notelp]</td>
			</tr>
			<tr>
				<td style='text-align:right;font-size:13px'>Status</td>
				<td>: $r[status_anggota]</td>
			</tr>
			<tr>
				<td>Buku</td>
				<td></td>
			</tr>
			<tr>
				<td style='text-align:right;font-size:13px'>Kode buku</td>
				<td>: $r[kdbuku]</td>
			</tr>
			<tr>
				<td style='text-align:right;font-size:13px'>Judul</td>
				<td>: $r[judul]</td>
			</tr>
			<tr>
				<td style='text-align:right;font-size:13px'>Kode Eksemplar</td>
				<td>: $r[kdeksemplar]</td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td></td>
			</tr>
			<tr>
				<td style='text-align:right;font-size:13px'>Pinjam</td>
				<td>: $r[tglpinjam]</td>
			</tr>
			<tr>
				<td style='text-align:right;font-size:13px'>Jatuh tempo</td>
				<td>: $r[tgljtempo]</td>
			</tr>
			<tr>
				<td>Status Peminjaman</td>
				<td>: $r[status] DIKEMBALIKAN</td>
			</tr>
			<tr>
				<td>Petugas</td>
				<td>: $r[nama]</td>
			</tr>
        </table>
	</div>";
            break;

    }
}
