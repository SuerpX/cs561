<?php
/* post is used to read database
    */
include_once 'DatabaseUserInfo.php';
class Post
{
    //DB stuff
    private $conn;

    // Post Properties
    public $userId;
    public $firstname;
    public $lastname;
    public $phoneNumber;
    public $email;
    public $address;
    public $orderId;
    public $finishRegister;

    // constructor with DB
    public function  __construct($db)
    {
        $this->conn = $db;
    }

    // Get Posts
    public function readUser($onid){
        // Create query
        try {
            $query = "SELECT * FROM userInfo WHERE userId='".$onid."' limit 1";
            $result = $this->conn->query($query);
            return $result;

        }catch (PDOException $e){
            echo 'error'.$e;
        }

    }

    public function updateUser($info){

        try {
            //$update = "UPDATE userInfo SET phoneNumber=? address=? finishRegister=? WHERE userId=?";
            //$stmt = $this->conn->prepare($update);
           // $stmt->execute([$info['phoneNumber'], $info['address'], $info['finishRegister'], $info['userId']]);

        }catch (PDOException $e){
        //    return "error".$e;
        }
      //  return "success";
    }
}
/*
$d = new DatabaseUserInfo();
$db = $d->connect();
$p = new Post($db);
$p->readAll('linzhe');
*/