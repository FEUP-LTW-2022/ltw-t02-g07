<?php
  declare(strict_types = 1);

  function getRestaurants(PDO $db, int $count) {
    $stmt = $db->prepare('SELECT RestaurantId, Name FROM Restaurant LIMIT ?');
    $stmt->execute(array($count));

    $restaurants = array();
    while ($restaurant = $stmt->fetch()) {
      $restaurants[] = array(
        'id' => $restaurant['RestaurantId'],
        'name' => $restaurant['Name'],
        'address' => $restaurant['Address'],
        'category' => $restaurant['Category'],
        'idOwner' => $restaurant['Id_owner']
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
        'dishes' => getRestaurantDishes($db, $id)
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
        'price' => $dish['Price']
      );
    }

    return $dishes;
  }

?>