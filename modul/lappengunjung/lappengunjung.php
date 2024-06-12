<?php

// Initialize session if not already started
if (! isset($_SESSION)) {
    session_start();
}

// Check if user is not logged in
if (empty($_SESSION['username']) && empty($_SESSION['passuser'])) {
    echo "<link href='style.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo '<a href="../../index.php"><b>LOGIN</b></a></center>';
} else {
    // Include connection to the database or define KONEKSI constant if not already done

    // Importing necessary classes
    include 'Paging.php'; // Ensure Paging class is included or autoloaded properly
    include 'koneksi.php'; // Example include for database connection file

    $aksi = 'modul/jadwal/aksi_jadwal.php';

    switch ($_GET['act']) {
        default:
            echo "
            <div class='span12 kotak'>
                <h4 align=center>Rekap Pengunjung</h4>
                <hr>
                <div class='row'>
                    <div class='span1'></div>
                    <div class='span8'>
                        <form method='POST' action='modul/lappengunjung/cetakpengunjung.php'>
                            Dari
                            <input type='text' placeholder='click to show datepicker' name='tglawal' id='example1'>
                            Sampai Dengan 
                            <input type='text' name='tglakhir' id='example2' placeholder='Masukan tgl akhir'> 		
                            <input type='submit' class='btn btn-warning' value='Cetak'>
                        </form>
                    </div>
                    <div class='span3'>
                        <a href='modul/lappengunjung/exportpengunjung.php'>
                            <button class='btn btn-info' style='margin-left:10px;' type='button'>Export Excel Pengunjung</button>
                        </a>  
                    </div>
                </div>  
                <hr>
                <table class='table table-hover table-striped'>
                    <thead>
                        <tr><th width='50px'>No</th><th>No anggota</th><th>nama</th><th>Tgl. Kunjungan</th><th>jam</th></tr>
                    </thead>";

            // Paginate the results
            $p = new Paging();
            $batas = 15;
            $posisi = $p->cariPosisi($batas);
            $query = "SELECT tblpengunjung.*, anggota.noanggota, anggota.nama 
                      FROM tblpengunjung
                      INNER JOIN anggota ON tblpengunjung.noanggota = anggota.noanggota  
                      ORDER BY tblpengunjung.tglkunjungan DESC LIMIT $posisi,$batas";
            $result = mysqli_query(KONEKSI, $query);

            $no = $posisi + 1;
            while ($r = mysqli_fetch_array($result)) {
                echo "<tr>
                        <td>$no</td>
                        <td>$r[noanggota]</td>
                        <td>$r[nama]</td>
                        <td>$r[tglkunjungan]</td>
                        <td>$r[jam]</td>
                    </tr>";
                $no++;
            }
            echo '</table>';

            // Calculate pagination
            $jmldata = mysqli_num_rows(mysqli_query(KONEKSI, 'SELECT * FROM tblpengunjung'));
            $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
            $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
            echo "
                <div class='span3'></div>
                <div class='span6'>
                    <div class='pagination'>
                        <ul>$linkHalaman</ul>
                    </div>
                </div>
                <div class='span3'></div>";
            break;

        case 'tambahjadwal':
            echo "
                <h4 align=center>Tambah Jadwal</h4>
                <hr>
                <form class='form-horizontal' method='POST' action='$aksi?modul=jadwal&act=input'>
                    <table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
                        <tr><td>Hari</td><td>:</td><td> 
                            <select name='hari'>
                                <option value='SENIN'>SENIN</option>
                                <option value='SELASA'>SELASA</option>
                                <option value='RABU'>RABU</option>
                                <option value='KAMIS'>KAMIS</option>
                                <option value='JUMAT'>JUM'AT</option>
                                <option value='SABTU'>SABTU</option>
                                <option value='MINGGU'>MINGGU</option>
                            </select>
                        </td></tr>
                        <tr><td>Jam Buka</td><td>:</td><td> <input class='input-xxlarge' type='text' name='jam_buka'></td></tr>		
                        <tr><td>Jam Tutup</td><td>:</td><td> <input class='input-xxlarge' type='text' name='jam_tutup'></td></tr>				 
                        <tr><td>Keterangan</td><td>:</td><td> <input class='input-xxlarge' type='text' name='ket'></td></tr>		
                    </table>
                    <input type='submit' class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
                </form>";
            break;

        case 'edit':
            $edit = mysqli_query(KONEKSI, "SELECT * FROM jadwal WHERE id_jadwal = '$_GET[id]'");
            $r = mysqli_fetch_array($edit);

            echo "
                <h4 align=center>Edit Jadwal</h4>
                <hr>
                <form class='form-horizontal' method='POST' action='$aksi?modul=jadwal&act=update'>
                    <input type='hidden' name='id' value='$r[id_jadwal]'>
                    <table class='table table-striped' style='padding-left:10px;padding-right:20px;'>
                        <tr><td>Hari</td><td>:</td><td> 
                            <select name='hari'>
                                <option value='SENIN'>SENIN</option>
                                <option value='SELASA'>SELASA</option>
                                <option value='RABU'>RABU</option>
                                <option value='KAMIS'>KAMIS</option>
                                <option value='JUMAT'>JUM'AT</option>
                                <option value='SABTU'>SABTU</option>
                                <option value='MINGGU'>MINGGU</option>
                            </select>
                        </td></tr>
                        <tr><td>Jam Buka</td><td>:</td><td> <input class='input-xxlarge' type='text' value='$r[jam_buka]' name='jam_buka'></td></tr>		
                        <tr><td>Jam Tutup</td><td>:</td><td> <input class='input-xxlarge' type='text' value='$r[jam_tutup]' name='jam_tutup'></td></tr>				 
                        <tr><td>Keterangan</td><td>:</td><td> <input class='input-xxlarge' type='text' value='$r[ket]' name='ket'></td></tr>		
                    </table>
                    <input type='submit' class='btn btn-primary' style='margin-left:200px;' value='Simpan'>
                </form>";
            break;
    }
}
