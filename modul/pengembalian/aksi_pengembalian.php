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

    $modul = $_GET['modul'];
    $act = $_GET['act'];

    if ($modul == 'pengembalian' and $act == 'proses') {
        $noanggota = $_POST['noanggota'];
        $kdeksemplar = $_POST['kdeksemplar'];
        if (! empty($noanggota) and ! empty($kdeksemplar)) {
            $cek_sirkulasi = mysqli_query(KONEKSI, "select * from sirkulasi where kdeksemplar = '$kdeksemplar' AND status='BELUM' AND noanggota='$noanggota'");
            if (mysqli_num_rows($cek_sirkulasi) > 0) {
                $sirkulasi = mysqli_fetch_array($cek_sirkulasi);
                $notransaksi = $sirkulasi['notransaksi'];
                $tgljtempo = $sirkulasi['tgljtempo'];
                $kdbuku = $sirkulasi['kdbuku'];
                $tglkembali = date('Y-m-d');
                $selisih = selisihHari($tgljtempo, $tglkembali);
                $denda = 0;
                if ($selisih > 0) {
                    $denda = $sirkulasi['denda'] * $selisih;
                    mysqli_query(KONEKSI, "
					insert into denda values ('$tglkembali',$notransaksi,$selisih,$denda)
				");
                }
                mysqli_query(KONEKSI, "
				update sirkulasi
				set
					status		= 'SUDAH',
					tglkembali	= '$tglkembali',
					idpetugasterima	= '".$_SESSION['namauser']."'
				where
					notransaksi	= '$notransaksi'
			");

                $jml = mysqli_query(KONEKSI, "SELECT * FROM tblbuku WHERE kdbuku ='$kdbuku'");
                $r = mysqli_fetch_array($jml);
                $awal = $r['tersedia'];
                $hsl = $awal + 1;

                mysqli_query(KONEKSI, "UPDATE tblbuku SET tersedia = '$hsl'
					                WHERE kdbuku = '$kdbuku'");

                echo "<script>alert('Proses pengembalian berhasil. Denda : Rp.".$denda."');
			window.location=('../../home.php?modul=$modul')</script>";
            } else {
                echo "<script>alert('Maaf, Nomor anggota atau Kode eksemplar tidak valid');
			window.location=('../../home.php?modul=$modul')</script>";
            }
        } else {
            echo "<script>alert('Data belum lengkap');
		window.location=('../../home.php?modul=$modul')</script>";
        }
    }

    // Update
    elseif ($modul == 'pengembalian' and $act == 'update') {
        $id = $_POST['id'];
        $tglkembali = $_POST['tglkembali'];
        $denda = $_POST['denda'];
        $telat = $_POST['telat'];
        $total_denda = $_POST['total_denda'];
        $status = $_POST['status'];
        if ($tglkembali != '' and $denda != '' and $telat != '' and $total_denda != '') {
            mysqli_query(KONEKSI, "
			update sirkulasi
			set
				tglkembali		= '$tglkembali',
				denda			= '$denda',
				status			= '$status'
			where
				notransaksi	= $id
		");
            if ($telat > 0) {
                mysqli_query(KONEKSI, "
				update denda
				set
					tanggal			= '$tglkembali',
					telat			= '$telat',
					denda			= '$total_denda'
				where
					notransaksi	= $id
			");
            }
            echo "<script>alert('Peminjaman telah diubah');
		window.location=('../../home.php?modul=$modul')</script>";
        } else {
            echo "<script>alert('Data belum lengkap');
		window.location=('../../home.php?modul=$modul&act=edit&id=$id')</script>";
        }

    }
}
function selisihHari($tglAwal, $tglAkhir)
{
    // list tanggal merah selain hari minggu
    $tglLibur = ['2013-01-04', '2013-01-05', '2013-01-17'];

    // memecah string tanggal awal untuk mendapatkan
    // tanggal, bulan, tahun
    $pecah1 = explode('-', $tglAwal);
    $date1 = $pecah1[2];
    $month1 = $pecah1[1];
    $year1 = $pecah1[0];

    // memecah string tanggal akhir untuk mendapatkan
    // tanggal, bulan, tahun
    $pecah2 = explode('-', $tglAkhir);
    $date2 = $pecah2[2];
    $month2 = $pecah2[1];
    $year2 = $pecah2[0];

    // mencari selisih hari dari tanggal awal dan akhir
    $jd1 = gregoriantojd($month1, $date1, $year1);
    $jd2 = gregoriantojd($month2, $date2, $year2);

    $selisih = $jd2 - $jd1;

    return $selisih;
}
