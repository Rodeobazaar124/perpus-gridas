<?php

include '../../config/koneksi.php';
include '../../config/library.php';
include '../../config/fungsi_thumb.php';
include '../../config/fungsi_indotgl.php';

// Query to get the data
$sql = 'SELECT
    sirkulasi.notransaksi,
    sirkulasi.tglpinjam,
    sirkulasi.tgljtempo,
    sirkulasi.status,
    sirkulasi.tglkembali,
    sirkulasi.denda,
    anggota.noanggota,
    anggota.nama as nama_anggota,
    tblbuku.kdbuku,
    tblbuku.judul
FROM
    sirkulasi
    LEFT JOIN anggota ON anggota.noanggota = sirkulasi.noanggota
    LEFT JOIN tblbuku ON tblbuku.kdbuku = sirkulasi.kdbuku';

$export = KONEKSI->query($sql);

if (! $export) {
    exit('Query failed: '.KONEKSI->error);
}

$header = '';
$data = '';

if ($export->num_rows > 0) {
    // Fetch and set the header
    $fields = $export->fetch_fields();
    foreach ($fields as $field) {
        $header .= $field->name."\t";
    }

    // Fetch and set the data rows
    while ($row = $export->fetch_assoc()) {
        $line = '';
        foreach ($row as $value) {
            if (! isset($value) || $value === '') {
                $value = "\t";
            } else {
                $value = str_replace('"', '""', $value);
                $value = '"'.$value.'"'."\t";
            }
            $line .= $value;
        }
        $data .= trim($line)."\n";
    }
} else {
    $data = "n(0) ditemukan!\n";
}

// Clean up data
$data = str_replace("\r", '', $data);

// Send the headers and data
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=semua_peminjaman_buku.xls');
header('Pragma: no-cache');
header('Expires: 0');
echo $header."\n".$data;

KONEKSI->close();
