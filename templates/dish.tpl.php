<?php declare(strict_types = 1); ?>


<!-- Draws the dish that is required -->

<?php function drawDish(string $dishName, array $reviews,int $restaurantId, string $restaurantName) { ?>
  <h2><?=$dishName?></h2>      
  <table id="reviews">
    <tr><th scope="col">#</th><th scope="col">Score</th><th scope="col">Description</th></tr>
    <?php foreach ($reviews as $review) { ?>
      <tr><td><?=$review['id']?></td><td><?=$review['score']?></td><td><?=$review['description']?></td></tr>
    <?php } ?>
  </table>
  <h3><a href="restaurant.php?id=<?=$restaurantId?>"><?=$restaurantName?></a></h3>
<?php } ?>

