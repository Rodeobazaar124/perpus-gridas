<?php

if (! isset($_SESSION)) {
    session_start();
}
session_destroy();
echo "<script>alert('Anda telah keluar dari halaman administrator'); window.location = 'index.php'</script>";
