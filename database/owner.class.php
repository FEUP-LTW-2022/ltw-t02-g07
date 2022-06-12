<?php
  declare(strict_types = 1);

  class Owner{
      public int $id;

      public function __construct(int $id){
          $this->$id = $id;
      }

      static function getOwner(PDO $db, int $id) : ?Owner {
        $stmt = $db->prepare('
          SELECT OwnerId
          FROM Owner
          WHERE UserId = ?
        ');
        $stmt->execute(array($id));
        if($User = $stmt->fetch()){
          return new Owner(
              $User['OwnerId'],
          );
          } else {
              return null;
          }
      }

      static function getOwnerRestaurants(PDO $db, int $id){
        $stmt = $db->prepare('SELECT RestaurantId, Name, Picture, Address, Category FROM Restaurant WHERE Id_owner = ?');
        $stmt->execute(array($id));
    
        $restaurants = array();
        while ($restaurant = $stmt->fetch()) {
          $restaurants[] = array(
            'id' => $restaurant['RestaurantId'],
            'name' => $restaurant['Name'],
            'picture' => $restaurant['Picture'],
            'address' => $restaurant['Address'],
            'category' => $restaurant['Category'],
          );
        }
    
        return $restaurants;
      }

      static function addOwner(PDO $db, int $id){
        $stmt = $db->prepare('
            INSERT INTO Owner (OwnerId) VALUES (?)
        ');
        $stmt->execute(array($id));
    }
  }

?>