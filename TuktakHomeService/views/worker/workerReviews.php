<?php
include("../../controllers/worker/reviewController.php")
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Reviews</title>
    <link rel="stylesheet" href="../../public/css/workerDashboard.css">
    <link rel="stylesheet" href="../../public/css/tablestyle.css">
    <style>

        .review-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .rating {
            margin-bottom: 10px;
        }
        
        .rating label {
            margin-right: 5px;
        }
        
        .review textarea {
            width: 100%;
            height: 80px;
            resize: none;
            margin-bottom: 10px;
        }

    </style>
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
        <h1>Order Reviews</h1>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Service Name</th>
                    <th>customer Name</th>
                    <th>Order Schedule</th>
                    <th>Order Cost</th>
                    <th>Completed Date</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($completedOrders as $order) : ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['service_name']; ?></td>
                        <td><?php echo $order['customer_name']; ?></td>
                        <td><?php echo $order['order_schedule']; ?></td>
                        <td><?php echo $order['order_cost']; ?></td>
                        <td><?php echo $order['completed_date']; ?></td>
                        <td><?php echo $order['rating']; ?></td>
                        <td><?php echo $order['review']; ?></td>
                        <td class="review-form">
                            <form action="../../controllers/worker/reviewProcessController.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                                     <div class="rating">
                                <label for="rating">Rating:</label>
                            <select name="rating" id="rating">
                                    <option value="3">3 Star</option>
                                    <option value="2">2 Stars</option>
                                    <option value="1">1 Stars</option>
                                </select>
                                </div>
                                <div class="review">
                            <label for="review">Review:</label>
                                <textarea name="review" id="review" placeholder="Write your review"></textarea>
                            </div>
                                <button type="submit" name="confirm_review">Confirm Review</button>
                            </form>
</td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
