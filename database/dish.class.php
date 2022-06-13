<?php
  declare(strict_types = 1);
  require_once('database/dish.class.php');
  class Dish{

    public int $id;
    public string $name;
    public string $description;
    public float $price;
    public string $category;
    public string $picture;
    public float $promotion;
    public int $restaurantId;

    public function __construct(int $id, string $name, string $description, float $price, string $category, string $picture, float $promotion, int $restaurantId){

      $this-> id = $id;
      $this-> name = $name;
      $this-> description = $description;
      $this-> price = $price;
      $this-> category = $category;
      $this-> picture = $picture;
      $this-> promotion = $promotion;
      $this-> restaurantId = $restaurantId;

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
          intval($dish['DishId']), 
          $dish['Name'],
          $dish['Description'],
          floatval($dish['Price']),
          $dish['Category'],
          $dish['Picture'],
          intval($dish['Promotion']),
          $id,
        );
      }
  
      return $dishes;
    }

    static function getDish(PDO $db, int $id) : Dish {
      $stmt = $db->prepare('SELECT DishId, Name, Description, Price, Category, Picture, Promotion, Id_restaurant FROM Dish WHERE DishId = ?');
      $stmt->execute(array($id));
  
      $dish = $stmt->fetch();
  
      return new Dish(
          intval($dish['DishId']),
          $dish['Name'],
          $dish['Description'],
          floatval($dish['Price']),
          $dish['Category'],
          $dish['Picture'],
          floatval($dish['Promotion']),
          intval($dish['Id_restaurant'])
      );
    }

    function addDish(PDO $db,int $restaurantId){
      $stmt = $db->prepare('INSERT INTO Dish (Name,Description,Price,Category,Picture,Promotion,Id_restaurant) VALUES (?,?,?,?,?,?,?)');
      $stmt->execute(array($this->name,$this->description,$this->price,$this->category,$this->picture,$this->promotion,$restaurantId));
      return $db->lastInsertId();
    }

  }


?>