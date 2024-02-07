<?php

include('database.php');

$pdo = connectToDatabase();

// OrderList where order_processing is 0
$sqlOrders = "SELECT * FROM orders WHERE order_processing = 0 AND order_available = 1";
$stmtOrders = $pdo->prepare($sqlOrders);
$stmtOrders->execute();
$orders = $stmtOrders->fetchAll(PDO::FETCH_ASSOC);

include("balance.php");

?>
