<?php
 declare(strict_types = 1);
 session_start();
 require_once(__DIR__ . '/../database/connection.db.php');

 

$db = getDatabaseConnection();
$stmt = $db->prepare('
 UPDATE Order_row SET State_order = ?
 WHERE OrderId = ?
');

$stmt->execute(array($_POST['state'],$_POST['id']));
exit;
 
?>