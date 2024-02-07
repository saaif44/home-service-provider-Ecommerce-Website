<?php
// Include the database connection
include('../../models/database.php');
$conn = connectToDatabase();
// Check if the user ID and type are provided in the URL
if (isset($_GET['id']))  {
    $userId = $_GET['id'];
   
    
    if ($userId == $userId){
       
            // Toggle the 'active' column for the specified user ID
            $sqlToggleFreeze = "UPDATE users SET active = CASE WHEN active = 1 THEN 0 ELSE 1 END WHERE id = $userId";
            $resultToggleFreeze = $conn->query($sqlToggleFreeze);
    
            if ($resultToggleFreeze) {
                echo "account status toggled successfully!";
                header("location: ../controllers/actionController.php");
            } else {
                echo "Error toggling the account status. Please try again.";
            }
    
}
    
     else {
        echo "User ID not found.";
    }
} 
    else {
    echo "User ID or type not provided.";
    }

// Close the database connection
$conn->close();
?>
