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

       <h2><a href="favorite.php?id=1">Favorites</a></h2>


      <h2>Restaurants</h2>
      <section id="Restaurants">
        <article>
          <a href="restaurant.php?id=1">Restaurant 1</a>
        </article>
        <article>
          <a href="restaurant.php?id=1">Restaurant 2</a>
        </article>
        <article>
          
          <a href="restaurant.php?id=1">Restaurant 3</a>
        </article>
      </section>    
      
      <h2>Orders</h2>
      <table id="Orders">
        <tr><th scope="col">#</th><th scope="col">State</th></tr>
        <tr><td><a href="order.php?id=1">1</a></td><td>Pending</td></tr>
        <tr><td><a href="order.php?id=1">2</a></td><td>Accepted</td></tr>
        <tr><td><a href="order.php?id=1">3</a></td><td>Finished</td></tr>
        <tr><td><a href="order.php?id=1">4</a></td><td>Finished</td></tr>
      </table> 

    </main>
    <footer>
      BRZO &copy; 2022
    </footer>
  </body>
</html>