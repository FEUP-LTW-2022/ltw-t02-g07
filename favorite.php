<?php
  declare(strict_types = 1);
  session_start();
  require_once('database/connection.db.php');
  require_once('database/favorite.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/favorite.tpl.php');

  $db = getDatabaseConnection();

  $favoriteRestaurants = Favorite::getFavoriteRestaurants($db, 1);
  $favoriteDishes = Favorite::getFavoriteDishes($db, intval(1));

  drawHeader();
  drawFavorite($favoriteDishes, $favoriteRestaurants);
  drawFooter();
?>
