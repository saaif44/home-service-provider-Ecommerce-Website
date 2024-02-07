<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/logStyle.css">
    <title>Customer Registration</title>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="registration-form">
        <div class="container">
            <h1>Customer Registration</h1>
            <form action="../controllers/registrationController.php" method="post">
                
            <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="mail">Mail:</label>
        <input type="email" name="mail" required><br><br>

        <label for="gender">Gender:</label>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female
        <input type="radio" name="gender" value="Other" required> Other<br><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" required><br><br>

        <label for="phone">Phone No:</label>
        <input type="tel" name="phone" required><br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" required><br><br>

        <label for="nid">NID:</label>
        <input type="text" name="nid" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

                <input type="submit" name="register" value="Register as a Customer Account">
                <input type="submit" name="register" value="Register as a Worker Account">
            </form>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2023 Household Services</p>
        </div>
    </footer>
</body>
</html>
