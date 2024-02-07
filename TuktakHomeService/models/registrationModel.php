<?php
include('database.php');
$conn = connectToDatabase();
function registerUser($name, $email, $gender, $dob, $phone, $address, $password, $usertype) {
    $conn = connectToDatabase();
    $sql = "INSERT INTO users (name, email, gender, dob, phoneNo, address, password, usertype) 
            VALUES ('$name', '$email', '$gender', '$dob', '$phone', '$address', '$password', '$usertype')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
?>