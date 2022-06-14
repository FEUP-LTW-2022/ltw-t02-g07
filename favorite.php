<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/database/connection.db.php');
  require_once('database/favorite.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/favorite.tpl.php');
  session_start();
  if (!isset($_SESSION['id'])) die(header('Location: /'));


  $db = getDatabaseConnection();

  $favoriteRestaurants = Favorite::getFavoriteRestaurants($db, intval($_SESSION['id']));
  $favoriteDishes = Favorite::getFavoriteDishes($db, intval($_SESSION['id']));

  drawHeader();
  drawFavorite($favoriteDishes, $favoriteRestaurants);
  drawFooter();
?>
