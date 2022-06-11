<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once('database/connection.db.php');
  require_once('database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUser($db, $_SESSION['id']);

  if ($user) {
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->phone = $_POST['phone_number'];
    $user->address = $_POST['address'];
    
    $user->save($db);
  }

  header('Location: profile.php');
?>