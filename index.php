<?php

  declare(strict_types = 1);
  session_start();
  if(!isset($_SESSION['csrf'])){
    $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
  }

  require_once(__DIR__ . '/database/connection.db.php');
  require_once(__DIR__ . '/database/restaurant.class.php');

  require_once(__DIR__ . '/templates/common.tpl.php');
  require_once(__DIR__ . '/templates/restaurant.tpl.php');

  $db = getDatabaseConnection();

  $restaurants = Restaurant::getRestaurants($db, 20);

  drawHeader();
  drawRestaurants($restaurants);
  drawFooter();
?>