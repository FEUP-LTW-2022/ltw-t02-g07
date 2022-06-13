<?php
  declare(strict_types = 1);
  require_once('database/dish.class.php');

  class Favorite{

    public function __construct(){

    }

    static function getFavoriteDishes(PDO $db, int $id) : array {
      $stmt = $db->prepare('
      SELECT Name, Description, Price, Category, Picture, Promotion
      FROM Favorite JOIN Dish 
      ON Id_dish = DishId
      WHERE Id_user = ?
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
  }


?>