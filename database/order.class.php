<?php
  declare(strict_types = 1);
  require_once('database/dish.class.php');


  class Order{

    public int $id;
    public int $id_user;
    public int $id_driver;
    public int $id_restaurant;
    public string $status;

    public function __construct(int $id, int $id_user, int $id_driver, int $id_restaurant, string $status){

        $this->id = $id;
        $this->id_user = $id_user;
        $this->id_driver = $id_driver;
        $this->id_restaurant = $id_restaurant;
        $this->status = $status;


    }

    static function getOrderDishes(PDO $db, int $id) : array {
      $stmt = $db->prepare('
      SELECT Name, Description, Price, Category, Picture, Promotion, Id_restaurant
      FROM Order_list JOIN Dish 
      ON Id_dish = DishId
      WHERE Id_order = ?
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

    static function getOrders(PDO $db, int $id) : array {
      $stmt = $db->prepare('
      SELECT OrderId, Id_user, Id_driver, Id_restaurant, State_order
      FROM Order_row
      WHERE Id_user = ?
      ');
      $stmt->execute(array($id));
  
      $orders = array();
  
      while ($order = $stmt->fetch()) {
        $orders[] = new Order(
          intval($order['OrderId']), 
          intval($order['Id_user']),
          intval($order['Id_driver']),
          intval($order['Id_restaurant']),
          $order['State_order']

        );
      }
  
      return $orders;
    }
  }


?>