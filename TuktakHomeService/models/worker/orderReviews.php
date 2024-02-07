<?php


include("database.php");
$userPhoneNo = $_SESSION['phoneNo'];
$pdo = connectToDatabase();


//fething orders which are completed
$sqlCompletedOrders = "SELECT * FROM orders WHERE order_complete = 1 AND order_processing_worker = :phoneNo";
$stmtCompletedOrders = $pdo->prepare($sqlCompletedOrders);
$stmtCompletedOrders->bindParam(':phoneNo', $userPhoneNo, PDO::PARAM_STR);
$stmtCompletedOrders->execute();
$completedOrders = $stmtCompletedOrders->fetchAll(PDO::FETCH_ASSOC);


include("balance.php");

?>