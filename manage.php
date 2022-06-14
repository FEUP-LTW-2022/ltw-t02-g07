<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['isOwner'])) die(header('Location: /'));

  require_once(__DIR__ . '/database/connection.db.php');
  require_once(__DIR__ . '/database/owner.class.php');

  require_once(__DIR__ . '/templates/common.tpl.php');
  require_once(__DIR__ . '/templates/owner.tpl.php');

  $db = getDatabaseConnection();


  drawHeader();
  if(isset($_SESSION['isOwner'])){
    drawOwnerStatistics(Owner::getOwnerRestaurants($db,$_SESSION['id']));
  }
  drawFooter();
?>