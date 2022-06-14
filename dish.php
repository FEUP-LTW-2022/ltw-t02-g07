<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/database/connection.db.php');
  require_once('database/dish.db.php');

  require_once('templates/common.tpl.php');
  require_once('templates/dish.tpl.php');

  $db = getDatabaseConnection();

  $dish = getDish($db, intval($_GET['id']));

  drawHeader();
  drawDish($dish);
  drawFooter();
?>