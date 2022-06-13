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


    static function addRestaurant(PDO $db, string $name, string $picture, string $address, string $category, int $ownerId){
      $stmt = $db->prepare('
          INSERT INTO Restaurant (Name, Picture, Address, Category, Id_owner) VALUES (?,?,?,?,?)
      ');
      $stmt->execute(array($name,$picture,$address,$category,$ownerId));
      return true;

  }

}

?>