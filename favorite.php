<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>BRZO</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <h1><a href="index.php?id=1">BRZO</a></h1>
      <form action="actions/action_login.php" method="post" class="login">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <a href="register.php">Register</a>
        <button type="submit">Login</button>
      </form>
    </header>
  
    <main>
      <table id="dishes">
        <tr><th scope="col">#</th><th scope="col">Name</th></tr>
        <tr><td>1</td><td><a href="dish.php?id=1">Dish</a></td></tr>
        <tr><td>2</td><td><a href="dish.php?id=1">Dish</a></td></tr>
        <tr><td>3</td><td><a href="dish.php?id=1">Dish</a></td></tr>
        <tr><td>4</td><td><a href="dish.php?id=1">Dish</a></td></tr>
      </table>
    </main>
    <footer>
      BRZO &copy; 2022
    </footer>
  </body>
</html>