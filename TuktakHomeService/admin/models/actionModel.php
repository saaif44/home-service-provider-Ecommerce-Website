<section>
<h2>Customer Information</h2>

<?php
// Fetch customer data from the database
include('../../models/database.php');
$conn = connectToDatabase();
$sqlCustomer = "SELECT *, 
                CASE 
                    WHEN DATEDIFF(CURDATE(), profile_created_date) > 365 
                        AND total_order_completed < 10 
                        AND ratings < 3.5 THEN 'Freeze'
                    WHEN DATEDIFF(CURDATE(), profile_created_date) > 365 
                        AND total_order_completed >= 10 
                        AND ratings >= 3.5 THEN 'Good'
                    ELSE 'Risk'
                END AS health
                FROM users 
                WHERE usertype = 'Customer'";
$resultCustomer = $conn->query($sqlCustomer);

if ($resultCustomer->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Completed Orders</th><th>Profile Created Date</th><th>Ratings</th><th>Health</th><th>Freeze Status</th></tr>";
    while ($rowCustomer = $resultCustomer->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $rowCustomer["id"] . "</td>";
        echo "<td>" . $rowCustomer["name"] . "</td>";
        echo "<td>" . $rowCustomer["email"] . "</td>";
        echo "<td>" . $rowCustomer["total_order_completed"] . "</td>";
        echo "<td>" . $rowCustomer["profile_created_date"] . "</td>";
        echo "<td>" . $rowCustomer["ratings"] . "</td>";
        echo "<td>" . $rowCustomer["health"] . "</td>";
        echo "<td>";
        if ($rowCustomer["active"] == 1) {
            echo "<button class='freeze-btn ice' onclick='toggleFreeze(" . $rowCustomer["id"] . ", \"customer\")'>Freeze</button>";
        } else {
            echo "<button class='freeze-btn frozen' onclick='toggleFreeze(" . $rowCustomer["id"] . ", \"customer\")'>Unfreeze</button>";
        }
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No customer data found.";
}

// Close the database connection
$conn->close();
?>

</section>

<section>
<h2>Worker Information</h2>

<?php
// Fetch worker data from the database
$conn = connectToDatabase();
$sqlWorker = "SELECT *, 
               CASE 
                    WHEN DATEDIFF(CURDATE(), profile_created_date) > 365 
                        AND total_order_completed < 10 
                        AND ratings < 3.5 THEN 'Freeze'
                    WHEN DATEDIFF(CURDATE(), profile_created_date) > 365 
                        AND total_order_completed >= 10 
                        AND ratings >= 3.5 THEN 'Good'
                    ELSE 'Risk'
                END AS health
                FROM users 
                WHERE usertype = 'Worker'";
$resultWorker = $conn->query($sqlWorker);

if ($resultWorker->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Completed Orders</th><th>Profile Created Date</th><th>Ratings</th><th>Health</th><th>Freeze Status</th></tr>";
    while ($rowWorker = $resultWorker->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $rowWorker["id"] . "</td>";
        echo "<td>" . $rowWorker["name"] . "</td>";
        echo "<td>" . $rowWorker["email"] . "</td>";
        echo "<td>" . $rowWorker["total_order_completed"] . "</td>";
        echo "<td>" . $rowWorker["profile_created_date"] . "</td>";
        echo "<td>" . $rowWorker["ratings"] . "</td>";
        echo "<td>" . $rowWorker["health"] . "</td>";
        echo "<td>";
        if ($rowWorker["active"] == 1) {
            echo "<button class='freeze-btn ice' onclick='toggleFreeze(" . $rowWorker["id"] . ", \"worker\")'>Freeze</button>";
        } else {
            echo "<button class='freeze-btn frozen' onclick='toggleFreeze(" . $rowWorker["id"] . ", \"worker\")'>Unfreeze</button>";
        }
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No worker data found.";
}


$conn->close();
?>

</section>

<section>
<h2>Top Worst Customers</h2>

<?php
$conn = connectToDatabase();

// Fetch top worst customers based on average ratings less than 2.5
$sqlTopWorstCustomers = "SELECT id, name, email, active, AVG(ratings) AS avg_ratings, 
                       CASE 
                            WHEN DATEDIFF(CURDATE(), profile_created_date) > 365 
                                AND total_order_completed < 10 
                                AND AVG(ratings) < 3.5 THEN 'Freeze'
                            WHEN DATEDIFF(CURDATE(), profile_created_date) > 365 
                                AND total_order_completed >= 10 
                                AND AVG(ratings) >= 3.5 THEN 'Good'
                            ELSE 'Risk'
                        END AS health
                        FROM users 
                WHERE usertype = 'Customer' 
                        GROUP BY id, name, email 
                        HAVING avg_ratings < 2.5 
                        ORDER BY avg_ratings";
$resultTopWorstCustomers = $conn->query($sqlTopWorstCustomers);

if ($resultTopWorstCustomers->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Average Ratings</th><th>Health</th><th>Freeze Status</th></tr>";
    while ($rowTopWorstCustomer = $resultTopWorstCustomers->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $rowTopWorstCustomer["id"] . "</td>";
        echo "<td>" . $rowTopWorstCustomer["name"] . "</td>";
        echo "<td>" . $rowTopWorstCustomer["email"] . "</td>";
        echo "<td>" . $rowTopWorstCustomer["avg_ratings"] . "</td>";
        echo "<td>" . $rowTopWorstCustomer["health"] . "</td>";
        echo "<td>";
        if ($rowTopWorstCustomer["active"] == 1){
            echo "<button class='freeze-btn ice' onclick='toggleFreeze(" . $rowTopWorstCustomer["id"] . ", \"customer\")'>Freeze</button>";
        } else {
            echo "<button class='freeze-btn frozen' onclick='toggleFreeze(" . $rowTopWorstCustomer["id"] . ", \"customer\")'>Unfreeze</button>";
        }
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No top worst customers found.";
}


$conn->close();
?>

</section>

<section>
<h2>Top Worst Workers</h2>

<?php

$conn = connectToDatabase();

// Fetch top worst workers ratings less than 2.5
$sqlTopWorstWorkers = "SELECT id, name, email, active, AVG(ratings) AS avg_ratings, 
                       CASE 
                            WHEN DATEDIFF(CURDATE(), profile_created_date) > 365 
                                AND total_order_completed < 10 
                                AND AVG(ratings) < 3.5 THEN 'Freeze'
                            WHEN DATEDIFF(CURDATE(), profile_created_date) > 365 
                                AND total_order_completed >= 10 
                                AND AVG(ratings) >= 3.5 THEN 'Good'
                            ELSE 'Risk'
                        END AS health
                        FROM users 
                WHERE usertype = 'Worker' 
                        GROUP BY id, name, email 
                        HAVING avg_ratings < 2.5 
                        ORDER BY avg_ratings";
$resultTopWorstWorkers = $conn->query($sqlTopWorstWorkers);

if ($resultTopWorstWorkers->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Average Ratings</th><th>Health</th><th>Freeze Status</th></tr>";
    while ($rowTopWorstWorker = $resultTopWorstWorkers->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $rowTopWorstWorker["id"] . "</td>";
        echo "<td>" . $rowTopWorstWorker["name"] . "</td>";
        echo "<td>" . $rowTopWorstWorker["email"] . "</td>";
        echo "<td>" . $rowTopWorstWorker["avg_ratings"] . "</td>";
        echo "<td>" . $rowTopWorstWorker["health"] . "</td>";
        echo "<td>";
        if ($rowTopWorstWorker["active"] == 1) {
            echo "<button class='freeze-btn ice' onclick='toggleFreeze(" . $rowTopWorstWorker["id"] . ", \"worker\")'>Freeze</button>";
        } else {
            echo "<button class='freeze-btn frozen' onclick='toggleFreeze(" . $rowTopWorstWorker["id"] . ", \"worker\")'>Unfreeze</button>";
        }
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No top worst workers found.";
}


$conn->close();
?>

</section>



<script>
// javaScript to handle the manual freeze/unfreeze button
function toggleFreeze(userId, userType) {
    var confirmToggle = confirm("Are you sure you want to toggle the freeze status for this account?");
    if (confirmToggle) {
        // redirect to the toggle freeze backend with the user ID and user type
        window.location.href = "../controllers/toggleFreezeBackend.php?id=" + userId + "&type=" + userType;
    }
}
</script>
