<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.db.php');
  require_once('database/User.class.php');

  $db = getDatabaseConnection();

  $succesful = User::addUser($db, $_POST['name'], $_POST['email'],$_POST['password']);

  if ($succesful) {
    $_SESSION['id'] = $User->id;
    $_SESSION['name'] = $User->name;
    echo "<script type=\"text/javascript\">
        alert(\"Registration succesful\");
        location=\"login.php\";
        </script>";
  }
  else{
    echo "<script type=\"text/javascript\">
    alert(\"Email address already used\");
    location=\"register.php\";
    </script>";
  }
?>