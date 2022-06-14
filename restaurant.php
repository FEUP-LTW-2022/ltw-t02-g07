<?php
  declare(strict_types = 1);
  session_start();
  require_once(__DIR__ . '/database/connection.db.php');
  require_once(__DIR__ . '/database/restaurant.class.php');
  require_once(__DIR__ . '/database/dish.class.php');
  require_once(__DIR__ . '/database/review.class.php');

  require_once(__DIR__ . '/templates/common.tpl.php');
  require_once(__DIR__ . '/templates/restaurant.tpl.php');

  $db = getDatabaseConnection();


  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));
  $dishes = Dish::getRestaurantDishes($db, intval($_GET['id']));
  $reviews = Review::getRestaurantReviews($db, intval($_GET['id']));
  $score = Review::getRestaurantScore($db, intval($_GET['id']));


  drawHeader();
  drawRestaurant($restaurant, $dishes, $reviews, strval($score));
  drawFooter();
?>