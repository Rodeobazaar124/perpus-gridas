<?php

$cfg_server = 'localhost';
$cfg_database = 'db_perpus';
$cfg_username = 'root';
$cfg_password = '';

// Establish connection
$conn = mysqli_connect($cfg_server, $cfg_username, $cfg_password);

// Check connection
if (! $conn) {
    exit('Could not connect to Database: '.mysqli_connect_error());
}

// Select database
if (! mysqli_select_db($conn, $cfg_database)) {
    exit('Could not select Database: '.mysqli_error($conn));
}

// You can add additional code here for further operations, but remember to close the connection when done
// mysqli_close($conn);
