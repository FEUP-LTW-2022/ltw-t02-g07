<?php
  declare(strict_types = 1);

  class Review{

    public int $id;
    public float $score;
    public string $description;
    public string $picture;
    public int $userId;
    public string $response;
    public int $restaurantId;

    public function __construct(int $id, float $score, string $description, string $picture, int $userId, string $response, int $restaurantId){

      $this-> id = $id;
      $this-> score = $score;
      $this-> description = $description;
      $this-> picture = $picture;
      $this-> userId = $userId;
      $this-> response = $response;
      $this-> restaurantId = $restaurantId;


    }

    static function getRestaurantReviews(PDO $db, int $id) : array {
      $stmt = $db->prepare('
        SELECT ReviewId, Score, Description, Picture, Id_user, Response
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
          $review['Picture'],
          intval($review['Id_user']),
          is_null($review['Response']) ? "" : $review['Response'],
          $id,
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

  function addReview(PDO $db){
    $stmt = $db->prepare('
      INSERT INTO Review (Score, Description, Picture, Response, Id_restaurant, Id_user) VALUES (?,?,?,?,?,?)
    ');
    $stmt->execute(array($this->score,$this->description,$this->picture,$this->response,$this->restaurantId,$this->userId));
    return $db->lastInsertId();



}

  }
?>