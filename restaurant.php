<?php
  declare(strict_types = 1);

  require_once('database/connection.db.php');
  require_once('database/restaurant.db.php');

  require_once('templates/common.tpl.php');
  require_once('templates/restaurant.tpl.php');

  $db = getDatabaseConnection();

  $restaurant = getRestaurant($db, intval($_GET['id']));

  drawHeader();
  drawRestaurant($restaurant['name'], $restaurant['dishes']);
  drawFooter();
?>