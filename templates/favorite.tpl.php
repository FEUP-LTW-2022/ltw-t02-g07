<?php declare(strict_types = 1); 

  require_once('database/favorite.class.php')
?>


<!-- Draws the Favorite that is required -->


<?php function drawFavorite(array $dishes, array $restaurants) { ?>
  <h2>Favorites</h2>
  <section id="restaurants">
    <div id="part">
      <h3>Restaurants</h3>
      <?php foreach ($restaurants as $restaurant) { ?>
      <article id="optionBox">
        <img src="../resources/restaurants/<?=$restaurant->picture?>" id="boxImage">
        <div id="boxDesc">
          <p><?=$restaurant->name?></p>
          <p class="info">Category: <?=$restaurant->category?></p>
          <p class="info">Address: <?=$restaurant->address?></p>
        </div>
      </article>
      <?php } ?>
      <div id="fix"></div>
    </div>
  </section>

  <section id="dishes">
    <div id="part">
      <h3>Dishes</h3>
      <?php foreach ($dishes as $dish) { ?>
      <article id="optionBox">
        <img src="../resources/dishes/<?=$dish->picture?>" id="boxImage">
        <div id="boxDesc">
          <p><?=$dish->name?></p>
          <p class="info"><?=$dish->description?></p>
          <p class="info">€<?=$dish->price?></p>
        </div>
      </article>
      <?php } ?>
      <div id="fix"></div>
    </div>
  </section>


<?php } ?>