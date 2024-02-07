<!-- <?php include("../controllers/checkLogged.php"); ?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../public/css/style.css">

    <style>
        form {
            max-width: 300px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        button {
            background-color: #333;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;

        }
    </style>
</head>
<body>

    <header>
        <h1>Admin Panel</h1>
    </header>

    <?php 
    include("nav.php");
    ?>

    <section>
        <form action="admin.php" method="post">
            <label for="searchUser">Search User:</label>
            <input type="text" id="searchUser" name="searchUser" required>
            <button type="submit">Search</button>
        </form>

        <?php
        //Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Get the user input
            $searchUser = $_POST["searchUser"];

            //implement your logic to search for the user and display their details
            //using database queries and fetch data based on the search input

            //for example, displaying the user details
            echo "<h2>User Details</h2>";
            echo "<p>Name: John Doe</p>";
            echo "<p>Email: john@example.com</p>";
            echo "<p>Rating: 4.5</p>";

            //button to freeze/unfreeze the user account
            echo '<form action="admin.php" method="post">';
            echo '<input type="hidden" name="userId" value="123">'; // Replace with the actual user ID
            echo '<button type="submit" name="freezeUnfreeze">Freeze/Unfreeze Account</button>';
            echo '</form>';
        }

        // if freeze/unfreeze button is clicked
        if (isset($_POST["freezeUnfreeze"])) {
            // then get user ID from the hidden input
            $userId = $_POST["userId"];
            echo "<p>User account frozen successfully!</p>";
        }
        ?>
    </section>

    <footer>
        <p> 2023 Tukitaki.com @All rights reserved</p>
    </footer>

</body>
</html>
