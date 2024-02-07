<?php

// Fetch the worker's balance and name
$sqlWorker = "SELECT id, name, balance, email FROM users WHERE phoneNo = :phoneNo";
$stmtWorker = $pdo->prepare($sqlWorker);
$stmtWorker->bindParam(':phoneNo', $userPhoneNo, PDO::PARAM_STR);
$stmtWorker->execute();
$resultWorker = $stmtWorker->fetch(PDO::FETCH_ASSOC);

// Initialize result variables directly within the conditional statement
$name = '';
$balance = '';
$email = '';

if ($resultWorker) {
    $name = $resultWorker['name'];
    $balance = $resultWorker['balance'];
    $email = $resultWorker['email'];
    $_SESSION['name'] = $name; // Set the worker's name in the session
    $_SESSION['email'] = $email;
}


?>