<?php

include("../../controllers/worker/LoginCheck.php");


$userPhoneNo = $_SESSION['phoneNo'];

include('../../models/worker/workerdb.php');


echo "PhoneNo: " . $_SESSION['phoneNo'] . "<br>";
echo "Balance: " . $balance . "<br>";
echo "session_name: " . $_SESSION['name'] . "<br>";
echo "name: " . $name;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Dashboard</title>
    <link rel="stylesheet" href="../../public/css/workerDashboard.css">
    <link rel="stylesheet" href="../../public/css/tableStyle.css">

</head>
<body>
    <div class="navbar">
        <div class="profile">
            <img src="profile-image.jpg" alt="Profile Picture">
            <div><?php echo $name; ?></div>
        </div>
        <?php 
        include("nav.php");
        ?>
    </div>

    <div class="order-list">
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Service Name</th>
                <th>Customer Name</th>
                <th>Order Schedule</th>
                <th>Customer Address</th>
                <th>Customer Phone</th>
                <th>Order Notes</th>
                <th>Order Cost</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['service_name']; ?></td>
                    <td><?php echo $order['customer_name']; ?></td>
                    <td><?php echo $order['order_schedule']; ?></td>
                    <td><?php echo $order['customer_address']; ?></td>
                    <td><?php echo $order['customer_phoneNo'];             ?></td>
                    <td><?php echo $order['order_notes'];          ?></td>
                    <td><?php echo $order['order_cost'];             ?></td>
                    <td>
                        <form action="../../controllers/worker/accept_order_controller.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                            <button type="submit" name="accept_order">Accept Order</button>
                        </form>
                    </td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
