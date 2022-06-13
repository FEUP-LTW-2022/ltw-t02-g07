<?php
 declare(strict_types = 1);
 session_start();
 require_once('database/connection.db.php');
 require_once('database/restaurant.db.php');
/*
* Write your logic to manage the data
* like storing data in database
*/
 
// POST Data

$db = getDatabaseConnection();
$id = addRestaurant(
            $db,
            $_POST['name'],
            $_POST['picture'],
            $_POST['address'],
            $_POST['category'],
            $_SESSION['id']
            );
echo json_encode($id);
exit;
 
?>