<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  if ($_SESSION['csrf'] !== $_POST['csrf']) {
    echo '<script type="text/javascript">alert("csrf potentionally detected! logout and login if false");</script>';
    exit;
  }
  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUser($db, $_SESSION['id']);
  $options = ['cost' => 12];
  if ($user) {
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->phone = $_POST['phone_number'];
    $user->address = $_POST['address'];
    $hash = User::getUserPassword($db,$user->id);
    echo $hash;
    if (!password_verify($_POST['password2'],$hash)) {
      $user->savePassword($db,password_hash($_POST['password1'],PASSWORD_DEFAULT,$options));
    }
    $user->save($db);
  }

  echo "<script type=\"text/javascript\">
  alert(\"Information updated\");
  location=\"/profile.php\";
  </script>";
?>