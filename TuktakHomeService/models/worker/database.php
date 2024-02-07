<?php

function connectToDatabase() {
    $hostname = 'localhost';
    $dbname = 'homeservice';
    $username = 'root';
    $password = '';

    try {
        $dsn = "mysql:host=$hostname;dbname=$dbname;charset=utf8mb4";
        
        $pdo = new PDO($dsn, $username, $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    } catch (PDOException $e) {
        // Handle connection errors here
        die("Database connection failed: " . $e->getMessage());
    }

}
?>