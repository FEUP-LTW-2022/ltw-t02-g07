<?php declare(strict_types = 1); ?>

<!-- Draws all the restaurants -->

<?php function drawRestaurants(array $restaurants) { ?>
  <h2>Restaurants</h2>
  <section id="restaurants">
    <?php foreach($restaurants as $restaurant) { ?> 
      <article>
        <img src="../resources/restaurants/<?=$restaurant['picture']?>">
        <a href="restaurant.php?id=<?=$restaurant['id']?>"><?=$restaurant['name']?></a>
        <p class="info"><?=$restaurant['score']?>★<p>
        <p class="info">Address: <?=$restaurant['address']?><p>
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
      <img src="../resources/dishes/<?=$dish['picture']?>">
      <a href="dish.php?id=<?=$dish['id']?>"><?=$dish['name']?></a>
      <p class="info"><?=$dish['description']?></p>
      <p class="info">€<?=$dish['price']?></p>
    </article>
    <?php } ?>
  </section>
<?php } ?>