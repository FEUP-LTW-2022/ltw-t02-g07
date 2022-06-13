<?php
  declare(strict_types = 1);
  require_once('database/connection.db.php');
  require_once('database/order.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/order.tpl.php');

  $db = getDatabaseConnection();

  $orders = Order::getOrders($db, 1);

  drawHeader();
  drawOrders($orders);
  drawFooter();
?>
