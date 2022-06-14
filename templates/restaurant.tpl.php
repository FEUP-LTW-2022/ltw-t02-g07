<?php declare(strict_types = 1); 

  require_once('database/restaurant.class.php');
  require_once('database/connection.db.php');

?>

<!-- Draws all the restaurants -->

<?php function drawRestaurants(array $restaurants) { ?>
  
  <div id="searchDiv">
    <input id="searchInput" type="search" placeholder="Search..." class="form-control">
    <select name="orders" id="orderInput" onchange="stateChange()" class="drop">
      <option value="" selected disabled hidden>Score</option>
      <option value="ascending">Low to High</option>
      <option value="descending">High to Low</option>
    </select>
  </div>

  <h2>Restaurants</h2>
  <section id="restaurants">
    <div class="part">
      <div id="restaurantContainer">
      <?php foreach($restaurants as $restaurant) { ?> 
        <article id="optionBox" class="filterable optionBox" data-id=<?=$restaurant->id?>>
          <img src="../resources/restaurants/<?=$restaurant->picture?>" id="boxImage" class="boxImage">
          <div id="boxDesc" class="boxDesc">
            <div class="row">
              <div class="columnName">
                <a id="RestaurantName" href="restaurant.php?id=<?=$restaurant->id?>"><?=$restaurant->name?></a>
              </div>
              <div class="columnHeart">
                <div id="heart">
                  <i class="fa-2xl"></i>
                </div>
              </div>
            </div>
            <p id="Category"> Category: <?=$restaurant->category?><p>
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
      <div class="fix"></div>
    </div>
  </section>
  <script>

    $(function(){
      $.post("handlers/getFavoriteRestaurants.php",
                  function (data) {
                    
                    $("i").closest("#optionBox").each(function(){
                          if(data.includes(this.dataset.id)){
                            $(this).find("i").addClass("press");
                          }
                          
                      });
                    });
                  });


    function addclick(){
      $(function() {
          $( "i" ).click(function() {
            $(this).toggleClass( "press", 1000 );
            if($(this).hasClass("press")){
              $.post("handlers/addFavoriteRestaurant.php",
                      {restaurantId:$(this).closest("#optionBox")[0].dataset.id},
                      function(data){
                        console.log("Favorite restaurant added");
                      });
              }else{
                $.post("handlers/deleteFavoriteRestaurant.php",
                      {restaurantId:$(this).closest("#optionBox")[0].dataset.id},
                      function(data){
                        console.log("Favorite restaurant delete");
                      });
              }
          });
        });
    }
    addclick();

      //search by name filter
      $(document).ready(function(){
       $("#searchInput").on("keyup",function(){
        var value = $(this).val().toLowerCase();
        $(".filterable").filter(function(){
          var nameSearch = $(this).children("#boxDesc").find("#RestaurantName").text().toLowerCase().indexOf(value) > -1;
          var categorySearch = $(this).children("#boxDesc").find("#Category").text().toLowerCase().indexOf(value) > -1;
          $(this).toggle(nameSearch || categorySearch);
        });
      });
    });

    function stateChange(){
            var select = document.getElementById("orderInput");
            var sorted_divs = getSorted('.filterable',select.value).clone();
            $("#restaurantContainer").html(sorted_divs);
            addclick();



          }
      function getSorted(selector, orientation) {
        return $($(selector).toArray().sort(function(a, b){
          var aVal = parseFloat($(a).children("#boxDesc").find("#Score").text().split(":")[1]),
          bVal = parseFloat($(b).children("#boxDesc").find("#Score").text().split(":")[1]);
          if(orientation === "ascending"){
            return aVal - bVal;
          }else{
            return bVal - aVal;
          }
    }));
}
  </script>
<?php } ?>

<!-- Draws the restaurant that is required -->


<?php function drawRestaurant(Restaurant $restaurant, array $dishes, array $reviews, string $score) { ?>
  <section id="dishes">
    <div class="part">
      <h2><?=$restaurant->name?> <?=$score?>★</h2>
      <div id="searchDiv">
    <input id="searchInput" type="search" placeholder="Search..." class="form-control">
      <select name="orders" id="orderInput" onchange="stateChange()" class="drop">
        <option value="" selected disabled hidden>Price</option>
        <option value="ascending">Low to High</option>
        <option value="descending">High to Low</option>
      </select>
    </div>
    <div id="dishContainer">
      <?php foreach ($dishes as $dish) { ?>
      <article class="optionBox filterable" data-id=<?=$dish->id?>>
        <img src="../resources/dishes/<?=$dish->picture?>" class="boxImage">
        <div class="boxDesc">
          <div class="row">
            <div class="columnName">
              <p id="nameInfo"><?=$dish->name?></p>
            </div>
            <div class="columnHeart">
              <div id="heart">
                <i class="fa-2xl"></i>
              </div>
            </div>
          </div>
          <p id="descInfo" class="info"><?=$dish->description?></p>
          <p id="priceInfo" class="info">€<?=$dish->price?></p>
        </div>
      </article>
      <?php } ?>
      </div>
      <div class="fix"></div>
    </div>
  </section>

  <section id="reviews">
    <h2>Reviews</h2>
    <div class="reviewBox">
    <?php foreach ($reviews as $review) { ?>
      <img src="../resources/reviews/<?=$review->picture?>" class="boxImage sharp">
      <div class="revDesc">
        <p class="info"><?=$review->description?></p>
        <p class="info"><?=$review->score?>★</p>
      </div>
    <?php } ?>
    </div>
    <div class="fix"></div>
  </section>
  <script>
      $(document).ready(function(){
       $("#searchInput").on("keyup",function(){
        var value = $(this).val().toLowerCase();
        $(".filterable").filter(function(){
          var nameSearch = $(this).find("#nameInfo").text().toLowerCase().indexOf(value) > -1;
          $(this).toggle(nameSearch);
        });
      });
    });
    $(function(){
      $.post("handlers/getFavoriteDishes.php",
                  function (data) {
                    $("i").closest(".optionBox").each(function(){
                          if(data.includes(this.dataset.id)){
                            $(this).find("i").addClass("press");
                          }
                          
                      });
                    });
                  });


    function addclick(){
      $(function() {
          $( "i" ).click(function() {
            $(this).toggleClass( "press", 1000 );
            if($(this).hasClass("press")){
              console.log($(this).closest(".optionBox"));
              $.post("handlers/addFavoriteDish.php",
                      {dishId:$(this).closest(".optionBox")[0].dataset.id},
                      function(data){
                        console.log("Favorite dish added");
                      });
              }else{
                $.post("handlers/deleteFavoriteDish.php",
                      {dishId:$(this).closest(".optionBox")[0].dataset.id},
                      function(data){
                        console.log("Favorite dish deleted");
                      });
              }
          });
        });
    }
    addclick();

    function stateChange(){
            var select = document.getElementById("orderInput");
            var sorted_divs = getSorted('.filterable',select.value).clone();
            $("#dishContainer").html(sorted_divs);
            addclick();



          }
      function getSorted(selector, orientation) {
        return $($(selector).toArray().sort(function(a, b){
          var aVal = parseFloat($(a).find("#priceInfo").text().substring(1)),
          bVal = parseFloat($(b).find("#priceInfo").text().substring(1));
          if(orientation === "ascending"){
            return aVal - bVal;
          }else{
            return bVal - aVal;
          }
    }));
  }
  </script>
<?php } ?>