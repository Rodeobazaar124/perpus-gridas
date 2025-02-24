<?php

/**
 * A class file to connect to database
 */
class DB_CONNECT
{
    // constructor
    public function __construct()
    {
        // connecting to database
        $this->connect();
    }

    // destructor
    public function __destruct()
    {
        // closing db connection
        $this->close();
    }

    /**
     * Function to connect with database
     */
    public function connect()
    {
        // import database connection variables
        require_once __DIR__.'/config.php';

        // Connecting to mysql database
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or exit(mysqli_error());

        // Selecing database
        $db = mysqli_select_db(DB_DATABASE) or exit(mysqli_error()) or exit(mysqli_error());

        // returing connection cursor
        return $con;
    }

    /**
     * Function to close db connection
     */
    public function close()
    {
        // closing db connection
        mysqli_close();
    }
}
