<?php declare(strict_types = 1); 

require_once('database/order.class.php')
?>


<!-- Draws the order that is required -->


<?php function drawOrders(array $orders) { ?>
  <h2>Orders</h2>
  <section id="orders">
    <?php foreach ($orders as $order) { ?>
    <article>
      <p>Number: <a href="orderDetail.php?id=<?=$order->id?>"><?=$order->id?></a></p>
      <p class="info">Status: <?=$order->status?></p> 
    </article>
    <?php } ?>
  </section>
<?php } ?>



<?php function drawOrder(array $dishes, int $id) { ?>
  <h2>Order <?=$id?></h2>
  <section id="dishes">
    <?php foreach ($dishes as $dish) { ?>
    <article>
      <p class="info"><?=$dish->name?></p> 
      <p class="info">€<?=$dish->price?></p> 
    </article>
    <?php } ?>
  </section>
<?php } ?>

