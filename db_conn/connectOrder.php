<?php
/* post is used to read database
    */
include_once 'DatabaseUserInfo.php';
class connectOrder
{
    //DB stuff
    private $conn;

    // constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function newConfirmed($info){
        try {
            $update = "INSERT INTO confirm_list (post_orderid,request_orderid,userid,confirm_time) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($update);
            $stmt->execute([
                $info->postOrderId,
                $info->requestOrderId,
                $info->userId,
                date('Y-m-d H:i:s'),
            ]);
            return "success";

        }catch (PDOException $e){
            return "error".$e;
        }

    }


    public function newWaitList($tableName, $info){
        try {
            $update = "INSERT INTO ".$tableName." (
post_orderid,
userid,
request_orderid
)
VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($update);
            $stmt->execute([
                $info->postOrderId,
                $info->userId,
                $info->requestOrderId,
            ]);

            return "success";

        }catch (PDOException $e){
            return "error".$e;
        }
    }
    public function deleteWaitList($tableName, $info){
        try {
            $del = "DELETE FROM ".$tableName." WHERE post_orderid=? And request_orderid=?";
            $stmt = $this->conn->prepare($del);
            $stmt->execute([
                $info->postOrderId,
                $info->requestOrderId,
            ]);

            return "success";

        }catch (PDOException $e){
            return "error".$e;
        }
    }
    public function deleteConfirmedOrder($info){
        try {
            $del = "DELETE FROM confirm_list WHERE post_orderid=? And request_orderid=?";
            $stmt = $this->conn->prepare($del);
            $stmt->execute([
                $info->postOrderId,
                $info->requestOrderId,
            ]);
            return "success";

        }catch (PDOException $e){
            return "error".$e;
        }
    }
    public function readWaitList($selectName, $tableName, $id, $idname){
        try {
            $query = "SELECT ".$selectName." FROM ".$tableName." WHERE ".$idname."='".$id."'";
            $result = $this->conn->query($query);
            return $result;

        }catch (PDOException $e){
            return "error".$e;
        }
    }

    public function deleteWaitListWithRequstOrderId($tableName, $requestOrderId){
        try {
            $del = "DELETE FROM ".$tableName." WHERE request_orderid=?";
            $stmt = $this->conn->prepare($del);
            $stmt->execute([
                $requestOrderId,
            ]);

            return "success";

        }catch (PDOException $e){
            return "error".$e;
        }
    }

    public function readConfirmedList($userId){
        try {
            $query = "SELECT request_orderid FROM confirm_list WHERE request_orderid IN (SELECT request_orderid FROM requestInfo WHERE request_userid='".$userId."')";
            $result = $this->conn->query($query);
            return $result;

        }catch (PDOException $e){
            return "error".$e;
        }
    }
    public function readUnconfirmedList($userId){
        try {
            $query = "SELECT request_orderid FROM requestInfo WHERE request_orderid NOT IN (SELECT request_orderid FROM confirm_list) AND request_userid='".$userId."' AND finished=0";
            //print_r($query);
            $result = $this->conn->query($query);
            return $result;

        }catch (PDOException $e){
            return "error".$e;
        }
    }
    public function readConfirmedOrderForRequestOrderId($requestOrderId){
        $query = "SELECT post_orderid FROM confirm_list WHERE request_orderid='".$requestOrderId."' limit 1";
        $result = $this->conn->query($query);
        return $result;
    }
}