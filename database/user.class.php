<?php
  declare(strict_types = 1);

  class User {
    public int $id;
    public string $name;
    public string $address;
    public string $email;
    public string $phone;


    public function __construct(int $id, string $name, string $address, string $phone, string $email)
    {
      $this->id = $id;
      $this->name = $name;
      $this->address = $address;
      $this->phone = $phone;
      $this->email = $email;
      
    }

    function isOwner($db){
      $stmt = $db->prepare("
      SELECT UserId
      FROM User
      JOIN Owner ON User.UserId = Owner.OwnerId
      WHERE UserId = ?
    ");
      $stmt->execute(array($this->id));
      if($User = $stmt->fetch()){
          return true;
      } else {
        return false;
      }
    }

    function save($db) {
        $stmt = $db->prepare('
          UPDATE User SET Name = ?, Address = ?, PhoneNumber = ?, Email = ?
          WHERE UserId = ?
        ');
  
        $stmt->execute(array($this->name, $this->address, $this->phone, $this->email, $this->id));
      }
      function savePassword($db,$hash) {
        $stmt = $db->prepare('
          UPDATE User SET Password = ?
          WHERE UserId = ?
        ');
  
        $stmt->execute(array($hash,$this->id));
      }
    
    static function getUserWithPassword(PDO $db, string $email, string $password) : ?User {
      $stmt = $db->prepare("
        SELECT UserId, Name, Address, PhoneNumber, Email
        FROM User
        WHERE lower(email) = ? AND password = ?
      ");

      $stmt->execute(array(strtolower($email),$password));
        
      if($User = $stmt->fetch()){
        foreach ($User as $key => $value) {
            if (is_null($value)) {
                 $User[$key] = "";
            }
          }
        return new User(
          intval($User['UserId']),
          $User['Name'],
          $User['Address'],
          $User['PhoneNumber'],
          $User['Email']
        );
      } else {
        return null;
      }
    }
    static function getUserPassword(PDO $db, int $id) : string {
      $stmt = $db->prepare('
        SELECT Password
        FROM User 
        WHERE UserId = ?
      ');
      $stmt->execute(array($id));
      return $stmt->fetch()['Password'];
    }

    static function getUser(PDO $db, int $id) : ?User {
      $stmt = $db->prepare('
        SELECT UserId, Name, Address, PhoneNumber, Email
        FROM User 
        WHERE UserId = ?
      ');
      $stmt->execute(array($id));
      if($User = $stmt->fetch()){
        foreach ($User as $key => $value) {
            if (is_null($value)) {
                 $User[$key] = "";
            }
          }
      
        return new User(
            intval($User['UserId']),
            $User['Name'],
            $User['Address'],
            $User['PhoneNumber'],
            $User['Email']
        );
        } else {
            return null;
        }
    }
    static function getUserByEmail(PDO $db, string $email) : ?User {
        $stmt = $db->prepare('
          SELECT UserId, Name, Address, PhoneNumber, Email
          FROM User 
          WHERE Email = ?
        ');
        $stmt->execute(array($email));
        if($User = $stmt->fetch()){
            foreach ($User as $key => $value) {
                if (is_null($value)) {
                     $User[$key] = "";
                }
              }
        
          return new User(
              intval($User['UserId']),
              $User['Name'],
              $User['Address'],
              $User['PhoneNumber'],
              $User['Email']
          );
          } else {
              return null;
          }
      }

    static function addUser(PDO $db, string $name, string $email, string $password) : bool{
        if(User::getUserByEmail($db,$email) == null){
            $stmt = $db->prepare('
                INSERT INTO User (Name, Email, Password) VALUES (?,?,?)
            ');
            $stmt->execute(array($name,$email,$password));
            return true;
        }else{
            return false;
        }
    }

  }
?>