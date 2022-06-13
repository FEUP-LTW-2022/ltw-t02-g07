<?php declare(strict_types = 1); 

  require_once('database/restaurant.class.php')
?>

<!-- Draws all the restaurants -->

<?php function drawRestaurants(array $restaurants) { ?>
  <section id="restaurants">
    <div id="part">
      <h2>Restaurants</h2>
      <div id="searchDiv">
        <input id="searchInput" type="text" placeholder="Name..." class="form-control">
      </div>
      <div>
      <?php foreach($restaurants as $restaurant) { ?> 
        <article id="optionBox" class="filterable">
          <img src="../resources/restaurants/<?=$restaurant->picture?>" id="boxImage">
          <div id="boxDesc">
            <a id="RestaurantName" href="restaurant.php?id=<?=$restaurant->id?>"><?=$restaurant->name?></a>
            <p>Category:<?=$restaurant->category?><p>
            <p>Rating: <?php 
              require_once('database/connection.db.php');
              require_once('database/restaurant.db.php');
              $db = getDatabaseConnection();
              $rating = getRestaurantScore($db,$restaurant->id);
              if($rating == null){
                echo '-';
              }else{
                echo $rating;
                echo '★';
              }
              ?>
            <p>
          </div>
        </article>
      <?php } ?>
      </div>
      <div id="fix"></div>
    </div>
  </section>
  <script>
      $(document).ready(function(){
       $("#searchInput").on("keyup",function(){
        var value = $(this).val().toLowerCase();
        $(".filterable").filter(function(){
          console.log($(this).children("#boxDesc").text());
          $(this).toggle($(this).children("#boxDesc").children("#RestaurantName").text().toLowerCase().indexOf(value) > -1);
        });
      });
    });
  </script>
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

<?php function drawSearch() { ?>
  <input id="searchInput" type="text" placeholder="Search..." class="form-control">
<?php } ?>