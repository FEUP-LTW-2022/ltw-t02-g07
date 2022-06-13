<?php declare(strict_types = 1); 

  require_once('database/favorite.class.php')
?>


<!-- Draws the Favorite that is required -->


<?php function drawFavorite(array $dishes) { ?>
  <section id="dishes">
    <div id="part">
      <h2>Favorites</h2>
      <?php foreach ($dishes as $dish) { ?>
      <article id="optionBox">
        <img src="../resources/dishes/<?=$dish->picture?>" id="boxImage">
        <div id="boxDesc">
          <p><?=$dish->name?></p>
          <p class="info"><?=$dish->description?>Hi</p>
          <p class="info">€<?=$dish->price?></p>
        </div>
      </article>
      <?php } ?>
      <div id="fix"></div>
    </div>
  </section>


<?php } ?>