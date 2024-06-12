<?php

if (! isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href=../../index.php><b>LOGIN</b></a></center>';
} else {
    $aksi = 'modul/pengembalian/aksi_pengembalian.php';
    switch ($_GET['act']) {
        default:

            $p = new Paging();
            $batas = 5;
            $posisi = $p->cariPosisi($batas);
            echo "
   <div class='span12 kotak' >
  <h4 align=center>Pengembalian Buku</h4>
  <hr>
  <div class='kotaksirkulasi'>
  <form class='form-horizontal' method=POST action='$aksi?modul=pengembalian&act=proses' enctype='multipart/form-data'>
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
          <tr><th width='50px'>No</th><th>Buku</th><th>Peminjam</th><th>Status</th><th>Pinjam</th><th>Tempo</th><th>Kembali</th><th>Denda</th><th >Pilihan</th></tr>
		</thead>";

            $tampil = mysqli_query(KONEKSI, "
			select 
				sirkulasi.notransaksi,		sirkulasi.tglpinjam,
				sirkulasi.tgljtempo,		sirkulasi.status,
				sirkulasi.tglkembali,		sirkulasi.denda,
				anggota.noanggota,			anggota.nama as nama_anggota,
				tblbuku.kdbuku,				tblbuku.judul,
				
				denda.telat,				denda.denda
			from sirkulasi
			left join anggota 		on anggota.noanggota		= sirkulasi.noanggota
			left join tblbuku 		on tblbuku.kdbuku			= sirkulasi.kdbuku
			left join denda	 		on denda.notransaksi		= sirkulasi.notransaksi
			WHERE sirkulasi.status = 'BELUM' ORDER BY sirkulasi.tglkembali DESC LIMIT $posisi,$batas
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

				<td>";
                if ($r['denda'] != '') {
                    echo "
							$r[denda]<br>($r[telat] hari)
						";
                }

                echo "	</td>
				<td>  <a href=?modul=pengembalian&act=view&id=$r[notransaksi]>
						<input type=button class='btn btn-primary btn-small' value='view' Detail'/>
						</a>
										
					</a>
				      <a href=?modul=pengembalian&act=edit&id=$r[notransaksi]>
						<input type=button class='btn btn-info btn-small' value='edit'/>
					</a>
	                 
		        </tr>";
                $no++;
            }
            echo '</table>';
            $jmldata = mysqli_num_rows(mysqli_query(KONEKSI, "SELECT * FROM sirkulasi where status ='BELUM'  "));

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

        case 'edit':
            $edit = mysqli_query(KONEKSI, "
		select 
				sirkulasi.notransaksi,		sirkulasi.tglpinjam,
				sirkulasi.tgljtempo,		sirkulasi.status,
				sirkulasi.tglkembali,		sirkulasi.denda,
				anggota.noanggota,			anggota.nama as nama_anggota,
				tblbuku.kdbuku,				tblbuku.judul,
				petugas.id,					petugas.nama,
				tbleksemplar.kdeksemplar,
				denda.telat,				denda.denda as total_denda
			from sirkulasi
			left join anggota 		on anggota.noanggota		= sirkulasi.noanggota
			left join tblbuku 		on tblbuku.kdbuku			= sirkulasi.kdbuku
			left join petugas		on petugas.id				= sirkulasi.idpetugasterima
			left join tbleksemplar 	on tbleksemplar.kdeksemplar	= sirkulasi.kdeksemplar
			left join denda	 		on denda.notransaksi		= sirkulasi.notransaksi
		WHERE sirkulasi.notransaksi ='$_GET[id]'
	");

            $r = mysqli_fetch_array($edit);

            echo "
		  <div class='span12 kotak' >
  <h4 align=center>Edit pengembalian</h4>
  <hr>
        <form class='form-horizontal' method='POST' action='$aksi?modul=pengembalian&act=update' enctype='multipart/form-data'>
		 <input type=hidden name=id value=$r[notransaksi]>
		<table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
			<tr>
				<td>Peminjam</td>
				<td><b>$r[noanggota]</b> / $r[nama_anggota]</td>
			</tr>
			<tr>
				<td>Buku</td>
				<td><b>$r[kdeksemplar]</b> / $r[judul]</td>
			</tr>
			<tr>
				<td>Tanggal pinjam</td>
				<td>$r[tglpinjam]</td>
			</tr>
			<tr>
				<td>Jatuh tempo</td>
				<td>$r[tgljtempo]</td>
			</tr>
			<tr>
				<td>Tangal kembali</td>
				<td><input type='text' class='input-xxlarge' value='$r[tglkembali]' name='tglkembali'/></td>
			</tr>
			<tr>
				<td>Denda per-hari</td>
				<td><input type='text' class='input-xxlarge' value='$r[denda]' name='denda'/></td>
			</tr>
			<tr>
				<td>Telat (hari)</td>
				<td><input type='text' class='input-xxlarge' value='$r[telat]' name='telat'/></td>
			</tr>
			<tr>
				<td>Total Denda</td>
				<td><input type='text' class='input-xxlarge' value='$r[total_denda]' name='total_denda'/></td>
			</tr>
			<tr>
				<td>Status pengembalian</td>
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
				tblbuku.kdbuku,				tblbuku.judul,
				petugas.id,					petugas.nama,
				tbleksemplar.kdeksemplar,
				denda.telat,				denda.denda as total_denda
			from sirkulasi
			left join anggota 		on anggota.noanggota		= sirkulasi.noanggota
			left join tblbuku 		on tblbuku.kdbuku			= sirkulasi.kdbuku
			left join petugas		on petugas.id				= sirkulasi.idpetugasterima
			left join tbleksemplar 	on tbleksemplar.kdeksemplar	= sirkulasi.kdeksemplar
			left join denda	 		on denda.notransaksi		= sirkulasi.notransaksi
		WHERE sirkulasi.notransaksi ='$_GET[id]'");

            $r = mysqli_fetch_array($edit);

            echo "
  <h4 align=center>Detail Pengembalian</h4>
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
				<td style='text-align:right;font-size:13px'>Kembali</td>
				<td>: $r[tglkembali]</td>
			</tr>
			<tr>
				<td>Status pengembalian</td>
				<td>: $r[status] DIKEMBALIKAN</td>
			</tr>
			<tr>
				<td>Petugas</td>
				<td>: $r[nama]</td>
			</tr>
			<tr>
				<td>Denda</td>
				<td></td>
			</tr>
			<tr>
				<td style='text-align:right;font-size:13px'>Denda per hari</td>
				<td>: $r[denda]</td>
			</tr>
			<tr>
				<td style='text-align:right;font-size:13px'>Telat (hari)</td>
				<td>: $r[telat]</td>
			</tr>
			<tr>
				<td style='text-align:right;font-size:13px'>Total Denda</td>
				<td>: $r[total_denda]</td>
			</tr>
        </table>
	</div>";
            break;

    }
}
