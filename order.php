<?php
  declare(strict_types = 1);
  session_start();
  if (!isset($_SESSION['id'])) die(header('Location: /'));
  require_once(__DIR__ . '/database/connection.db.php');
  require_once('database/order.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/order.tpl.php');

  $db = getDatabaseConnection();

  $orders = Order::getOrders($db, intval($_SESSION['id']));

  drawHeader();
  drawOrders($orders);
  drawFooter();
?>
