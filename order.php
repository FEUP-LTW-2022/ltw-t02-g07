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
      <h2>Order 1</h2>
      <section id="dishes">
        <article>
          <a>Dish 1</a>
        </article>
        <article>
          <a>Dish 2</a>
        </article>
        <article>
          <a>Dish 3</a>
        </article>
      </section>
    </main>
    <footer>
      BRZO &copy; 2022
    </footer>
  </body>
</html>