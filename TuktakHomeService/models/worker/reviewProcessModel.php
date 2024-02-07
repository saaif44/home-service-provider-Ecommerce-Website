<?php

include('database.php');
$pdo = connectToDatabase();

if (isset($_POST['confirm_review'])) {
    // Getting the order ID from the form 
    $orderId = $_POST['id'];

    $rating = $_POST['rating']; 
    $reviewText = $_POST['review']; 

    // Update orders with review details
    $sqlUpdateReview = "UPDATE orders SET rating = :rating, review = :review WHERE id = :id";
    $stmtUpdateReview = $pdo->prepare($sqlUpdateReview);
    $stmtUpdateReview->bindParam(':rating', $rating, PDO::PARAM_INT);
    $stmtUpdateReview->bindParam(':review', $reviewText, PDO::PARAM_STR);
    $stmtUpdateReview->bindParam(':id', $orderId, PDO::PARAM_INT);
    $stmtUpdateReview->execute();

    // Redirect back to the review page
    header('location: ../../views/worker/workerReviews.php');
    exit;
} else {
    header('location:  ../../views/worker/workerReviews.php');
    exit;
}
?>
