<?php declare(strict_types = 1); ?>

<!-- Draws the header of the page -->
<?php function drawHeader(){ ?>

<!DOCTYPE html>


<html lang="en-US">
        <head>
            <title>BRZO</title>
            <meta charset="utf-8">
            <link rel="stylesheet" href="css/style.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        </head>
        <body>
            <header>
                <img src="images/logo.png" alt="Restaurant Logo" id="logo">
                <h1><a href="index.php">BRZO</a></h1>
                <!--<?php drawLoginForm() ?> -->
                <nav class="navbar">
                  <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="favorite.php">Favorites</a></li>
                    <li><a href="order.php">Orders</a></li>
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
            <div class="fix"></div>
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
  <form action="actions/action_login.php" method="post" class="login log">
    <div class="loginBox">
      <input type="email" name="email" placeholder="email" class="inputInfo">
      <input type="password" name="password" placeholder="password" class="inputInfo">
      <a href="register.php">Register</a>
      <button type="submit" id="log-bttn">Login</button>
    </div>
    <div class="fix"></div>
  </form>
<?php } ?>

<?php function drawRegistrationForm() { ?>
  <form action="actions/action_register.php" method="post" class="register log">
    <div class="loginBox">
      <input type="email" name="email" placeholder="email">
      <input type="name" name="name" placeholder="name">
      <input type="password" name="password" placeholder="password">
      <label for="role">Choose a account type:</label>
      <select id="role" name="role">
        <option value="customer">Customer</option>
        <option value="owner">Owner</option>
        <option value="driver">Driver</option>
      </select>
      <button type="submit" id="reg-bttn">Register</button>
    </div>
    <div class="fix"></div>
  </form>
<?php } ?>




