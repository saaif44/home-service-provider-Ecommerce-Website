<?php


    $userPhoneNo = $_SESSION['phoneNo'];
    $userEmail = $_SESSION['email'];
    $userName = $_SESSION['name'];


include("workerOrders.php");


$sqlUser = "SELECT name, email FROM users WHERE phoneNo = :phoneNo";
$stmtUser = $pdo->prepare($sqlUser);
$stmtUser->bindParam(':phoneNo', $_SESSION['user_phoneNo'], PDO::PARAM_STR);
$stmtUser->execute();
$userInfo = $stmtUser->fetch(PDO::FETCH_ASSOC);

$name = $userInfo['name'] ?? '';
$email = $userInfo['email'] ?? '';


// Function to fetch help messages

    $sqlHelpMessages = "SELECT * FROM helpmails WHERE phoneNo = :phoneNo";
    $stmtHelpMessages = $pdo->prepare($sqlHelpMessages);
    $stmtHelpMessages->bindParam(':phoneNo', $userPhoneNo, PDO::PARAM_STR);
    $stmtHelpMessages->execute();
    $helpMessages = $stmtHelpMessages->fetchAll(PDO::FETCH_ASSOC);
    
 


?>