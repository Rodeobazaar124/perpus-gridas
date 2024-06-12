<?php

include 'config/koneksi.php';
include 'config/library.php';
function anti_injection($data)
{
    $filter = mysqli_real_escape_string(KONEKSI, stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));

    return $filter;
}

$username = anti_injection($_POST['username']);
$pass = anti_injection(md5($_POST['password']));

// pastikan username dan password adalah berupa huruf atau angka.
if (! ctype_alnum($username) or ! ctype_alnum($pass)) {

    header('location:index.php?modul=injeksi');
} else {
    $login = mysqli_query(KONEKSI, "SELECT * FROM users WHERE username='$username' AND password='$pass' AND blokir='N'");
    $ketemu = mysqli_num_rows($login);
    $r = $login->fetch_array();
    // Apabila username dan password ditemukan
    if ($ketemu > 0) {
        if (! isset($_SESSION)) {
            session_start();
        }
        include 'timeout.php';
        $_SESSION['KCFINDER'] = [];

        $_SESSION['KCFINDER']['disabled'] = false;

        $_SESSION['KCFINDER']['uploadURL'] = 'tinymcpuk/gambar';

        $_SESSION['KCFINDER']['uploadDir'] = '';

        $_SESSION['namauser'] = $r['username'];
        $_SESSION['nama_lengkap'] = $r['nama_lengkap'];
        $_SESSION['hak'] = $r['level'];
        $_SESSION['passuser'] = $r['password'];
        $_SESSION['id_session'] = $r['id_session'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $browser = $_SERVER['HTTP_USER_AGENT'];

        // session timeout
        $_SESSION['login'] = 1;
        timer();
        mysqli_query(KONEKSI, "INSERT INTO log_login(tgl_login,
									username,
                                    ip,
									browser) 
                            VALUES('$tgl_sekarang',
							       '$_SESSION[namauser]',
								   '$ip',
								   '$browser')");

        header('location:home.php?modul=home');
    } else {
        header('location:index.php?modul=false');
    }
}
