<?php

// panggil fungsi validasi xss dan injection
require_once 'fungsi_validasi.php';

// definisikan koneksi ke database
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'db_perpus';

// Koneksi dan memilih database di server
mysqli_connect($server, $username, $password) or exit('Koneksi gagal');
mysqli_select_db($database) or exit('Database tidak bisa dibuka');

// buat variabel untuk validasi dari file fungsi_validasi.php
$val = new Lokovalidasi();
