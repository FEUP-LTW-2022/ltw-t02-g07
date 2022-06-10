<?php declare(strict_types = 1); ?>

<!-- Draws all the restaurants -->

<?php function drawRestaurants(array $restaurants) { ?>
  <h2>Restaurants</h2>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?> 
      <article>
        <img src="../resources/restaurants/<?=$restaurant['picture']?>">
        <a href="restaurant.php?id=1"><?=$restaurant['name']?></a>
      </article>
    <?php } ?>
  </section>
<?php } ?>

<!-- Draws the restaurant that is required -->


<?php function drawRestaurant(string $restaurantName, array $dishes) { ?>
  <h2><?=$restaurantName?></h2>
  <section id="dishes">
    <?php foreach ($dishes as $dish) { ?>
    <article>
      <a href="dish.php?id=1"><?=$dish['name']?></a>
      <p class="info"><?=$dish['price']?></p>
    </article>
    <?php } ?>
  </section>
<?php } ?>