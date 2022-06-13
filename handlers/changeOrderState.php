<?php
 declare(strict_types = 1);
 session_start();
 require_once('database/connection.db.php');
 require_once('database/restaurant.db.php');

 

$db = getDatabaseConnection();
$stmt = $db->prepare('
 UPDATE Order_row SET State_order = ?
 WHERE OrderId = ?
');

$stmt->execute(array($_POST['state'],$_POST['id']));
exit;
 
?>