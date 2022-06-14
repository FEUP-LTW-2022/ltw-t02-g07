<?php
  declare(strict_types = 1);
  require_once('database/dish.class.php');
  require_once('database/restaurant.class.php');


  class Favorite{

    public function __construct(){

    }

    static function getFavoriteDishes(PDO $db, int $id) : array {
      $stmt = $db->prepare('
      SELECT DishId, Name, Description, Price, Category, Picture, Promotion, Id_restaurant
      FROM FavoriteDish JOIN Dish 
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
          intval($dish['Promotion']),
          intval($dish['Id_restaurant'])

        );
      }
  
      return $dishes;
    }

    static function getFavoriteRestaurants(PDO $db, int $id) : array {
      $stmt = $db->prepare('
      SELECT RestaurantId, Name, Address, Picture, Category, Id_owner
      FROM FavoriteRestaurant JOIN Restaurant
      ON Id_restaurant = RestaurantId
      WHERE Id_user = ?
      ');
      $stmt->execute(array($id));
  
      $restaurants = array();
  
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          intval($restaurant['RestaurantId']), 
          $restaurant['Name'],
          $restaurant['Address'],
          $restaurant['Picture'],
          $restaurant['Category'],
          intval($restaurant['Id_owner'])

        );
      }
  
      return $restaurants;
    }
    static function addFavoriteRestaurant(PDO $db, int $id, int $id_restaurant){
      $stmt = $db->prepare('
          INSERT INTO FavoriteRestaurant (Id_user,Id_restaurant) VALUES (?,?)
      ');
      $stmt->execute(array($id,$id_restaurant));
  }
  static function deleteFavoriteRestaurant($db, int $id, int $id_restaurant){
    $stmt = $db->prepare('
        DELETE FROM FavoriteRestaurant
        WHERE Id_user = ? AND Id_restaurant = ?
    ');
    $stmt->execute(array($id,$id_restaurant));
}
  static function addFavoriteDish(PDO $db, int $id, int $id_dish){
    $stmt = $db->prepare('
        INSERT INTO FavoriteDish (Id_user,Id_dish) VALUES (?,?)
    ');
    $stmt->execute(array($id,$id_dish));
}

  }
?>