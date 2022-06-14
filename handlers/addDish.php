<?php
 declare(strict_types = 1);
 session_start();
 require_once(__DIR__ . '/../database/connection.db.php');
 require_once('database/dish.class.php');

$dish = new Dish(0,
                 htmlspecialchars($_POST['name']),
                 htmlspecialchars($_POST['description']),
                 floatval($_POST['price']),
                 htmlspecialchars($_POST['category']),
                 htmlspecialchars($_POST['picture']),
                 intval(htmlspecialchars($_POST['promotion'])),
                 intval($_POST['restaurantId']));

$db = getDatabaseConnection();
$id = $dish->addDish($db,);

echo json_encode($id);

exit;
 
?>