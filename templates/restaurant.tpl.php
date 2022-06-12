<?php declare(strict_types = 1); 

  require_once('database/restaurant.class.php')
?>

<!-- Draws all the restaurants -->

<?php function drawRestaurants(array $restaurants) { ?>
  <section id="restaurants">
    <div id="part">
      <h2>Restaurants</h2>
      <?php foreach($restaurants as $restaurant) { ?> 
        <article id="optionBox">
          <img src="../resources/restaurants/<?=$restaurant->picture?>" id="boxImage">
          <div id="boxDesc">
            <a href="restaurant.php?id=<?=$restaurant->id?>"><?=$restaurant->name?></a>
            <p class="info">Address: <?=$restaurant->address?><p>
          </div>
        </article>
      <?php } ?>
      <div id="fix"></div>
    </div>
  </section>
<?php } ?>

<!-- Draws the restaurant that is required -->


<?php function drawRestaurant(Restaurant $restaurant, array $dishes, array $reviews, string $score) { ?>
  <section id="dishes">
    <div id="part">
      <h2><?=$restaurant->name?> <?=$score?>★</h2>
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

  <section id="reviews">
    <div id="part">
      <?php foreach ($reviews as $review) { ?>
        <img src="../resources/reviews/<?=$review->picture?>">
        <div>
          <p class="info"><?=$review->description?></p>
          <p class="info"><?=$review->score?>★</p>
        </div>
      <?php } ?>
      <div id="fix"></div>
    </div>
  </section>


<?php } ?>