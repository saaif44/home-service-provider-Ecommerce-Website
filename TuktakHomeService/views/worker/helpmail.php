<?php

include("../../controllers/worker/LoginCheck.php");
include("../../controllers/worker/helpController.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Mail</title>
    <link rel="stylesheet" href="../../public/css/workerDashboard.css">
    <link rel="stylesheet" href="../../public/css/tablestyle.css">
</head>

<style>
    .help-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        margin-top: 20px; 
    }

    #helpForm {
        max-width: 400px; 
        width: 100%;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #helpForm label,
    #helpForm textarea,
    #helpForm button {
        margin-bottom: 15px;
    }
</style>


<body>
    <div class="navbar">
        <div class="profile">
            <img src="profile-image.jpg" alt="Profile Picture">
            <div><?php echo $name; ?></div>
        </div>
        <?php include("nav.php"); ?>
    </div>

    <div class="help-form">
        <h2>Need Help? Send Us a Message</h2>
        <form id="helpForm">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="phoneNo" value="<?php echo $_SESSION['user_phoneNo']; ?>">

            <label for="message">Your Message:</label>
            <textarea name="message" rows="4" required></textarea>

            <button type="submit" name="submit_help">Submit</button>
        </form>
    </div>

    <div class="order-list">
        <h2>Your Help Messages</h2>
        <table>
            <thead>
                <tr>
                    <th>name</th>
                    <th>email</th>
                    <th>Admin Reply</th>
                    <th>Date</th>
                    <th>Message</th>
                    <th>Admin Reply</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($helpMessages as $message) : ?>
                    <tr>
                        <td><?php echo $message['name']; ?></td>
                        <td><?php echo $message['email']; ?></td>
                        <td><?php echo $message['admin_reply']; ?></td>
                        <td><?php echo $message['created_date']; ?></td>
                        <td><?php echo $message['message']; ?></td>
                        <td><?php echo $message['admin_reply']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('helpForm').addEventListener('submit', async function (event) {
            event.preventDefault();

            const formData = new FormData(event.target);

            try {
                const response = await fetch('../../models/worker/submitHelpModel.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    alert(result.message);
                } else {
                    alert('Error: ' + result.message);
                }
            } catch (error) {
                console.error('An error occurred:', error);
                alert('An error occurred while submitting your help message.');
            }
        });
    </script>
</body>
</html>
