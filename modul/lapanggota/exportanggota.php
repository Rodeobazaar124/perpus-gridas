<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require '../../vendor/autoload.php';
include '../../config/koneksi.php';

// Include MySQL connection

// Query to fetch data
$result = mysqli_query(KONEKSI, 'SELECT * FROM anggota');

// Create new Spreadsheet object
$objPHPExcel = new Spreadsheet();

// Set active sheet
$objPHPExcel->setActiveSheetIndex(0);

// Initialize row and column positions
$rowCount = 1;
$column = 'A';

// Print headers based on table fields
for ($i = 0; $i < mysqli_num_fields($result); $i++) {
    $fieldInfo = mysqli_fetch_field_direct($result, $i);
    $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $fieldInfo->name);
    $column++;
}

// Reset row position for data
$rowCount = 2;

// Process data to print to Excel
while ($row = mysqli_fetch_row($result)) {
    $column = 'A';

    for ($j = 0; $j < mysqli_num_fields($result); $j++) {
        if (! isset($row[$j])) {
            $value = null;
        } elseif ($row[$j] != '') {
            $value = strip_tags($row[$j]);
        } else {
            $value = '';
        }

        // Set explicit data type for specific column (e.g., column F)
        if ($column == 'F') {
            $objPHPExcel->getActiveSheet()->setCellValueExplicit($column.$rowCount, $value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        } else {
            $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $value);
        }
        $column++;
    }
    $rowCount++;
}

// Output Excel file
$fileName = 'laporan_anggota.xls';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$fileName.'"');
header('Cache-Control: max-age=0');
$objWriter = new Xlsx($objPHPExcel);
$objWriter->save('php://output');

// Clean up resources if necessary, though not needed directly for PHPExcel/PhpSpreadsheet
// mysqli_free_result($result);
