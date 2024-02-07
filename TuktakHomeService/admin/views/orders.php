

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tukitaki - Orders</title>

    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        .btn-group {
            margin-top: 10px;
            padding: 20px;
            text-align: center;
            
        }

        .btn {
            padding: 10px;
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <header>
        <h1>Orders</h1>
    </header>

    <?php 
    include("nav.php");
    ?>

    <section>
            <div class="btn-group">
            <a class="btn" href="../controllers/ordersController.php?view=all">All Orders</a>
            <a class="btn" href="../controllers/ordersController.php?view=processing">Processing Orders</a>
            <a class="btn" href="../controllers/ordersController.php?view=notaccepted">Not Accepted Orders</a>
        </div>

        <h2><?php echo ucfirst($view) ?> Orders</h2>
        <?php
        if ($resultOrders->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Order Number</th><th>Order Address</th><th>Customer Name</th><th>Worker Name</th><th>Schedule Date and Time</th><th>Created Date and Time</th><th>Completed</th><th>Order Cost</th><th>Customer Phone</th><th>Worker Phone</th></tr>";
            while ($rowOrder = $resultOrders->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $rowOrder["order_id"] . "</td>";
                echo "<td>" . $rowOrder["customer_address"] . "</td>";
                echo "<td>" . $rowOrder["customer_name"] . "</td>";
                echo "<td>" . ($rowOrder["order_worker_name"] ?? "N/A") . "</td>";
                echo "<td>" . $rowOrder["order_schedule"] . "</td>";
                echo "<td>" . $rowOrder["order_date"] . "</td>";
                echo "<td>" . ($rowOrder["order_complete"] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . $rowOrder["order_cost"] . "</td>";
                echo "<td>" . $rowOrder["customer_phoneNo"] . "</td>";
                echo "<td>" . ($rowOrder["worker_phoneNo"] ?? "N/A") . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No orders found.";
        }
        ?>
    </section>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
