<?php
include('../../models/database.php');
$conn = connectToDatabase();

//get selected view (All, Processing, Not Accepted)
$view = isset($_GET['view']) ? $_GET['view'] : 'all';

//get orders based on the selected view
$sqlOrders = "SELECT * FROM orders";
if ($view === 'processing') {
    $sqlOrders .= " WHERE order_complete = FALSE AND order_worker_name IS NOT NULL";
} elseif ($view === 'notaccepted') {
    $sqlOrders .= " WHERE order_complete = FALSE AND order_worker_name IS NULL";
}

$sqlOrders .= " ORDER BY order_date DESC";

$resultOrders = $conn->query($sqlOrders);
?>
