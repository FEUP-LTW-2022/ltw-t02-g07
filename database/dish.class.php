<?php
  declare(strict_types = 1);

  class Dish{

    public int $id;
    public string $name;
    public string $description;
    public float $price;
    public string $category;
    public string $picture;
    public int $promotion;

    public function __construct(int $id, string $name, string $description, float $price, string $category, string $picture, int $promotion){

      $this-> id = $id;
      $this-> name = $name;
      $this-> description = $description;
      $this-> price = $price;
      $this-> category = $category;
      $this-> picture = $picture;
      $this-> promotion = $promotion;

    }

    public function getRestaurantDishes(PDO $db, int $id) : array {
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
          intval($dish['DishId']), 
          $dish['Name'],
          $dish['Description'],
          floatval($dish['Price']),
          $dish['Category'],
          $dish['Picture'],
          intval($dish['Promotion'])
        );
      }
  
      return $dishes;
    }

    static function getDish(PDO $db, int $id) : Dish {
      $stmt = $db->prepare('SELECT DishId, Name, Description, Price, Category, Picture, Promotion FROM Dish WHERE DishId = ?');
      $stmt->execute(array($id));
  
      $dish = $stmt->fetch();
  
      return new Dish(
          intval($dish['DishId']),
          $dish['Name'],
          $dish['Description'],
          floatval($dish['Price']),
          $dish['Category'],
          $dish['Picture'],
          intval($dish['Promotion'])
      );
    }

  }


?>