<?php
session_start();
include("database.php");
$pdo = connectToDatabase();

// Accept orders from order
if (isset($_POST['accept_order'])) {
    $order_id = $_POST['id'];
    // Use the worker's name directly from the session

    $sqlUpdateOrder = "UPDATE orders 
                       SET order_processing = 1, 
                           order_processing_worker = :phoneNo, 
                           order_worker_name = :name,  -- Corrected placeholder
                           order_available = 0 
                       WHERE id = :id";

    $stmtUpdateOrder = $pdo->prepare($sqlUpdateOrder);
    $stmtUpdateOrder->bindParam(':phoneNo', $_SESSION['phoneNo'], PDO::PARAM_STR);
    $stmtUpdateOrder->bindParam(':name', $_SESSION['name'], PDO::PARAM_STR); // Corrected placeholder
    $stmtUpdateOrder->bindParam(':id', $order_id, PDO::PARAM_INT);

    try {
        $stmtUpdateOrder->execute();
        header('location: ../../views/worker/workerDashboard.php');
        exit;
    } catch (PDOException $e) {
        // Handle the exception, log or display an error message
        echo "Error updating order: " . $e->getMessage();
    }
} else {
    header('location: ../../views/worker/workerDashboard.php');
    exit;
}
?>
