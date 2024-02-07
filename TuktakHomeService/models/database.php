<?php
    function connectToDatabase() {
    $hostname = 'localhost';
    $dbname = 'homeservice';
    $username = 'root';
    $password = '';
   
    $conn = new mysqli($hostname, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>