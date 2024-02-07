<?php


include('../../models/database.php');
        $conn = connectToDatabase();
        // Check if the delete button is clicked
        if (isset($_POST["deleteService"])) {
            // Get the service ID to be deleted
            $serviceIdToDelete = $_POST["serviceIdToDelete"];

            // Delete the service from the database
            $sqlDelete = "DELETE FROM services WHERE service_id = $serviceIdToDelete";
            if ($conn->query($sqlDelete) === TRUE) {
                echo "<p>Service deleted successfully!</p>";
            } else {
                echo "Error: " . $sqlDelete . "<br>" . $conn->error;
            }
        }

        // Fetch service data from the database
        $sql = "SELECT * FROM services";
        $result = $conn->query($sql);


?>