<?php
// Include the database connection
include('../../models/database.php');
$conn = connectToDatabase();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get values from the AJAX request
    $inquiryId = $_POST['inquiry_id'];
    $adminReply = $_POST['admin_reply'];

    // Update the helpmail with the admin reply
    $sqlUpdateReply = "UPDATE helpmails SET admin_reply = ? WHERE id = ?";
    $stmt = $conn->prepare($sqlUpdateReply);
    $stmt->bind_param("si", $adminReply, $inquiryId);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo "Admin reply submitted successfully!";
    } else {
        echo "Error submitting admin reply. Please try again.";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
