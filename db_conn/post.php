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
    public function read($id, $tableName, $idname){
        // Create query
        try {
            $query = "SELECT * FROM ".$tableName." WHERE ".$idname."='".$id."' limit 1";
            $result = $this->conn->query($query);
            return $result;

        }catch (PDOException $e){
            echo 'error'.$e;
        }

    }

    public function updateUser($info){

        try {
            $update = "UPDATE userInfo SET phoneNumber=?, address=?, finishRegister=? WHERE userId=?";
            $stmt = $this->conn->prepare($update);
            $stmt->execute([$info->phoneNumber, $info->address, $info->finishRegister, $info->userId]);

            return "success";

        }catch (PDOException $e){
            return "error".$e;
        }
        //  return "success";
    }

    public function updateRequestOrderInfo($info){
    //    print_r($info);

        try {
            $update = "UPDATE requestInfo SET 
request_userid=?, 
departure_location=?, 
destination_location=?, 
departure_time=?, 
post_time=?, 
remarks=?, 
available_seats=?, 
available=?, 
finished=?
WHERE request_orderid=?";
            $stmt = $this->conn->prepare($update);
            $stmt->execute([
                $info->request_userid,
                $info->departure_location,
                $info->destination_location,
                $info->departure_time,
                $info->post_time,
                $info->remarks,
                $info->available_seats,
                $info->available,
                $info->finished,
                $info->request_orderid,
            ]);

            return "success";

        }catch (PDOException $e){
            return "error".$e;
        }
        //  return "success";
    }

    public function newRequestOrder($info){
        try {
            $update = "INSERT INTO requestInfo (
request_orderid, 
request_userid, 
departure_location, 
destination_location, 
departure_time, 
post_time, 
remarks, 
available_seats, 
available,
finished)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($update);
            //print_r($stmt);
            $stmt->execute([
                $info->request_orderid,
                $info->request_userid,
                $info->departure_location,
                $info->destination_location,
                $info->departure_time,
                $info->post_time,
                $info->remarks,
                $info->available_seats,
                $info->available,
                $info->finished,
            ]);

            return "success";

        }catch (PDOException $e){
            return "error".$e;
        }
    }
}



/*
$d = new DatabaseUserInfo();
$db = $d->connect();
$p = new Post($db);
$p->readAll('linzhe');
*/