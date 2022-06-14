<?php
  declare(strict_types = 1);
  session_start();
  if (!isset($_SESSION['id'])) die(header('Location: /'));
  require_once(__DIR__ . '/database/connection.db.php');
  require_once('database/order.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/order.tpl.php');
  
  $db = getDatabaseConnection();

  $dishes = Order::getOrderDishes($db, intval($_GET['id']));

  drawHeader();
  drawOrder($dishes, intval($_GET['id']), $_GET['status']);
  drawFooter();
?>