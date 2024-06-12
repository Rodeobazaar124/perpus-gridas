<?php
error_reporting(0);
require 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Smart Library </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="css/BeatPicker.min.css" />
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/BeatPicker.min.js"></script>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

</head>

<body>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="logo span4">
                    <h1>
                        <?php
                        include 'config/koneksi.php';
$tampil = $mysqli->query('SELECT * FROM profil');

while ($r = $tampil->fetch_array()) {
    echo "
	<img src='images/$r[logo]' width='40px' ></a>
     ";
}
?>
                        Perpustakaan <span class="kuning"></span></a>
                    </h1>
                </div>

            </div>
        </div>
    </div>





    <div class="register-container container">

        <div class="row">
            <div class="span4">

            </div>

            <div class="span4 register ">
                <?php
                if ($_GET['modul'] == 'false') {
                    echo "
						 <div class='alert alert-error'>
						  <button type='button' class='close' data-dismiss='alert'>&times;</button>
						 
						  Username atau Password yang anda Masukan salah.
						  
						</div>";
                }
?>
                <?php
if ($_GET['modul'] == 'injek') {
    echo "
						 <div class='alert alert-error'>
						  <button type='button' class='close' data-dismiss='alert'>&times;</button>
						 
						 Anda telah mencoba melakukan hacking.
						  
						</div>";
}
?>
                <form name="login" action="login.php" method="POST">


                    <h2>&nbsp;&nbsp;<span class="kuning"><strong>Login</strong></span></h2>

                    <label for="username">Username</label>
                    <input id="nama" name="username" type="text" placeholder="Masukan Username" />

                    <label for="username">Password</label>
                    <input id="password" name="password" type="password" placeholder="Masukan Password" />

                    <button type="submit">Login</button>
                    <br>

                </form>

            </div>

            <div class="span4">

            </div>


        </div>
    </div>

    <!-- Javascript -->
    <script src="assets/js/jquery-1.8.2.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.backstretch.min.js"></script>
    <script src="assets/js/scripts.js"></script>
        </body>

        </html>