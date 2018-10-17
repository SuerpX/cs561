<?php
/**
 * Created by PhpStorm.
 * User: xian
 * Date: 2018/10/16
 * Time: 下午6:04
 */

class DatabaseUserInfo
{
    private  $host = 'oniddb.cws.oregonstate.edu';
    private  $db_name = 'hezhi-db';
    private  $username = 'hezhi-db';
    private  $password = 'J3NL61BXyBFGtxBV';
    private  $conn;

    // Connnet
    public  function  connect(){
        $this->conn = null;

        try{
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch (PDOException $e){
            echo 'Connection Error:' . $e->getMessage();
        }
        return $this->conn;
    }
}/*
$d = new DatabaseUserInfo();
$d->connect();
*/