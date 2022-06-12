<?php declare(strict_types = 1); ?>


<!-- Draws the dish that is required -->

<?php function drawDish(array $dishes) { ?>
  <h2><?=$dishes['name']?></h2>
  <section id="dish">
    <article>
      <img src="../resources/dishes/<?=$dishes['picture']?>">
      <p class="info"><?=$dishes['description']?></p>
      <p class="info">€<?=$dishes['price']?></p>
    </article>
  </section>
<?php } ?>