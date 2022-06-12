<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.db.php');
  require_once('database/User.class.php');

  $db = getDatabaseConnection();

  $User = User::getUserWithPassword($db, $_POST['email'], $_POST['password']);

  if ($User) {
    $_SESSION['id'] = $User->id;
    $_SESSION['name'] = $User->name;
    if($User->isOwner($db)){
      $_SESSION['isOwner'] = true;
    }
    echo "<script type=\"text/javascript\">
        location=\"/index.php\";
        </script>";
  }else{
    echo "<script type=\"text/javascript\">
    alert(\"Invalid account\");
    location=\"/login.php\";
    </script>";
  }
?>