<?php
  declare(strict_types = 1);
  require_once(__DIR__ . '/database/connection.db.php');
  require_once('database/order.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/order.tpl.php');

  session_start();


  $db = getDatabaseConnection();

  $orders = Order::getOrders($db, intval($_SESSION['id']));

  drawHeader();
  drawOrders($orders);
  drawFooter();
?>
