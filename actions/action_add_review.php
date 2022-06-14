<?php
    declare(strict_types = 1);

    session_start();

    if (!isset($_SESSION['id'])) die(header('Location: /'));
    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        echo '<script type="text/javascript">alert("csrf potentionally detected! logout and login if false");</script>';
        exit;
      }
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/review.class.php');

    $db = getDatabaseConnection();
    $review = new Review(0,floatval($_POST['score']),$_POST['reviewText'],"",intval($_SESSION['id']),"",intval($_POST['restaurantId']));
    $review->addReview($db);
    echo '<script type="text/javascript">alert("Review submitted!");history.go(-1);</script>';

?>