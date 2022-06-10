<?php declare(strict_types = 1); ?>

<!-- Draws the header of the page -->
<?php function drawHeader(){ ?>

<!DOCTYPE html>


<html lang="en-US">
        <head>
            <title>BRZO</title>
            <meta charset="utf-8">
            <link rel="stylesheet" href="../css/style.css">
        </head>
        <body>
            <header>
                <h1><a href="index.php">BRZO</a></h1>
                <?php drawLoginForm() ?>
            </header>

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

<!-- Draws the login of the page -->

<?php function drawLoginForm() { ?>
  <form action="action_login.php" method="post" class="login">
    <input type="text" name="username" placeholder="username">
    <input type="password" name="password" placeholder="password">
    <a href="register.php">Register</a>
    <button type="submit">Login</button>
  </form>
<?php } ?>