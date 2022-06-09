<?php declare(strict_types = 1); ?>


<!-- Draws the fravorites that are required -->


<?php function drawFavorite(string $idUser, array $dishes) { ?>
  <h2>Favorites</h2>
  <section id="dishes">
    <?php foreach ($dishes as $dish) { ?>
    <article>
      <a href="dish.php?id=1"><?=$dish['name']?></a>
    </article>
    <?php } ?>
  </section>
<?php } ?>