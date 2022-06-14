<?php declare(strict_types = 1); ?>

<!-- Draws the header of the page -->
<?php function drawHeader(){ ?>

<!DOCTYPE html>
<link rel="icon" href="images/logo.png">

<html lang="en-US">
        <head>
            <title>BRZO</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="css/style.css">
            <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        </head>
        <body>
            <header>
                <img src="images/logo.png" alt="Restaurant Logo" id="logo">
                <h1><a href="index.php">BRZO</a></h1>
                <!--<?php drawLoginForm() ?> -->
                <nav class="navbar">
                  <div class="navBox">
                    <ul>
                      <li><a href="index.php">Home</a></li>
                      <?php 
                        if (isset($_SESSION['isOwner'])){
                          echo'<li><a href="manage.php">Manage</a></li>';
                        }
                        if (isset($_SESSION['id'])) {
                          echo'<li><a href="favorite.php">Favorites</a></li>';
                          echo'<li><a href="order.php">Orders</a></li>';
                          echo'<li><a href="actions/action_logout.php">Logout</a></li>';
                          echo'<li><a href="profile.php">Profile</a></li>';
                        }
                        else echo'<li><a href="login.php">Login</a></li>';
                      ?>
                    </ul>
                  </div>
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
      <input type="email" name="email" placeholder="email" class="input">
      <input type="password" name="password" placeholder="password" class="input">
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




