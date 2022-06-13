<?php
 declare(strict_types = 1);
 session_start();
 require_once('database/connection.db.php');
 require_once('database/restaurant.class.php');
 require_once('database/user.class.php');

$db = getDatabaseConnection();
$reviews = getRestaurantReviews($db,intval($_POST['id']));
echo '<table class="myTable">
        <tr>
            <th>Score</th>
            <th>Description</th>
            <th>Picture</th>
            <th>Reviewer</th>
        </tr>';
if(count($reviews) > 0){
    foreach($reviews as $review) {
      $user = User::getUser($db,$review['userId']);
      echo "<tr data-id=" . $review["id"] . ">
              <td>" . $review["score"]. "</td>
              <td>" . $review["description"] . "</td>
              <td>" . $review["picture"]. "</td>
              <td>" . $user->name ."</td>
            </tr>";
    }
  }
  echo "</table>";
exit;
 
?>