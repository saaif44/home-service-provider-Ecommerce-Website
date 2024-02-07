<?php
include('../../models/database.php');

function login($username, $password) {
    $conn = connectToDatabase();

    // Query to check if user with the provided username and password exists
    $sql = "SELECT * FROM admin WHERE name='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, login successful
        if ($result->num_rows > 0) {
    // User found, login successful
    session_start();
        $_SESSION['username'] = $username;
    echo "<script>alert('Login successful! Welcome, $username!'); window.location.href='../controllers/adminDashboardController.php';</script>";
            exit();
} else {
    // No matching user found
    echo "<script>alert('Invalid username or password. Please try again.');</script>";
}
    }
    // Close the database connection
    $conn->close();
}

// Example usage:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Call the login function with provided username and password
    login($username, $password);
}
?>
