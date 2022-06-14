<?php
 declare(strict_types = 1);
 session_start();

 require_once(__DIR__ . '/../database/connection.db.php');

 
 
$db = getDatabaseConnection();
$stmt = $db->prepare('
 DELETE FROM Restaurant
 WHERE RestaurantId = ?
');
$stmt->execute(array($_POST['id']));
exit;
 
?>