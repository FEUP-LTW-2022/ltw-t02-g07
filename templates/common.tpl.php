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
                      if (isset($_SESSION['id'])) {
                        echo'<li><a href="action_logout.php">Logout</a></li>';
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
  <form action="action_login.php" method="post" class="login">
    <input type="email" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <a href="register.php">Register</a>
    <button type="submit">Login</button>
  </form>
<?php } ?>

<?php function drawRegistrationForm() { ?>
  <form action="action_register.php" method="post" class="register">
    <input type="email" name="email" placeholder="email">
    <input type="name" name="name" placeholder="name">
    <input type="password" name="password" placeholder="password">
    <button type="submit">Register</button>
  </form>
<?php } ?>

