<?php
include('../models/registrationModel.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['mail'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $nid = $_POST['nid'];
    $password = $_POST['password'];
    $usertype = isset($_POST['register']) && $_POST['register'] === 'Register as a Worker Account' ? 'Worker' : 'Customer';

    // You can adjust this part based on your requirements
    if (registerUser($name, $email, $gender, $dob, $phone, $address, $password, $usertype)) {
        header('Location: ../views/login.php?registration=success');
        exit;
    } else {
        echo "Registration failed. Please try again.";
    }
}
?>
