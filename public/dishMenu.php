<?php
include_once("server/config.php");
require_once("server/functions.php");
$conn = database_connect();


if (isset($_POST['tableNumber'])) {
    $tableNumber = $_POST['tableNumber'];
    $starter = $_POST['starterDishId'] ?? null;
    $main = $_POST['mainCourseDishId'] ?? null;
    $dessert = $_POST['dessertDishId'] ?? null;
    $lunch = $_POST['lunchDishId'] ?? null;

    $sql = 'INSERT INTO requests (`table`, starter_dish_id, main_dish_id, dessert_dish_id, lunch_dish_id) VALUES ($tableNumber, $starter, $main, $dessert, $lunch)';
    executeQueryWithAutoParams($conn, $sql);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dish Menu</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="js/event_listeners.js" defer></script>
</head>

<body>
    <?php include_once('components/header.php') ?>

    <main style="display:flex; flex-direction:column; padding:5rem 0; align-items:center; background-color:#f8f9fa">
        <section style="display: flex; justify-content:center; flex-direction:column; align-items:center; gap:2rem; width:60rem; background-color:aliceblue; padding:5rem; border-radius:1rem;">
            <h1 style="align-self: center; font-size:3rem;">Dish Menu</h1>

            <form action="" method="POST" style="width: 100%;">
                <ol id="counters">
                    <?php
                    $dish_types = $conn->query('SELECT * FROM dishtype')->fetch_all();
                    ?>
                    <?php foreach ($dish_types as [$id, $name]): ?>
                        <li style="margin-bottom: 5rem; margin-top:2rem; width:100%;">
                            <h2 style="margin-bottom: 1rem; font-size:2.8rem;"><?php echo $name ?></h2>
                            <hr style="height:0.1rem; background-color:black; margin-bottom:2rem;">
                            <ul>
                                <?php
                                $sql = 'SELECT * FROM dishes WHERE dishtype_id = $id';
                                $result = executeQueryWithAutoParams($conn, $sql);
                                ?>
                                <?php foreach ($result as $dish): ?>
                                    <li>
                                        <div style="display: flex; justify-content:space-between;">
                                            <h3 style="font-weight:600;"><?php echo $dish['name'] ?></h3>
                                            <span>€<?php echo $dish['price'] ?></span>
                                        </div>
                                        <div style="display:flex; justify-content:space-between">
                                            <p style="max-width: 90%; font-size:1.4rem;"><?php echo $dish['ingrediants'] ?></p>
                                        </div>
                                        <?php if ($name === "Starter"): ?>
                                            <input type="radio" name="starterDishId" value="<?php echo $dish['id'] ?>" /> Select
                                        <?php elseif ($name === "Main Course"): ?>

                                            <input type="radio" name="mainCourseDishId" value="<?php echo $dish['id'] ?>" /> Select
                                        <?php elseif ($name === "Dessert"): ?>
                                            <input type="radio" name="dessertDishId" value="<?php echo $dish['id'] ?>" /> Select
                                        <?php elseif ($name === "Lunch"): ?>
                                            <input type="radio" name="lunchDishId" value="<?php echo $dish['id'] ?>" /> Select
                                        <?php endif; ?>
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