<?php declare(strict_types = 1); 

  require_once('database/restaurant.class.php');
  require_once('database/connection.db.php');

?>

<!-- Draws all the restaurants -->

<?php function drawRestaurants(array $restaurants) { ?>
  <section id="restaurants">
    <div id="part">
      <h2>Restaurants</h2>
      <div id="searchDiv">
        <input id="searchInput" type="search" placeholder="Name..." class="form-control">
        <select name="orders" id="orderInput" onchange="stateChange()">
          <option value="" selected disabled hidden>Score</option>
          <option value="ascending">Low to High</option>
          <option value="descending">High to Low</option>
        </select>
      </div>
      <div id = "restaurantContainer">
      <?php foreach($restaurants as $restaurant) { ?> 
        <article id="optionBox" class="filterable" data-id=<?=$restaurant->id?>>
          <img src="../resources/restaurants/<?=$restaurant->picture?>" id="boxImage">
          <div id="boxDesc">
            <a id="RestaurantName" href="restaurant.php?id=<?=$restaurant->id?>"><?=$restaurant->name?></a>
            <p>Category: <?=$restaurant->category?><p>
            <p id="Score">Rating: <?php 
              $db = getDatabaseConnection();
              $rating = Restaurant::getRestaurantScore($db,$restaurant->id);
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
      //search by name filter
      $(document).ready(function(){
       $("#searchInput").on("keyup",function(){
        var value = $(this).val().toLowerCase();
        $(".filterable").filter(function(){
          console.log($(this).children("#boxDesc").text());
          $(this).toggle($(this).children("#boxDesc").children("#RestaurantName").text().toLowerCase().indexOf(value) > -1);
        });
      });
    });

    function stateChange(){
            var select = document.getElementById("orderInput");
            var sorted_divs = getSorted('.filterable',select.value).clone();
        
            $("#restaurantContainer").html(sorted_divs);



          }
      function getSorted(selector, orientation) {
        return $($(selector).toArray().sort(function(a, b){
          var aVal = parseFloat($(a).children("#boxDesc").children("#Score").text().split(":")[1]),
          bVal = parseFloat($(b).children("#boxDesc").children("#Score").text().split(":")[1]);
          if(orientation === "ascending"){
            console.log("tusom");
            return aVal - bVal;
          }else{
            console.log("somtu");
            return bVal - aVal;
          }
    }));
}
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