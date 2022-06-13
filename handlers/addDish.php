<?php
 declare(strict_types = 1);
 session_start();
 require_once('database/connection.db.php');
 require_once('database/dish.class.php');
/*
* Write your logic to manage the data
* like storing data in database
*/
 
// POST Data
$dish = new Dish(0,
                 $_POST['name'],
                 $_POST['description'],
                 floatval($_POST['price']),
                 $_POST['category'],
                 $_POST['picture'],
                 intval($_POST['promotion']));
$db = getDatabaseConnection();
$id = $dish->addDish($db,intval($_POST['restaurantId']));

echo json_encode($id);

exit;
 
?>