<?php
  declare(strict_types = 1);

  session_start();
  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $User = User::getUserByEmail($db, $_POST['email']);
  
  if ($User) {
    $hash = User::getUserPassword($db,$User->id);
/*     if (!password_verify($_POST['password'],$hash)) {
      echo "<script type=\"text/javascript\">
      alert(\"Invalid account\");
      location=\"/login.php\";
      </script>";
      exit;
    } */
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