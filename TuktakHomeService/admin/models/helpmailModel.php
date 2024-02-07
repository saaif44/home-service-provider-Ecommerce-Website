<?php

include('../../models/database.php');
$conn = connectToDatabase();

//fetch help mails from the database
$sqlHelpmails = "SELECT * FROM helpmails ORDER BY created_date DESC";
$resultHelpmails = $conn->query($sqlHelpmails);
?>