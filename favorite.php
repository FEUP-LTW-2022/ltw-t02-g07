<?php
  declare(strict_types = 1);

  require_once('database/connection.db.php');
  require_once('database/favorite.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/favorite.tpl.php');

  $db = getDatabaseConnection();

  $favorite = Favorite::getFavoriteDishes($db, intval(($_SESSION['id'])));

  drawHeader();
  drawFavorite($favorite);
  drawFooter();
?>
