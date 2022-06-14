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

  if ($user) {
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->phone = $_POST['phone_number'];
    $user->address = $_POST['address'];
    
    $user->save($db);
  }

  header('Location: /../profile.php');
?>