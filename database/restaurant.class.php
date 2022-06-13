<?php
  declare(strict_types = 1);


  class Restaurant{

    public int $id;
    public string $name;
    public string $address;
    public string $picture;
    public string $category;
    public int $idOwner;

    public function __construct(int $id, string $name, string $address, string $picture, string $category, int $idOwner)
    { 
      $this->id = $id;
      $this->name = $name;
      $this->address = $address;
      $this->picture = $picture;
      $this->category = $category;
      $this->idOwner = $idOwner;

    }

    static function getRestaurants(PDO $db, int $count) {
      $stmt = $db->prepare('SELECT RestaurantId, Name, Address, Picture, Category, Id_owner FROM Restaurant LIMIT ?');
      $stmt->execute(array($count));
  
      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          intval($restaurant['RestaurantId']),
          $restaurant['Name'],
          $restaurant['Address'],
          $restaurant['Picture'],
          $restaurant['Category'],
          intval($restaurant['Id_owner']),
        );
      }
  
      return $restaurants;
    }
  
    static function getRestaurant(PDO $db, int $id) : Restaurant {
      $stmt = $db->prepare('SELECT RestaurantId, Name, Address, Picture, Category, Id_owner FROM Restaurant WHERE RestaurantId = ?');
      $stmt->execute(array($id));
  
      $restaurant = $stmt->fetch();
  
      return new Restaurant(
          intval($restaurant['RestaurantId']),
          $restaurant['Name'],
          $restaurant['Address'],
          $restaurant['Picture'],
          $restaurant['Category'],
          intval($restaurant['Id_owner']),
      );
    }
    static function getRestaurantDishes(PDO $db, int $id) : array {
      $stmt = $db->prepare('
        SELECT DishId, Name, Description, Price, Category, Picture, Promotion
        FROM Dish 
        WHERE Id_restaurant = ?
        GROUP BY DishId
      ');
      $stmt->execute(array($id));
  
      $dishes = array();
  
      while ($dish = $stmt->fetch()) {
        $dishes[] = new Dish(
          $dish['DishId'], 
          $dish['Name'],
          $dish['Description'],
          $dish['Price'],
          $dish['Category'],
          $dish['Picture'],
          $dish['Promotion'],
          $id,
        );
      }
  
      return $dishes;
    }

  }



?>