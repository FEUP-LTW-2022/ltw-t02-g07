<?php declare(strict_types = 1); ?>

<!-- Draws all the restaurants -->

<?php function drawRestaurants(array $restaurants) { ?>
  <section id="restaurants">
    <div id="part">
      <h2>Restaurants</h2>
      <?php foreach($restaurants as $restaurant) { ?> 
        <article id="optionBox">
          <img src="../resources/restaurants/<?=$restaurant['picture']?>" id="boxImage">
          <div id="boxDesc">
            <a href="restaurant.php?id=<?=$restaurant['id']?>"><?=$restaurant['name']?></a>
            <p class="info"><?=$restaurant['score']?>★<p>
            <p class="info">Address: <?=$restaurant['address']?><p>
          </div>
        </article>
      <?php } ?>
      <div id="fix"></div>
    </div>
  </section>
<?php } ?>

<!-- Draws the restaurant that is required -->


<?php function drawRestaurant(string $restaurantName, array $dishes) { ?>
  <section id="dishes">
    <div id="part">
      <h2><?=$restaurantName?></h2>
      <?php foreach ($dishes as $dish) { ?>
      <article id="optionBox">
        <img src="../resources/dishes/<?=$dish['picture']?>" id="boxImage">
        <div id="boxDesc">
          <a href="dish.php?id=<?=$dish['id']?>"><?=$dish['name']?></a>
          <p class="info"><?=$dish['description']?></p>
          <p class="info">€<?=$dish['price']?></p>
        </div>
      </article>
      <?php } ?>
      <div id="fix"></div>
    </div>
  </section>
<?php } ?>