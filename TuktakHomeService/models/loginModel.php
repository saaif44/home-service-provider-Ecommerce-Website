<?php
include('database.php');

function loginUser($phoneNo, $password) {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM users WHERE phoneNo = '$phoneNo' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if ($user['active'] == 1) {
            $_SESSION['phoneNo'] = $user['phoneNo'];

            if ($user['usertype'] === 'Customer') {
                header('Location: ../views/customer/customerDashboard.php');
            } elseif ($user['usertype'] === 'Worker') {
                header('Location: ../views/worker/workerDashboard.php');
            }

            exit;
        } else {
            $_SESSION['deactivated'] = true;
            return false; 
        }
    }

    return false;
}

?>
