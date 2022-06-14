<?php
 declare(strict_types = 1);
 session_start();
 require_once(__DIR__ . '/../database/connection.db.php');

 

$db = getDatabaseConnection();
echo $_POST['data'][0];
foreach($_POST['data'] as &$item){
    $item = htmlspecialchars($item);
}

switch ($_POST['type']) {
    case 'restaurantsTable':
        $stmt = $db->prepare('
            UPDATE Restaurant SET Name = ?, Picture = ?, Address = ?, Category = ?
            WHERE RestaurantId = ?
        ');
        $tmp = $_POST['data'];
        $array = array_push($tmp,$_POST['id']);
        $stmt->execute($tmp);
        break;
    case 'dishesTable':
        $stmt = $db->prepare('
            UPDATE Dish SET Name = ?, Description = ?, Price = ?, Category = ?, Picture = ?, Promotion = ?
            WHERE DishId = ?
        ');
        $tmp = $_POST['data'];
        $array = array_push($tmp,$_POST['id']);
        $stmt->execute($tmp);
        break;
    case 'reviewsTable':
        $stmt = $db->prepare('
            UPDATE Review SET Response = ?
            WHERE ReviewId = ?
        ');
        $tmp = array(end($_POST['data']));
        array_push($tmp,$_POST['id']);
        $stmt->execute($tmp);
        break;
    default:
        # code...
        break;
}

exit;
 
?>