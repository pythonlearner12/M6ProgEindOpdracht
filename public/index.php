<?php
include_once("server/config.php");
$conn = database_connect();
$websiteInfo = $conn->query('SELECT * FROM websiteText')->fetch_all();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <?php require_once("components/header.php") ?>

    <main style="background-color:#f8f9fa;">
        <section style="position: relative;">
            <img id="heroImg" style="width: 100%;" src="img/heroImg.jpg" alt="">
            <img id="heroImgPhone" style="width: 100%;" src="img/heroImgPhone.jpg" alt="">
            <div id="herotext" style="display: flex; align-items:center; flex-direction:column; justify-content:center">
                <h2><?php echo $websiteInfo[0][3] ?></h2>
                <p><?php echo $websiteInfo[0][2] ?></p>
            </div>

        </section>
    </main>

    <?php require_once('components/footer.php') ?>
</body>

</html>