<?php
  declare(strict_types = 1);

  function getDish(PDO $db, int $id) : array {
    $stmt = $db->prepare('SELECT DishId, Name, Description, Price, Category, Picture, Promotion FROM Dish WHERE DishId = ?');
    $stmt->execute(array($id));

    $dish = $stmt->fetch();

    return array(
        'id' => $dish['DishId'],
        'name' => $dish['Name'],
        'description' => $dish['Description'],
        'price' => $dish['Price'],
        'category' => $dish['Category'],
        'picture' => $dish['Picture'],
        'promotion' => $dish['Promotion'],
    );
  }

?>