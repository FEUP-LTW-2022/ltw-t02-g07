<?php
  $db = new PDO('sqlite:dblite.db');

  $stmt = $db->prepare('SELECT * FROM User');
  $stmt->execute();
  $users = $stmt->fetchAll();

  foreach( $users as $user) {
    echo '<h1>' . $user['Name'] . '</h1>';
    echo '<p>' . $user['PhoneNumber'] . '</p>';
  }
?>