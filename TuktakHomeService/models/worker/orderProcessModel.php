<?php


include('database.php');
$userPhoneNo = $_SESSION['phoneNo'];
$pdo = connectToDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['complete_order'])) {
        // Process the order completion
        $orderId = $_POST['id'];

        // Fetch order details to get the cost
        $sqlOrderDetails = "SELECT order_cost FROM orders WHERE id = :id";
        $stmtOrderDetails = $pdo->prepare($sqlOrderDetails);
        $stmtOrderDetails->bindParam(':id', $orderId, PDO::PARAM_INT);
        $stmtOrderDetails->execute();
        $orderDetails = $stmtOrderDetails->fetch(PDO::FETCH_ASSOC);

        if ($orderDetails) {
            $orderCost = $orderDetails['order_cost'];

            // let's get current date
            $completedDate = date("Y-m-d");

            //update orderList table to set order_complete to 1
            $sqlUpdateOrder = "UPDATE orders SET order_complete = 1, completed_date = :completed_date WHERE id = :id";
            $stmtUpdateOrder = $pdo->prepare($sqlUpdateOrder);
            $stmtUpdateOrder->bindParam(':completed_date', $completedDate, PDO::PARAM_STR);
            $stmtUpdateOrder->bindParam(':id', $orderId, PDO::PARAM_INT);
            $stmtUpdateOrder->execute();

            //update workerData table to add the order cost to the balance
            $sqlUpdateBalance = "UPDATE users SET balance = balance + :order_cost WHERE phoneNo = :phoneNo";
            $stmtUpdateBalance = $pdo->prepare($sqlUpdateBalance);
            $stmtUpdateBalance->bindParam(':order_cost', $orderCost, PDO::PARAM_STR);
            $stmtUpdateBalance->bindParam(':phoneNo', $userPhoneNo, PDO::PARAM_STR);
            $stmtUpdateBalance->execute();

            //redirect back to the Orders page
            header('Location: ../../controllers/worker/orderView.php');
            exit();
        }
    } elseif (isset($_POST['discontinue_order'])) {
        //process the order discontinue
        $orderId = $_POST['id'];

        //update orderList table to set order_available to 1
        $sqlUpdateOrder = "UPDATE orders SET order_available = 1, order_processing = 0, order_processing_worker = '' WHERE id = :id";
        $stmtUpdateOrder = $pdo->prepare($sqlUpdateOrder);
        $stmtUpdateOrder->bindParam(':id', $orderId, PDO::PARAM_INT);
        $stmtUpdateOrder->execute();

        //redirect back to the Orders page
        header('Location: ../../controllers/worker/orderView.php');
        exit();
    }
}

?>
