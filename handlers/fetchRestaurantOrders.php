<?php
 declare(strict_types = 1);
 session_start();
 require_once('database/connection.db.php');
 require_once('database/restaurant.db.php');
 require_once('database/user.class.php');

$db = getDatabaseConnection();
$orders = getRestaurantOrders($db,intval($_POST['id']));
echo '<table class="myTable">
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Driver Name</th>
            <th>State</th>
        </tr>';
if(count($orders) > 0){
    foreach($orders as $order) {
      $user = User::getUser($db,$order['userId']);
      echo "<tr data-id=" . $order["id"] . ">
              <td>" . $user->name. "</td>
              <td>" . $user->phone . "</td>
              <td>" . "placeholder". "</td>
              <td>" . $order["state"] ."</td>
            </tr>";
    }
  }
  echo "</table>";
exit;
 
?>