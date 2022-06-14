<?php
 declare(strict_types = 1);
 session_start();
 if (!isset($_SESSION['id'])) {
     echo json_encode(array());
     exit;
    }
 require_once(__DIR__ . '/../database/connection.db.php');
 require_once('database/favorite.class.php');
/*
* Write your logic to manage the data
* like storing data in database
*/
 
// POST Data
$db = getDatabaseConnection();
$arr = Favorite::getFavoriteDishes($db,intval($_SESSION['id']),);
$tmp = array();
foreach($arr as $element){
    $tmp[] = $element->id;
}
echo json_encode($tmp);

?>