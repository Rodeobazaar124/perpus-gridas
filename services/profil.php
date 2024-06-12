<?php

include 'configure.php';

header('Content-type: application/json');
$arr = [];
$rs = mysqli_query(KONEKSI, 'SELECT * from profil');
while ($obj = mysqli_fetch_object($rs)) {
    $arr[] = $obj;
}
echo '{"profils":'.json_encode($arr).'}';
