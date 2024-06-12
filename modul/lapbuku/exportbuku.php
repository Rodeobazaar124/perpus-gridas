<?php

// Include autoload.php to load PhpSpreadsheet classes
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

include '../../config/koneksi.php';

// Membuat Query
$result = mysqli_query(KONEKSI, 'SELECT  tblbuku.judul, tblbuku.isbn, tblbuku.kdbuku,  
                                refpengarang.nama_pengarang, penerbit.nama_penerbit, tblbuku.tersedia, 
                                refklasifikasi.nama_klasifikasi, refkategori.nama_kategori, tblrak.koderak,
                                tblbuku.jumlahbuku 
                                FROM tblbuku
                                INNER JOIN refpengarang ON tblbuku.id_pengarang = refpengarang.id_pengarang
                                INNER JOIN penerbit ON tblbuku.id_penerbit = penerbit.id_penerbit
                                INNER JOIN refkategori ON refkategori.id_kategori = tblbuku.id_kategori
                                INNER JOIN tblrak ON tblrak.id_rak = tblbuku.id_rak
                                INNER JOIN refklasifikasi ON tblbuku.id_klasifikasi = refklasifikasi.id_klasifikasi
                                ORDER BY tblbuku.id_kategori DESC');

// Create a new Spreadsheet object
$objPHPExcel = new Spreadsheet();

// Set active sheet
$objPHPExcel->setActiveSheetIndex(0);

// Menentukan baris awal
$rowCount = 1;

// Menentukan kolom awal
$column = 'A';

// Mencetak header berdasarkan field tabel
$fields = mysqli_fetch_fields($result);
foreach ($fields as $field) {
    $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $field->name);
    $column++;
}

// Menentukan baris untuk input data
$rowCount = 2;

// Proses cetak data ke excel
while ($row = mysqli_fetch_assoc($result)) {
    $column = 'A';
    foreach ($row as $value) {
        $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $value);
        $column++;
    }
    $rowCount++;
}

// Mencetak File Excel
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="laporan_buku.xls"');
header('Cache-Control: max-age=0');

// Create Excel Writer
$objWriter = new Xls($objPHPExcel);
$objWriter->save('php://output');
