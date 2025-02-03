<?php

require_once("server/config.php");
require_once("server/functions.php");
$conn = database_connect();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requested_date = $_POST['date'] ?? NULL;
    $requested_time = $_POST['time'] ?? NULL;
    $requested_max_people = $_POST['maxPeople'] ?? NULL;
    $requested_name = $_POST['name'] ?? NULL;

    if (!$requested_date || !$requested_time || !$requested_max_people || !$requested_name) {
        die("All fields are required.");
    }

    $sqlInsertReservation =
        'INSERT INTO reservation (tablenumber, date, time, name)
        SELECT tablenumber, $requested_date, $requested_time, $requested_name
        FROM tables
        WHERE maxpeople = $requested_max_people
            AND NOT EXISTS (
                SELECT 1
                FROM reservation r
                WHERE r.tablenumber = tables.tablenumber
                AND r.date = $requested_date
                AND r.time BETWEEN ADDTIME($requested_time, "-01:59:59") AND ADDTIME($requested_time, "01:59:59")
            )
        LIMIT 1';

    $result = executeQueryWithAutoParams($conn, $sqlInsertReservation);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Check</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        main {
            display: flex;
            align-items: center;
            justify-content: center;

            margin: 14rem 0;
        }

        form {
            background-color: #fff;
            padding: 2rem;
            border-radius: 0.8rem;
            box-shadow: 0 0.4rem 0.8rem rgba(0, 0, 0, 0.1);
            width: 30rem;
            text-align: center;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 1rem;
            margin: 0.8rem 0;
            border: 0.1rem solid #ccc;
            border-radius: 0.4rem;
            font-size: 1.6rem;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        input:focus,
        select:focus,
        button:focus {
            outline: none;
            border-color: #007bff;
        }
    </style>
</head>

<body>
    <?php require_once("components/header.php") ?>

    <main>
        <form action="" method="POST">
            <h2>Reservation Form</h2>
            <input name="date" type="date" required>
            <input name="maxPeople" type="number" placeholder="Number of people" required>
            <input name="name" type="text" placeholder="Your name" required>
            <select name="time" required>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <option value="19:00">19:00</option>
                <option value="20:00">20:00</option>
            </select>

            <button type="submit">reserve</button>
            <?php
            if (isset($result)) {
                if ($result) {
                    echo "you have reserved a table";
                } else {
                    echo "you have failed to reserve a table";
                }
            }

            ?>
        </form>

    </main>
    <?php require_once("components/footer.php") ?>

</body>

</html>