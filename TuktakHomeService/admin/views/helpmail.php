<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tukitaki - Helpmail</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        .reply-form-container {
            display: none;
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #fff;
        }
    </style>
</head>
<body>

    <header>
        <h1>Helpmail</h1>
    </header>

    <?php 
    include("nav.php");
    ?>


    <section>
        <h2>Inquiries</h2>
        <?php
        if ($resultHelpmails->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Name</th><th>Email</th><th>Message</th><th>Date</th><th>Admin Reply</th></tr>";
            while ($rowHelpmail = $resultHelpmails->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $rowHelpmail["name"] . "</td>";
                echo "<td>" . $rowHelpmail["email"] . "</td>";
                echo "<td>" . $rowHelpmail["message"] . "</td>";
                echo "<td>" . $rowHelpmail["created_date"] . "</td>";
                
                //check if admin reply is present
                if (!empty($rowHelpmail["admin_reply"])) {
                    //displaying admin reply text
                    echo "<td>" . $rowHelpmail["admin_reply"] . "</td>";
                } else {
                    //displaying reply button and reply form
                    echo "<td>";
                    echo "<button class='reply-btn' onclick='showReplyForm(" . $rowHelpmail["id"] . ")'>Reply</button>";
                    echo "<div id='reply-form-" . $rowHelpmail["id"] . "' class='reply-form-container'>";
                    echo "<textarea id='admin_reply-" . $rowHelpmail["id"] . "' rows='4'></textarea>";
                    echo "<button onclick='submitReply(" . $rowHelpmail["id"] . ")'>Submit Reply</button>";
                    echo "</div>";
                    echo "</td>";
                }
                
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No inquiries found.";
        }
        ?>

    <script>
    function showReplyForm(inquiryId) {
        // Hide all reply forms
        document.querySelectorAll('.reply-form-container').forEach(form => form.style.display = 'none');

        // Show the selected reply form
        const replyForm = document.getElementById('reply-form-' + inquiryId);
        replyForm.style.display = 'block';
    }

    function submitReply(inquiryId) {
        // Get the admin reply text
        const adminReplyText = document.getElementById('admin_reply-' + inquiryId).value;

        // Send the admin reply to the server using AJAX
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the display with the admin reply
                const adminReplyDisplay = document.querySelector('td:nth-child(5)'); // Adjust the index based on your table structure
                adminReplyDisplay.textContent = adminReplyText;

                // Hide the reply form
                const replyForm = document.getElementById('reply-form-' + inquiryId);
                replyForm.style.display = 'none';
            }
        };
        xhr.open('POST', '../controllers/submitReplyController.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('inquiry_id=' + encodeURIComponent(inquiryId) + '&admin_reply=' + encodeURIComponent(adminReplyText));
    }
    </script>

    </section>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
