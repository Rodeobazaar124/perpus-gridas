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

    if ($modul == 'peminjaman' and $act == 'validasi') {
        $noanggota = $_POST['noanggota'];
        $kdeksemplar = $_POST['kdeksemplar'];
        if (! empty($noanggota) and ! empty($kdeksemplar)) {
            $cek_anggota = mysqli_query(KONEKSI, "select * from anggota where noanggota = '$noanggota'");
            if (mysqli_num_rows($cek_anggota) > 0) {
                $cek_buku = mysqli_query(KONEKSI, "select * from tbleksemplar where kdeksemplar = '$kdeksemplar'");
                if (mysqli_num_rows($cek_buku) > 0) {
                    $cek_sirkulasi = mysqli_query(KONEKSI, "select * from sirkulasi where kdeksemplar = '$kdeksemplar' AND status='BELUM' ");
                    if (mysqli_num_rows($cek_sirkulasi) == 0) {
                        $tglpinjam = date('Y-m-d');
                        $tempo = 7;
                        $tgljtempo = strtotime('+'.$tempo.' day', strtotime($tglpinjam));
                        $tgljtempo = date('Y-m-d', $tgljtempo);
                        header("location:../../home.php?modul=$modul&act=step2&noanggota=$noanggota&kdeksemplar=$kdeksemplar&tgljtempo=$tgljtempo");
                    } else {
                        $buku = mysqli_fetch_array($cek_buku);
                        $kdbuku = $buku['kdbuku'];
                        $qry_buku = mysqli_query(KONEKSI, "select * from tblbuku where kdbuku = '$kdbuku'");
                        $buku = mysqli_fetch_array($qry_buku);
                        echo "<script>alert('Maaf, buku \'".$buku['judul']."\' dengan kode eksemplar \'".$kdeksemplar."\' saat ini tidak tersedia');
					window.location=('../../home.php?modul=$modul')</script>";
                    }
                } else {
                    echo "<script>alert('Kode eksemplar tidak valid');
				window.location=('../../home.php?modul=$modul')</script>";
                }
            } else {
                echo "<script>alert('Nomor anggota tidak valid');
			window.location=('../../home.php?modul=$modul')</script>";
            }
        } else {
            echo "<script>alert('Data belum lengkap');
		window.location=('../../home.php?modul=$modul')</script>";
        }
    } elseif ($modul == 'peminjaman' and $act == 'save') {
        $noanggota = $_POST['noanggota'];
        $kdeksemplar = $_POST['kdeksemplar'];
        $tgljtempo = $_POST['tgljtempo'];
        $denda = $_POST['denda'];
        $cek_buku = mysqli_query(KONEKSI, "select * from tbleksemplar where kdeksemplar = '$kdeksemplar'");
        $buku = mysqli_fetch_array($cek_buku);
        $kdbuku = $buku['kdbuku'];
        //$cek_user		= mysqli_query(KONEKSI, "select * from users where username = '$_SESSION[namauser]'");
        $idpetugas = $_SESSION['namauser'];
        $tglpinjam = date('Y-m-d');

        mysqli_query(KONEKSI, "
		insert into sirkulasi
		(noanggota, kdbuku, tglpinjam, tgljtempo, denda, idpetugasserah, kdeksemplar)
		values ('$noanggota', '$kdbuku', '$tglpinjam', '$tgljtempo', '$denda', '$idpetugas', '$kdeksemplar')
	");

        $jml = mysqli_query(KONEKSI, "SELECT * FROM tblbuku WHERE kdbuku ='$kdbuku'");
        $r = mysqli_fetch_array($jml);
        $awal = $r['tersedia'];
        $hsl = $awal - 1;

        mysqli_query(KONEKSI, "UPDATE tblbuku SET tersedia = '$hsl'
					                WHERE kdbuku = '$kdbuku'");

        echo "<script>alert('Data berhasil disimpan');
		window.location=('../../home.php?modul=$modul')</script>";
    }

    // Update peminjaman
    elseif ($modul == 'peminjaman' and $act == 'update') {
        $id = $_POST['id'];
        $noanggota = $_POST['noanggota'];
        $kdbuku = $_POST['kdbuku'];
        $kdeksemplar = $_POST['kdeksemplar'];
        $tglpinjam = $_POST['tglpinjam'];
        $tgljtempo = $_POST['tgljtempo'];
        $denda = $_POST['denda'];
        $status = $_POST['status'];
        if ($noanggota != '' and $kdbuku != '' and $kdeksemplar != '' and $tglpinjam != '' and $tgljtempo != '' and $denda != '') {
            $cek_anggota = mysqli_query(KONEKSI, "select * from anggota where noanggota = '$noanggota'");
            if (mysqli_num_rows($cek_anggota) > 0) {
                $cek_buku = mysqli_query(KONEKSI, "select * from tblbuku where kdbuku = '$kdbuku'");
                if (mysqli_num_rows($cek_buku) > 0) {
                    $cek_eksemplar = mysqli_query(KONEKSI, "select * from tbleksemplar where kdeksemplar = '$kdeksemplar'");
                    if (mysqli_num_rows($cek_eksemplar) > 0) {
                        $cek_sirkulasi = mysqli_query(KONEKSI, "select * from sirkulasi where kdeksemplar = '$kdeksemplar' AND status='BELUM' AND notransaksi!='$id'");
                        if (mysqli_num_rows($cek_sirkulasi) == 0) {
                            mysqli_query(KONEKSI, "
							update sirkulasi
							set
								noanggota		= '$noanggota',
								kdbuku			= '$kdbuku',
								kdeksemplar		= '$kdeksemplar',
								tglpinjam		= '$tglpinjam',
								tgljtempo		= '$tgljtempo',
								denda			= '$denda',
								status			= '$status'
							where
								notransaksi		= '$id'
						");
                            echo "<script>alert('Data berhasil diubah');
							window.location=('../../home.php?modul=$modul')</script>";
                        } else {
                            $buku = mysqli_fetch_array($cek_buku);
                            $kdbuku = $buku['kdbuku'];
                            $qry_buku = mysqli_query(KONEKSI, "select * from tblbuku where kdbuku = '$kdbuku'");
                            $buku = mysqli_fetch_array($qry_buku);
                            echo "<script>alert('Maaf, buku \'".$buku['judul']."\' dengan kode eksemplar \'".$kdeksemplar."\' saat ini tidak tersedia');
					window.location=('../../home.php?modul=$modul&act=edit&id=$id')</script>";
                        }
                    } else {
                        echo "<script>alert('Kode eksemplar tidak valid');
					window.location=('../../home.php?modul=$modul&act=edit&id=$id')</script>";
                    }
                } else {
                    echo "<script>alert('Kode buku tidak valid');
					window.location=('../../home.php?modul=$modul&act=edit&id=$id')</script>";
                }
            } else {
                echo "<script>alert('Nomor Anggota tidak valid');
			window.location=('../../home.php?modul=$modul&act=edit&id=$id')</script>";
            }
        } else {
            echo "<script>alert('Data belum lengkap');
		window.location=('../../home.php?modul=$modul&act=edit&id=$id')</script>";
        }

    }
}
