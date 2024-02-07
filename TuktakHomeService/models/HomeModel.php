<?php

include('database.php');

function getServices() {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM services";
    $result = $conn->query($sql);

    $conn->close();

    return $result;
}

?> 
