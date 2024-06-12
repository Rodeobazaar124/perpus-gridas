<?php

include 'config/koneksi.php';
include 'config/bar128.php';

$sql = (mysqli_query(KONEKSI, "SELECT * FROM tbleksemplar where kdbuku = '$_POST[kode]' order by kdeksemplar "));
while ($k = mysqli_fetch_array($sql)) {
    $perpus = bar128(stripslashes($k['kdeksemplar']));
    echo '<div style="border: 3px double #ababab; float:left; padding: 5px; margin-left :10px; margin-top:20px; ">  
';

    echo "$perpus </div>";

}
