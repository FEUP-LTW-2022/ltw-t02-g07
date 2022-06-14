<?php
 declare(strict_types = 1);
 session_start();
 require_once(__DIR__ . '/../database/connection.db.php');
 require_once(__DIR__ . '/../database/favorite.class.php');
/*
* Write your logic to manage the data
* like storing data in database
*/
 
// POST Data
$db = getDatabaseConnection();
Favorite::deleteFavoriteRestaurant($db,intval($_SESSION['id']),intval($_POST['restaurantId']));

exit;
 
?>