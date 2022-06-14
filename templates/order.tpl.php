<?php declare(strict_types = 1); 

require_once('database/order.class.php')
?>


<!-- Draws the order that is required -->


<?php function drawOrders(array $orders) { ?>
  <h2>Orders</h2>
  <section id="orders">
    <?php foreach ($orders as $order) { ?>
    <article>
      <p>Number: <a href="orderDetail.php?id=<?=$order->id?>&status=<?=$order->status?>"><?=$order->id?></a></p>
      <p class="info">Status: <?=$order->status?></p> 
    </article>
    <?php } ?>
  </section>
<?php } ?>



<?php function drawOrder(array $dishes, int $id, string $status) { ?>
  <h2>Order <?=$id?></h2>
  <h1>Status: <?=$status?></h1>
  <section id="dishes">
    <?php foreach ($dishes as $dish) { ?>
    <article>
      <p class="info"><?=$dish->name?></p> 
      <p class="info">€<?=$dish->price?></p> 
    </article>
    <?php } ?>
  </section>
    <div>
      <form action="actions/action_add_review.php" method="post" id="reviewInput">
      <input name = "restaurantId" id="restaurantId" type="hidden" value="<?$dishes[0]->restaurantId?>">
      <input name = "csrf" id="csrf" type = "hidden" value = "<?=$_SESSION['csrf']?>">
      <label for="score">Score:</label>
      <input class="reviewInput" type="range" id="score" name="score" oninput = "showScore(this.value)" onchange="showScore(this.value)"
         min="0" max="5" value="2.5" step="0.1">
      <label id="scoreValue" for="score">2.5★</label>
      <p><label for="reviewText">Review:</label></p>
        <textarea  form="reviewInput" class="reviewInput" id="reviewText" name="reviewText" rows="4" cols="50" maxlength="99"></textarea>
      <input class="reviewInput" type="submit">
    </form>
    </div>

    <script>
      function showScore(value){
        document.getElementById("scoreValue").innerHTML = value + "★";
      }
      </script>
<?php } ?>

