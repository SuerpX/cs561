<?php

// Hearders

    header('Access-Control-Allow-Origin: *');
    header('Conten-Type: application/json');

    include_once '../db_conn/DatabaseUserInfo.php';
    include_once '../db_conn/post.php';




    switch ($_GET['view']){
        case 'userInfo':
            ReadUserInfo($_GET['onid']);
            break;
        case 'update':
            updateUserInfo();
    }




    function ReadUserInfo($onid){
        $database = new DatabaseUserInfo();
        $db = $database->connect();

        $post = new Post($db);
        $result = $post->read($onid, 'userInfo', 'userId');

        $num = $result->rowCount();


        if($num > 0) {
            $posts_arr = array();
            $posts_arr['data'] = array();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $post_item = array(
                    'userId' => $userId,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'phoneNumber' => $phoneNumber,
                    'email' => $email,
                    'address' => $address,
                    'orderId' => $orderId,
                    'finishRegister' => $finishRegister
                );
                array_push($posts_arr['data'], $post_item);
            }
            echo json_encode($posts_arr['data'][0]);
        }
        else{
            echo json_encode(array('message' => 'No users'));

        }
    }

    function updateUserInfo(){
        $database = new DatabaseUserInfo();
        $db = $database->connect();

        $post = new Post($db);

        $input = file_get_contents('php://input');
        $object = json_decode($input);
        print_r($post->updateUser($object));
     //   print_r($mess);
    }

