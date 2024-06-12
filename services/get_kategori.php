<?php

include 'configure.php';
header('Content-type: application/json');
$arr = [];
$rs = mysqli_query(KONEKSI, 'SELECT * FROM refkategori');
while ($obj = mysqli_fetch_object($rs)) {
    $arr[] = $obj;
}
echo '{"kat":'.json_encode($arr).'}';
