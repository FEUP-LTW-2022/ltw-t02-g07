<?php
  declare(strict_types = 1);

  function getRestaurants(PDO $db, int $count) {
    $stmt = $db->prepare('SELECT RestaurantId, Name, Picture, Address, Category, Id_owner FROM Restaurant LIMIT ?');
    $stmt->execute(array($count));

    $restaurants = array();
    while ($restaurant = $stmt->fetch()) {
      $restaurants[] = array(
        'id' => $restaurant['RestaurantId'],
        'name' => $restaurant['Name'],
        'picture' => $restaurant['Picture'],
        'address' => $restaurant['Address'],
        'category' => $restaurant['Category'],
        'idOwner' => $restaurant['Id_owner'],
        'score' => getRestaurantScore($db, intval($restaurant['RestaurantId']))
      );
    }

    return $restaurants;
  }

  function getRestaurant(PDO $db, int $id) : array {
    $stmt = $db->prepare('SELECT RestaurantId, Name FROM Restaurant WHERE RestaurantId = ?');
    $stmt->execute(array($id));

    $restaurant = $stmt->fetch();

    return array(
        'id' => $restaurant['RestaurantId'],
        'name' => $restaurant['Name'],
        'address' => $restaurant['Address'],
        'category' => $restaurant['Category'],
        'idOwner' => $restaurant['Id_owner'],
        'dishes' => getRestaurantdishes($db, $id)
    );
  }


  function getRestaurantDishes(PDO $db, int $id) : array {
    $stmt = $db->prepare('
      SELECT DishId, Name, Description, Price, Category, Picture, Promotion
      FROM Dish 
      WHERE Id_restaurant = ?
      GROUP BY DishId
    ');
    $stmt->execute(array($id));

    $dishes = array();

    while ($dish = $stmt->fetch()) {
      $dishes[] = array(
        'id' => $dish['DishId'], 
        'name' => $dish['Name'],
        'description' => $dish['Description'],
        'price' => $dish['Price'],
        'category' => $dish['Category'],
        'picture' => $dish['Picture'],
        'promotion' => $dish['Promotion'],
      );
    }

    return $dishes;
  }
  function getRestaurantOrders(PDO $db, int $id) : array {
    $stmt = $db->prepare('
      SELECT OrderId, Id_user, Id_driver, State_order
      FROM Order_row
      WHERE Id_restaurant = ?
    ');
    $stmt->execute(array($id));

    $orders = array();

    while ($order = $stmt->fetch()) {
      $orders[] = array(
        'id' => $order['OrderId'], 
        'userId' => $order['Id_user'],
        'driverId' => $order['Id_driver'],
        'state' => $order['State_order'],
      );
    }

    return $orders;
  }
  function getRestaurantReviews(PDO $db, int $id) : array {
    $stmt = $db->prepare('
      SELECT ReviewId, Score, Description, Picture, Id_user
      FROM Review
      WHERE Id_restaurant = ?
    ');
    $stmt->execute(array($id));

    $reviews = array();

    while ($review = $stmt->fetch()) {
      $reviews[] = array(
        'id' => $review['ReviewId'], 
        'score' => $review['Score'],
        'description' => $review['Description'],
        'picture' => $review['Picture'],
        'userId' => $review['Id_user'],
      );
    }

    return $reviews;
  }

  function getRestaurantScore(PDO $db, int $id){
    $stmt = $db->prepare('
      SELECT AVG(Score) as Score
      FROM Review
      WHERE Id_restaurant = ?
    ');
    $stmt->execute(array($id));

    $review = $stmt->fetch();


    return $review['Score'];
  }

  function addRestaurant(PDO $db, string $name, string $picture, string $address, string $category, int $ownerId){
      $stmt = $db->prepare('
          INSERT INTO Restaurant (Name, Picture, Address, Category, Id_owner) VALUES (?,?,?,?,?)
      ');
      $stmt->execute(array($name,$picture,$address,$category,$ownerId));
      return true;


}
  


?>