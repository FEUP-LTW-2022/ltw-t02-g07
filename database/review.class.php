<?php
  declare(strict_types = 1);

  class Review{

    public int $id;
    public float $score;
    public string $description;
    public string $picture;

    public function __construct(int $id, float $score, string $description, string $picture){

      $this-> id = $id;
      $this-> score = $score;
      $this-> description = $description;
      $this-> picture = $picture;

    }

    public function getRestaurantReviews(PDO $db, int $id) : array {
      $stmt = $db->prepare('
        SELECT ReviewId, Score, Description, Picture
        FROM Review
        WHERE Id_restaurant = ?
        GROUP BY ReviewId
      ');
      $stmt->execute(array($id));
  
      $reviews = array();
  
      while ($review = $stmt->fetch()) {
        $reviews[] = new Review(
          intval($review['ReviewId']), 
          floatval($review['Score']),
          $review['Description'],
          $review['Picture']
        );
      }
  
      return $reviews;
    }

    static function getRestaurantScore(PDO $db, int $id){
        $stmt = $db->prepare('
          SELECT AVG(Score) as Score
          FROM Review
          WHERE Id_restaurant = ?
        ');
        $stmt->execute(array($id));
    
        $score = $stmt->fetch();
    
    
        return $score['Score'];

  }

  }
?>