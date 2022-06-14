<?php
  declare(strict_types = 1);

  session_start();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $succesful = User::addUser($db, $_POST['name'], $_POST['email'],$_POST['password']);
  $role = $_POST['role'];

  if($role == 'owner'){
    require_once('database/owner.class.php');
    $user = User::getUserByEmail($db,$_POST['email']);
    Owner::addOwner($db,$user->id);
  }
  if ($succesful) {
    echo "<script type=\"text/javascript\">
        alert(\"Registration succesful\");
        location=\"/login.php\";
        </script>";
  }
  else{
    echo "<script type=\"text/javascript\">
    alert(\"Email address already used\");
    location=\"/register.php\";
    </script>";
  }
?>