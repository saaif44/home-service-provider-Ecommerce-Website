<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("database.php");
    $userPhoneNo = $_SESSION['phoneNo'];
    $userEmail = $_SESSION['email'];
    $userName = $_SESSION['name'];
    $pdo = connectToDatabase();
    

    $message = $_POST['message'];
    $sqlInsertHelp = "INSERT INTO helpmails (name, email, phoneNo, message, created_date) 
                      VALUES (:name, :email, :phoneNo, :message, NOW())";
    $stmtInsertHelp = $pdo->prepare($sqlInsertHelp);
    $stmtInsertHelp->bindParam(':name', $userName, PDO::PARAM_STR);
    $stmtInsertHelp->bindParam(':email', $userEmail, PDO::PARAM_STR);
    $stmtInsertHelp->bindParam(':phoneNo', $userPhoneNo, PDO::PARAM_STR);
    $stmtInsertHelp->bindParam(':message', $message, PDO::PARAM_STR);

    try {
       
        $stmtInsertHelp->execute();

    
        $response = [
            'success' => true,
            'message' => 'Thank you! Your help message has been submitted.'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } catch (PDOException $e) {
        $response = [
            'success' => false,
            'message' => 'Error submitting help message.'
        ];

        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
} else {
   
    $response = [
        'success' => false,
        'message' => 'Invalid request.'
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}




?>
