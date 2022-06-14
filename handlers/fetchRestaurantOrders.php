<?php
 declare(strict_types = 1);
 session_start();
 require_once(__DIR__ . '/../database/connection.db.php');
 require_once('database/restaurant.class.php');
 require_once('database/user.class.php');

$db = getDatabaseConnection();
$orders = Restaurant::getRestaurantOrders($db,intval($_POST['id']));

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
      $select = "";
      switch ($order["state"]) {
        case 'received':
          $select = "<select onchange=\"stateChange(this.id)\" name=\"state\" id=\"state\">
                        <option selected value=\"received\">received</option>
                        <option value=\"preparing\">preparing</option>
                        <option value=\"ready\">ready</option>
                        <option value=\"delivered\">delivered</option>
                      </select>";
          break;
        case 'preparing':
          $select = "<select onchange=\"stateChange(this.id)\" name=\"state\" id=\"state\">
                        <option value=\"received\">received</option>
                        <option selectedvalue=\"preparing\">preparing</option>
                        <option value=\"ready\">ready</option>
                        <option value=\"delivered\">delivered</option>
                      </select>";
          break;
        case 'ready':
          $select = "<select onchange=\"stateChange(this.id)\" name=\"state\" id=\"state\">
                        <option value=\"received\">received</option>
                        <option value=\"preparing\">preparing</option>
                        <option selected value=\"ready\">ready</option>
                        <option value=\"delivered\">delivered</option>
                      </select>";
          break;
        case 'delivered':
          $select = "<select onchange=\"stateChange(this.id)\" name=\"state\" id=\"state\">
                        <option value=\"received\">received</option>
                        <option value=\"preparing\">preparing</option>
                        <option value=\"ready\">ready</option>
                        <option selected value=\"delivered\">delivered</option>
                      </select>";
          break;
        default:
          # code...
          break;
      }
      echo "<tr data-id=" . $order["id"] . ">
              <td>" . $user->name. "</td>
              <td>" . $user->phone . "</td>
              <td>" . "placeholder". "</td>
              <td>" . $select ."</td>
            </tr>";
    }
  }
  echo "</table>";
exit;
 
?>