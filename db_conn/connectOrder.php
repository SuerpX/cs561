<?php
/* post is used to read database
    */
include_once 'DatabaseUserInfo.php';
class Order
{
    //DB stuff
    private $conn;

    // constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

}