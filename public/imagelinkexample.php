<?php
require_once("server/config.php");
$conn = database_connect();

$sql = "SELECT imagelink FROM drinks";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drink Images</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <style>
        img{
            display: block;
        }
    </style>
</head>

<body>
    <?php include_once('components/header.php') ?>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imageLink = $row['imagelink'];
            echo '<img style="width: 50%;" src="' . htmlspecialchars($imageLink) . '" alt="Drink Image">';
        }
    } else {
        echo "No images found.";
    }
    ?>
    <?php include_once('components/footer.php') ?>

</body>

</html>