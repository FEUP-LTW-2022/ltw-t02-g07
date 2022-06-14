<?php declare(strict_types = 1); 

  require_once('database/favorite.class.php')
?>


<!-- Draws the Favorite that is required -->


<?php function drawFavorite(array $dishes, array $restaurants) { ?>
  <h2>Favorites</h2>
  <section id="restaurants">
    <div class="part">
      <h3>Restaurants</h3>
      <?php foreach ($restaurants as $restaurant) { ?>
      <article class="optionBox">
        <img src="../resources/restaurants/<?=$restaurant->picture?>" class="boxImage">
        <div class="boxDesc">
          <a id="RestaurantName" href="restaurant.php?id=<?=$restaurant->id?>"><?=$restaurant->name?></a>
          <p class="info">Category: <?=$restaurant->category?></p>
          <p class="info">Address: <?=$restaurant->address?></p>
        </div>
      </article>
      <?php } ?>
      <div class="fix"></div>
    </div>
  </section>

  <section id="dishes">
    <div class="part">
      <h3>Dishes</h3>
      <?php foreach ($dishes as $dish) { ?>
      <article class="optionBox">
        <img src="../resources/dishes/<?=$dish->picture?>" class="boxImage">
        <div class="boxDesc">
          <p><?=$dish->name?></p>
          <p class="info"><?=$dish->description?></p>
          <p class="info">€<?=$dish->price?></p>
          <a href="restaurant.php?id=<?=$restaurant->id?>">To restaurant</a>
        </div>
      </article>
      <?php } ?>
      <div class="fix"></div>
    </div>
  </section>


<?php } ?>