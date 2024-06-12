<?php

// Include autoload.php to load PhpSpreadsheet classes
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

include '../../config/koneksi.php';

// Membuat Query
$result = mysqli_query(KONEKSI, 'SELECT anggota.noanggota, anggota.nama, tblpengunjung.tglkunjungan, tblpengunjung.jam   
            FROM tblpengunjung 
            LEFT JOIN anggota ON anggota.noanggota = tblpengunjung.noanggota
            ORDER BY tblpengunjung.tglkunjungan DESC');

// Create a new Spreadsheet object
$objPHPExcel = new Spreadsheet();

// Set active sheet
$objPHPExcel->setActiveSheetIndex(0);

// Menentukan baris awal
$rowCount = 1;

// Menentukan kolom awal
$column = 'A';

// Menentukan header berdasarkan field tabel
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
header('Content-Disposition: attachment;filename="laporan_pengunjung.xls"');
header('Cache-Control: max-age=0');

// Create Excel Writer
$objWriter = new Xls($objPHPExcel);
$objWriter->save('php://output');
