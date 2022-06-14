<?php
 declare(strict_types = 1);
 session_start();
 require_once(__DIR__ . '/../database/connection.db.php');
 require_once(__DIR__ . '/../database/dish.class.php');

$dish = new Dish(0,
                 $_POST['name'],
                 $_POST['description'],
                 floatval($_POST['price']),
                 $_POST['category'],
                 $_POST['picture'],
                 intval($_POST['promotion']),
                 intval($_POST['restaurantId']));

$db = getDatabaseConnection();
$id = $dish->addDish($db,);

echo json_encode($id);

exit;
 
?>