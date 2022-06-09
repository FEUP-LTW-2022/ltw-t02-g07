<?php declare(strict_types = 1); ?>


<!-- Draws the order that is required -->


<?php function drawOrder(string $idOrder, array $dishes) { ?>
  <h2>Order <?=$idOrder?></h2>
  <section id="dishes">
    <?php foreach ($dishes as $dish) { ?>
    <article>
      <a href="dish.php?id=1"><?=$dish['name']?></a>
    </article>
    <?php } ?>
  </section>
<?php } ?>