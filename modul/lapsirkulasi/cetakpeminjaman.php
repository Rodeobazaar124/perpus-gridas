<?php

//Membuat Koneksi Mysql
include '../../config/koneksi.php';

$tglawal = $_POST['tglawal'];
$tglakhir = $_POST['tglakhir'];

//Membuat Query
$result = mysqli_query(KONEKSI, "select 
				sirkulasi.notransaksi,		sirkulasi.tglpinjam,
				sirkulasi.tgljtempo,		sirkulasi.status,
				sirkulasi.tglkembali,		sirkulasi.denda,
				anggota.noanggota,			anggota.nama as nama_anggota,
				tblbuku.kdbuku,				tblbuku.judul,
				petugas.id,					petugas.nama,
				denda.notransaksi,			denda.telat, denda.denda as bayardenda,
                				
				tbleksemplar.kdeksemplar
			from sirkulasi
			left join anggota 		on anggota.noanggota		= sirkulasi.noanggota
			left join tblbuku 		on tblbuku.kdbuku			= sirkulasi.kdbuku
			left join petugas		on petugas.id				= sirkulasi.idpetugasserah
			left join denda			on denda.notransaksi		= sirkulasi.notransaksi
			left join tbleksemplar 	on tbleksemplar.kdeksemplar	= sirkulasi.kdeksemplar
		 WHERE sirkulasi.status = 'SUDAH' AND sirkulasi.tglpinjam BETWEEN '$tglawal' AND '$tglakhir' 
		ORDER BY sirkulasi.status DESC ");

require_once 'phpexcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();

// Setting Worsheet yang aktif
$objPHPExcel->setActiveSheetIndex(0);

//Menentukan baris awal
$rowCount = 1;

//Menentukan kolom awal
$column = 'A';

//Mencetak header berdasarkan field tabel
for ($i = 0; $i < mysqli_num_fields($result); $i++) {
    $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, mysqli_fetch_field_direct($result, $i));
    $column++;
}

//menentukan baris untuk input data
$rowCount = 2;

//Proses cetak data ke excel
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

        if ($column == 'F') {
            //mencetak jika kolom tersebut berbentuk string.
            $objPHPExcel->getActiveSheet()->setCellValueExplicit($column.$rowCount, $value, PHPExcel_Cell_DataType::TYPE_STRING);
        } else {
            //mencetak secara default
            $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $value);
        }
        $column++;
    }
    $rowCount++;
}

// Mencetak File Excel
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="laporan_peminjaman.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
