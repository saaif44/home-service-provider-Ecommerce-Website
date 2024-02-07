<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/logStyle.css">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="registrationView.php">Sign up</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="login-form">
        <div class="container">
            <h1>Login</h1>

            <?php
            if (isset($_GET['login'])) {
                if ($_GET['login'] === 'failed') {
                    echo '<p style="color: red;">Login failed. Please check your phone number and password. <br> Contact Support. </p>';
                    echo '<script>alert("Login failed. Please check your phone number and password.");</script>';
                }
            }

            if (isset($_GET['registration']) && $_GET['registration'] === 'success') {
                echo '<p style="color: green;">Registration completed successfully. You can now log in.</p>';
            }

           
        
        

            ?>
            
            <form id="login-form" action="login.php" method="post" onsubmit="return validateForm()">
                <label for="phoneNo">Phone Number:</label>
                <input type="text" name="phoneNo"><br><br>

                <label for="password">Password:</label>
                <input type="password" name="password"><br><br>
                <input type="submit" value="Login">
                <div id="error-message" style="color: red;"></div>
            </form>

            <script>
                function validateForm() {
                    var phoneNo = document.forms["login-form"]["phoneNo"].value;
                    var password = document.forms["login-form"]["password"].value;

                    if (phoneNo === "" || password === "") {
                        document.getElementById("error-message").innerHTML = "Please enter both phone number and password.";
                        return false;
                    }

                    return true;
                }
            </script>

        </div>
    </div>

    <footer>
        <div class="container">
            <p> 2023 Household Services</p>
        </div>
    </footer>

</body>
</html>

<?php
session_start();
include('../models/loginModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phoneNo = $_POST['phoneNo'];
    $password = $_POST['password'];

    if (loginUser($phoneNo, $password)) {
        echo "Login successful, but user type not recognized.";
        //rare case
        exit;
    } else {
        header('Location: login.php?login=failed');
        exit;
    }
}
?>
