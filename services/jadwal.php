<?php

include 'configure.php';

header('Content-type: application/json');
$arr = [];
$rs = mysqli_query(KONEKSI, 'SELECT * from jadwal');
while ($obj = mysqli_fetch_object($rs)) {
    $arr[] = $obj;
}
echo '{"jadwals":'.json_encode($arr).'}';
