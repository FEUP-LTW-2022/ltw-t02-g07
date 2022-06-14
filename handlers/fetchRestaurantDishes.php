<?php
 declare(strict_types = 1);
 session_start();
 require_once(__DIR__ . '/../database/connection.db.php');
 require_once('database/dish.class.php');

$db = getDatabaseConnection();
$dishes = Dish::getRestaurantDishes($db,intval($_POST['id']));
echo '<table id="dishTable" name="dishesTable" class="myTable">
        <tr >
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Picture</th>
            <th>Promotion</th>
        </tr>';
if(count($dishes) > 0){
    foreach($dishes as $dish) {
      echo "<tr contenteditable=true data-id=" . $dish->id . ">
              <td>" . $dish->name. "</td>
              <td>" . $dish->description . "</td>
              <td>" . $dish->price. "</td>
              <td>" . $dish->category ."</td>
              <td>" . $dish->picture ."</td>
              <td>" . $dish->promotion ."</td>
            </tr>";
    }
  }
  echo "</table>";
exit;
 
?>