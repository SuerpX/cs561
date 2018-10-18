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
    }




    function ReadUserInfo($onid){
        $database = new DatabaseUserInfo();
        $db = $database->connect();

        $post = new Post($db);
        $result = $post->readUser($onid);

        $num = $result->rowCount();


        if($num > 0) {
            $posts_arr = array();
            $posts_arr['data'] = array();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $post_item = array(
                    'userInfo' => $userId,
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
            echo json_encode($posts_arr);
        }
        else{
            echo json_encode(array('message' => 'No users'));

        }
    }

