<?php

// Hearders

header('Access-Control-Allow-Origin: *');
header('Conten-Type: application/json');

include_once '../db_conn/DatabaseUserInfo.php';
include_once '../db_conn/order.php';


switch ($_GET['view']){

    case 'post_info':
        orderInfo($_GET['postId']);
        break;
    case 'update':
        updatePostOrder();
        break;
    case 'insert':
        newPostOrder();
        break;
    case 'post_order_all':
        postOrderAll();
        break;
    case 'location':
        postOrderBatch($_GET['departure'], $_GET['destination']);
        break;
    case 'delete':
        detelePostOrder();
        break;
    case 'activited_order':
        activetiedOrder($_GET['userId']);
        break;


}
function orderInfo($oderId){
    $database = new DatabaseUserInfo();
    $db = $database->connect();

    $order = new Order($db);
    $result = $order->read($oderId, 'postInfo', 'post_orderId');

    packResult($result, 0);
}



function updatePostOrder(){
    $database = new DatabaseUserInfo();
    $db = $database->connect();
    $order = new Order($db);

    $input = file_get_contents('php://input');
    $object = json_decode($input);
    print_r($order->updatePostOrderInfo($object));
    //   print_r($mess);
}
function newPostOrder(){
    $database = new DatabaseUserInfo();
    $db = $database->connect();
    $order = new Order($db);

    $input = file_get_contents('php://input');
    $object = json_decode($input);
    print_r($order->newPostOrder($object));
    //   print_r($mess);
}
function postOrderAll(){
    $database = new DatabaseUserInfo();
    $db = $database->connect();

    $order = new Order($db);
    $result = $order->readAll( 'postInfo');

    packResult($result, 1);
}

function postOrderBatch($departure, $destination){
    $database = new DatabaseUserInfo();
    $db = $database->connect();

    $order = new Order($db);
    $result = $order->readBatch($departure, $destination, 'postInfo');

    packResult($result, 1);
}
function detelePostOrder(){
    $database = new DatabaseUserInfo();
    $db = $database->connect();
    $order = new Order($db);

    $input = file_get_contents('php://input');
    $object = json_decode($input);
    //print_r($object);
    print_r($order->deletePostOrder($object->postId));

}
function activetiedOrder($userId){
    $database = new DatabaseUserInfo();
    $db = $database->connect();

    $order = new Order($db);
    $result = $order->activitedOrder("postInfo","post_userId", $userId);

    packResult($result, 1);
}
function packResult($result, $isList){
    $num = $result->rowCount();

    if($num > 0) {
        $posts_arr = array();
        $posts_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $post_item = array(
                'post_orderid' => $post_orderid,
                'post_userid' => $post_userid,
                'departure_location' => $departure_location,
                'destination_location' => $destination_location,
                'departure_time' => $departure_time,
                'post_time' => $post_time,
                'remarks' => $remarks,
                'available_seats' => $available_seats,
                'available' => $available,
                'finished' => $finished
            );
            array_push($posts_arr['data'], $post_item);
        }
        if ($isList == 0){
            echo json_encode($posts_arr['data'][0]);
        }
        else{
            echo json_encode($posts_arr['data']);
        }

    }
    else{
        echo json_encode(array('message' => 'Nothing'));

    }
}