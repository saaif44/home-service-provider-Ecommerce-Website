
<?php
// session_start();

// if (!isset($_SESSION['user_phoneNo'])) {
//     header("location: ../../views/login.php");
//     exit;
// }



session_start();

if (!isset($_SESSION['phoneNo'])) {
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../../views/login.php';
    header("location: $redirect");
    exit;
}
?>
