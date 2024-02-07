<!-- <?php include("../controllers/checkLogged.php"); ?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action</title>
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

        .freeze-btn {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            cursor: pointer;
        }
        .freeze-btn {
            padding: 5px 10px;
            font-size: 12px;
            cursor: pointer;
        }

        .freeze-btn.frozen {
            background-color: #3498db;
            color: #fff;
        }

        .freeze-btn.ice {
            background-color: #ecf0f1;
            color: #333;
        }
    </style>
</head>
<body>

    <header>
        <h1>Action</h1>
    </header>

    <?php 
    include("nav.php");
    include("../controllers/actionTable.php");
    ?>

</body>
</html>