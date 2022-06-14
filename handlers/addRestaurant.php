<?php
 declare(strict_types = 1);
 session_start();
 require_once(__DIR__ . '/../database/connection.db.php');
 require_once('database/restaurant.class.php');
/*
* Write your logic to manage the data
* like storing data in database
*/
 
// POST Data

$db = getDatabaseConnection();
$id = Restaurant::addRestaurant(
            $db,
            htmlspecialchars($_POST['name']),
            htmlspecialchars($_POST['picture']),
            htmlspecialchars($_POST['address']),
            htmlspecialchars($_POST['category']),
            $_SESSION['id']
            );
echo json_encode($id);
exit;
 
?>