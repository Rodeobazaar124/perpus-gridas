<?php

// panggil fungsi validasi xss dan injection
require_once 'fungsi_validasi.php';

// definisikan koneksi ke database
$server = 'localhost';
$username = 'k4779191_jurnal';
$password = 'q1w2e3r4t5';
$database = 'k4779191_jurnal';

// Koneksi dan memilih database di server
mysqli_connect($server, $username, $password) or exit('Koneksi gagal');
mysqli_select_db($database) or exit('Database tidak bisa dibuka');

// buat variabel untuk validasi dari file fungsi_validasi.php
$val = new Lokovalidasi();
