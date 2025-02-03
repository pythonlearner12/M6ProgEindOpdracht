<?php
include_once("server/config.php");
require_once('server/functions.php');
$conn = database_connect();

if (isset($_POST['tableNumber'])) {
    $tableNumber = $_POST['tableNumber'];
    $drink = $_POST['drinkId'] ?? null;

    $sql = 'INSERT INTO requests (`table`, drinks_id) VALUES ($tableNumber, $drink)';
    executeQueryWithAutoParams($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drink Menu</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="js/event_listeners.js" defer></script>
</head>

<body>
    <?php include_once('components/header.php') ?>

    <main style="display:flex; flex-direction:column; padding:5rem 0; align-items:center; background-color:#f8f9fa"">
        <section style="display: flex; justify-content:center; flex-direction:column; align-items:center; gap:2rem; width:60rem; background-color:aliceblue; padding:5rem; border-radius:1rem;">
            <h1 style="align-self: center; font-size:3rem;">drink Menu</h1>

            <form action="" method="POST" style="width: 100%;">
                <ol>
                    <?php
                    $drink_types = $conn->query('SELECT * FROM drinktype')->fetch_all();
                    ?>
                    <?php foreach ($drink_types as [$id, $name]): ?>
                        <li style="margin-bottom: 5rem; margin-top:2rem; width:100%;">
                            <h2 style="margin-bottom: 1rem; font-size:2.8rem;"><?php echo $name ?></h2>
                            <hr style="height:0.1rem; background-color:black; margin-bottom:2rem;">
                            <ul>
                                <?php
                                $sql = 'SELECT * FROM drinks WHERE drinktype_id = $id';
                                $result = executeQueryWithAutoParams($conn, $sql);
                                ?>
                                <?php foreach ($result as $drink): ?>
                                    <li>
                                        <div style="display: flex; justify-content:space-between;">
                                            <h3 style="font-weight:600;"><?php echo $drink['name'] ?></h3>
                                            <span>€<?php echo $drink['price'] ?></span>
                                        </div>
                                        <div style="display:flex; justify-content:space-between">
                                            <p style="max-width: 90%; font-size:1.4rem;"><?php echo $drink['ingrediants'] ?></p>
                                        </div>
                                        <input type="radio" name="drinkId" value="<?php echo $drink['id'] ?>" />
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ol>

                <div style="display: flex; justify-content:space-around; width:100%;">
                    <input name="tableNumber" style="border-radius: 1rem; padding:1rem" type="number" placeholder="Table Number" required>
                    <button type="submit" style="font-size: 2rem; background-color:inherit; cursor:pointer; border:0.1rem solid black; border-radius:1rem; padding:1rem;">Checkout</button>
                </div>
            </form>
        </section>
    </main>

    <?php require_once("components/footer.php") ?>
</body>

</html>