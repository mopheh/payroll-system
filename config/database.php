<?php 
    define('DB_HOST', 'localhost');
    define('DB_USER', 'mofe');
    define('DB_PASS', '12345678');
    define('DB_NAME', 'php_crash');

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die('Connection Failed' . $conn->connect_error);
    } 

