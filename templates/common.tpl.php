<?php declare(strict_types = 1); ?>

<!-- Draws the header of the page -->
<?php function drawHeader(){ ?>

<!DOCTYPE html>


<html lang="en-US">
        <head>
            <title>BRZO</title>
            <meta charset="utf-8">
            <link rel="stylesheet" href="css/style.css">
        </head>
        <body>
            <header>
                <img src="images/logo.png" alt="Restaurant Logo" id="logo">
                <h1><a href="index.php">BRZO</a></h1>
                <!--<?php drawLoginForm() ?> -->
                <nav id="navbar">
                  <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="favorite.php">Favorites</a></li>
                    <li><a href="orders">Orders</a></li>
                    <?php 
                      if (isset($_SESSION['isOwner'])){
                        echo'<li><a href="manage.php">Manage</a></li>';
                      }
                      if (isset($_SESSION['id'])) {
                        echo'<li><a href="actions/action_logout.php">Logout</a></li>';
                        echo'<li><a href="profile.php">Profile</a></li>';
                      }
                      else echo'<li><a href="login.php">Login</a></li>';
                    ?>
                  </ul>
                </nav>
            </header>
            <div id="fix"></div>
            <main>
        <?php } ?>


<!-- Draws the footer of the page -->

<?php function drawFooter() { ?>
    </main>

    <footer>
      BRZO &copy; 2022
    </footer>
  </body>
</html>
<?php } ?>


<?php function drawLoginForm() { ?>
  <form action="actions/action_login.php" method="post" class="login">
    <input type="email" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <a href="register.php">Register</a>
    <button type="submit">Login</button>
  </form>
<?php } ?>

<?php function drawRegistrationForm() { ?>
  <form action="actions/action_register.php" method="post" class="register">
    <input type="email" name="email" placeholder="email">
    <input type="name" name="name" placeholder="name">
    <input type="password" name="password" placeholder="password">
    <label for="role">Choose a account type:</label>
    <select id="role" name="role">
      <option value="customer">Customer</option>
      <option value="owner">Owner</option>
      <option value="driver">Driver</option>
    </select>
    <button type="submit">Register</button>
  </form>
<?php } ?>


<?php function drawOwnerStatistics(array $restaurants) { ?>
  <!DOCTYPE html>
    <html>
    <head>
      <title>Restaurant table</title>
      <link rel="stylesheet" href="css/style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
      <body>
        <div class="row">
          <div class="column">
            <table id="restaurantsTable" class="myTable">
              <caption>Restaurants</caption>
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Picture</th>
                  <th>Address</th>
                  <th>Category</th>
                </tr>
              </thead>
              <tbody>
              <?php
              if(count($restaurants) > 0){
                foreach($restaurants as $restaurant) {
                  echo "<tr data-id=" . $restaurant["id"] . ">
                          <td>" . $restaurant["name"]. "</td>
                          <td>" . $restaurant["picture"] . "</td>
                          <td>" . $restaurant["address"]. "</td>
                          <td>" . $restaurant["category"] ."</td>
                        </tr>";
                }
              } else { echo "0 results"; }
              ?>
              </tbody>
            </table>
            <form id="addForm">
              <input type="name" name="name" id="name" placeholder="name*">
              <input type="picture" name="picture" id="picture" placeholder = "picture">
              <input type="address" name="address" id="address" placeholder ="address*">
              <input type="category" name="category" id="category" placeholder ="category*">
              <button id="submit">Add restaurant</button>
            </form>
          </div>
          <div class="column">
            <div class="tab">
              <button class="tablinks" onclick="openCity(event, 'dishes')" id="defaultOpen">Dishes</button>
              <button class="tablinks" onclick="openCity(event, 'reviews')">Reviews</button>
              <button class="tablinks" onclick="openCity(event, 'orders')">Orders</button>
            </div>

            <div id="dishes" class="tabcontent">
            </div>

            <div id="reviews" class="tabcontent">
            </div>

            <div id="orders" class="tabcontent">
            </div>
          </div>
        </div>
        <script>
          //adding onclick element to all rows in table
          $(document).ready(function(){
            $("#submit").click(function() {
 
            var name = $("#name").val();
            var picture = $("#picture").val();
            var address = $("#address").val();
            var category = $("#category").val();

            if(name==''||address==''||category=='') {
              alert("Please fill all mandatory fields");
              return false;
            }
            $.ajax({
              type: "POST",
              url: "handlers/addRestaurant.php",
              data: {
                name: name,
                picture: picture,
                address: address,
                category: category
              },
              cache: false,
              success: function(data) {
              },
              error: function(xhr, status, error) {
                console.error(xhr);
              }
              });
            });
          });
          
          //highlighting the selected row
          $(function() {
          $('td').click(function() {
              $('tr').removeClass('active-row');
              $(this).parent().addClass('active-row'); 
              $.ajax({
                type:"POST",
                url:'handlers/fetchRestaurantDishes.php',
                data:{id:this.parentElement.dataset.id},
                dataType: "html",
                success: function(data){
                  $("#dishes").html(data); 
                }
              });
              $.ajax({
                type:"POST",
                url:'handlers/fetchRestaurantReviews.php',
                data:{id:this.parentElement.dataset.id},
                dataType: "html",
                success: function(data){
                  $("#reviews").html(data); 
                }
              });
              $.ajax({
                type:"POST",
                url:'handlers/fetchRestaurantOrders.php',
                data:{id:this.parentElement.dataset.id},
                dataType: "html",
                success: function(data){
                  $("#orders").html(data); 
                }
              });

              });
          });

          //switching tabs
          function openCity(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
            }

          // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>
      </body>
    </html>
<?php } ?>

