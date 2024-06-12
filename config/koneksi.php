<?php

error_reporting(0);

// panggil fungsi validasi xss dan injection
require_once 'fungsi_validasi.php';

// definisikan koneksi ke database
$server = 'localhost';
$username = 'root';
$password = '';
// $database = "db_perpus";
$database = 'db_perpus';
$mysqli = mysqli_connect($server, $username, $password);
// Koneksi dan memilih database di server
define('KONEKSI', $mysqli);
$mysqli->select_db($database) or exit('Database tidak bisa dibuka');

// buat variabel untuk validasi dari file fungsi_validasi.php
$val = new Lokovalidasi();
