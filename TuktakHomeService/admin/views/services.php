<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>

    <header>
        <h1>Service Overview</h1>
    </header>

    <?php 
    include("nav.php");
    ?>

<!-- <?php include("../controllers/checkLogged.php"); ?>     -->
<section>
        <h2>Service List</h2>

        <?php
        
        include("../controllers/serviceList.php");


        if ($result->num_rows > 0) {
            // Display the service list
            echo "<table>";
            echo "<tr><th>Service ID</th><th>Service Name</th><th>Number of Orders</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["service_id"] . "</td>";
                echo "<td>" . $row["service_name"] . "</td>";
                echo "<td>" . $row["total_orders"] . "</td>";
                
                // Add a delete button for each service
                echo '<td>';
                echo '<form action="../controllers/serviceController.php" method="post">';
                echo '<input type="hidden" name="serviceIdToDelete" value="' . $row["service_id"] . '">';
                echo '<button type="submit" name="deleteService">Delete</button>';
                echo '</form>';
                echo '</td>';

                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No services found.";
        }

        // Close the database connection
        $conn->close();
        ?>

        <!-- Add New Service Form -->
        <form action="../controllers/serviceController.php" method="post">
            <h2>Add New Service</h2>
            <label for="newServiceName">Service Name:</label>
            <input type="text" id="newServiceName" name="newServiceName" required>
            <button type="submit" name="addService">Add Service</button>
        </form>

        <?php
        // Check if the addService button is clicked
        if (isset($_POST["addService"])) {
            // Get the new service name from the form
            $newServiceName = $_POST["newServiceName"];

            // Assume you have a database connection established in db.php
            
            $conn = connectToDatabase();
            // Insert the new service into the database
            $sql = "INSERT INTO services (service_name, total_orders) VALUES ('$newServiceName', 0)";
            if ($conn->query($sql) === TRUE) {
                echo "<p>New service added successfully!</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close the database connection
            $conn->close();
        }
        ?>
    </section>



</body>
</html>
