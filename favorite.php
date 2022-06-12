<?php
  declare(strict_types = 1);

  require_once('database/connection.db.php');
  require_once('database/user.db.php');

  require_once('templates/common.tpl.php');
  require_once('templates/user.tpl.php');

  $db = getDatabaseConnection();

  $favorite = getUserFavorites($db, intval($_GET['id']));

  drawHeader();
  drawFavorite($favorite);
  drawFooter();
?>