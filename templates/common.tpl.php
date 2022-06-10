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
                    <li><a href="login.php">Login</a></li>
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

<!-- Draws the login of the page 

<?php function drawLoginForm() { ?>
  <form action="action_login.php" method="post" class="login">
    <input type="text" name="username" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <a href="register.php">Register</a>
    <button type="submit">Login</button>
  </form>
<?php } ?>

-->