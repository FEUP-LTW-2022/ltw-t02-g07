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
      <form action="action_login.php" method="post" class="login">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <a href="register.php">Register</a>
        <button type="submit">Login</button>
      </form>
    </header>
  
    <main>

        <h3>Dish</h3>   
      <table id="Reviews">
        <tr><th scope="col">#</th><th scope="col">Score</th><th scope="col">Description</th></tr>
        <tr><td>1</td><td>5</td><td>Good</td></tr>
        <tr><td>2</td><td>4.5</td><td>Amazing</td></tr>
        <tr><td>3</td><td>5</td><td>Great</td></tr>
        <tr><td>4</td><td>4.2</td><td>Good</td></tr>
      </table>
      <h3><a href="restaurant.php?id=1">To restaurant</a></h3>   
    </main>
    <footer>
      BRZO &copy; 2022
    </footer>
  </body>
</html>