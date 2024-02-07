<?php


include('database.php');
$userPhoneNo = $_SESSION['phoneNo'];
$pdo = connectToDatabase();

//fetch orders that the worker is currently engaged with
$sqlOrders = "SELECT * FROM orders WHERE order_processing_worker = :phoneNo AND order_processing = 1 AND order_available = 0 AND order_complete = 0";
$stmtOrders = $pdo->prepare($sqlOrders);
$stmtOrders->bindParam(':phoneNo', $userPhoneNo, PDO::PARAM_STR);
$stmtOrders->execute();
$orders = $stmtOrders->fetchAll(PDO::FETCH_ASSOC);

include("balance.php");

?>