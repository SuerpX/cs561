<?php
/* post is used to read database
    */
include_once 'DatabaseUserInfo.php';
class Order
{
    //DB stuff
    private $conn;

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

    public function readAll($tableName){
        // Create query
        try {
            $query = "SELECT * FROM ".$tableName." WHERE available=1 And finished=0";
            $result = $this->conn->query($query);
            return $result;

        }catch (PDOException $e){
            echo 'error'.$e;
        }

    }
    public function readBatch($departure, $destination, $tableName){
        // Create query
        try {
            $query = "SELECT * FROM ".$tableName." WHERE departure_city='".$departure."' And destination_city='".$destination."' And available=1 And finished=0";
            $result = $this->conn->query($query);
            return $result;

        }catch (PDOException $e){
            echo 'error'.$e;
        }
    }
    public function updatePostOrderInfo($info){
        //    print_r($info);


        try {
            $update = "UPDATE postInfo SET 
post_userid=?, 
departure_location=?, 
destination_location=?, 
departure_time=?, 
post_time=?, 
remarks=?, 
available_seats=?, 
available=?, 
finished=?,
departure_city=?,
departure_state=?,
destination_city=?,
destination_state=?
WHERE post_orderid=?";
            $stmt = $this->conn->prepare($update);
            $stmt->execute([
                $info->post_userid,
                $info->departure_location,
                $info->destination_location,
                $info->departure_time,
                $info->post_time,
                $info->remarks,
                $info->available_seats,
                $info->available,
                $info->finished,
                $info->departure_city,
                $info->departure_state,
                $info->destination_city,
                $info->destination_state,
                $info->post_orderid,

            ]);

            return "success";

        }catch (PDOException $e){
            return "error".$e;
        }
        //  return "success";
    }

    public function newPostOrder($info){
        $order_id = time().$info->post_userid;
        print_r($info);
        try {
            $update = "INSERT INTO postInfo (
post_orderid, 
post_userid, 
departure_location, 
destination_location, 
departure_time, 
post_time, 
remarks, 
available_seats, 
available,
finished,
departure_city,
departure_state,
destination_city,
destination_state
)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($update);
            //print_r($stmt);
            $stmt->execute([
                $order_id,
                $info->post_userid,
                $info->departure_location,
                $info->destination_location,
                $info->departure_time,
                $info->post_time,
                $info->remarks,
                $info->available_seats,
                $info->available,
                $info->finished,
                $info->departure_city,
                $info->departure_state,
                $info->destination_city,
                $info->destination_state,
            ]);

            return "success";

        }catch (PDOException $e){
            return "error".$e;
        }
    }

    public function deletePostOrder($postId){
        try {

            $del = "DELETE FROM postInfo WHERE post_orderid='".$postId."'";
        //    print_r($del);
            $stmt = $this->conn->prepare($del);
            $stmt->execute();
            return "success";

        }catch (PDOException $e){
            return "error".$e;
        }
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
people_number=?, 
available=?, 
finished=?,
departure_city=?,
departure_state=?,
destination_city=?,
destination_state=?
WHERE request_orderid=?";
            $stmt = $this->conn->prepare($update);
            $stmt->execute([
                $info->request_userid,
                $info->departure_location,
                $info->destination_location,
                $info->departure_time,
                $info->post_time,
                $info->remarks,
                $info->people_number,
                $info->available,
                $info->finished,
                $info->departure_city,
                $info->departure_state,
                $info->destination_city,
                $info->destination_state,
                $info->request_orderid,
            ]);

            return "success";

        }catch (PDOException $e){
            return "error".$e;
        }
        //  return "success";
    }

    public function newRequestOrder($info){
        $order_id = time().$info->request_userid;
        try {
            $update = "INSERT INTO requestInfo (
request_orderid, 
request_userid, 
departure_location, 
destination_location, 
departure_time, 
post_time, 
remarks, 
people_number, 
available,
finished,
departure_city,
departure_state,
destination_city,
destination_state
)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($update);
            //print_r($stmt);
            $stmt->execute([
                $order_id,
                $info->request_userid,
                $info->departure_location,
                $info->destination_location,
                $info->departure_time,
                $info->post_time,
                $info->remarks,
                $info->people_number,
                $info->available,
                $info->finished,
                $info->departure_city,
                $info->departure_state,
                $info->destination_city,
                $info->destination_state,
            ]);

            return "success";

        }catch (PDOException $e){
            return "error".$e;
        }
    }

    public function deleteRequestOrder($requestId){
        try {

            $del = "DELETE FROM requestInfo WHERE request_orderid='".$requestId."'";
            $stmt = $this->conn->prepare($del);
            $stmt->execute();
            return "success";

        }catch (PDOException $e){
            return "error".$e;
        }
    }
    public function activitedOrder($tableName, $tableUserName, $userId){
        try {
            $query = "SELECT * FROM ".$tableName." WHERE ".$tableUserName."='".$userId."' And available=1 And finished=0";
            $result = $this->conn->query($query);
            return $result;

        }catch (PDOException $e){
            echo 'error'.$e;
        }
    }
    /*
    public function waitListOrder($tableName, $tableMainKey)
    */
    function matchOrder($tableName, $st, $et, $dep, $des){
        $query = "SELECT * FROM ".$tableName."
          WHERE departure_time>'".$st."'
         And departure_time<'".$et."'
          And departure_city='".$dep."'
          And destination_city='".$des."'
          And available=1 And finished=0";

        //print_r($query);
        $result = $this->conn->query($query);

        return $result;

    }

}



/*
$d = new DatabaseUserInfo();
$db = $d->connect();
$p = new Post($db);
$p->readAll('linzhe');
*/