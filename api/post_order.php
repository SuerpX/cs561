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
    case 'match':
        matchOrder($_GET['startState'],$_GET['endState'],$_GET['departure'],$_GET['destination']);
        break;


}
function conn(){
    $database = new DatabaseUserInfo();
    $db = $database->connect();

    $order = new Order($db);
    return $order;
}
function orderInfo($oderId){

    $order = conn();
    $result = $order->read($oderId, 'postInfo', 'post_orderId');

    packResult($result, 0);
}



function updatePostOrder(){
    $order = conn();

    $input = file_get_contents('php://input');
    $object = json_decode($input);
    print_r($order->updatePostOrderInfo($object));
    //   print_r($mess);
}
function newPostOrder(){
    $order = conn();

    $input = file_get_contents('php://input');
    $object = json_decode($input);
    print_r($order->newPostOrder($object));
    //   print_r($mess);
}
function postOrderAll(){
    $order = conn();

    $result = $order->readAll( 'postInfo');

    packResult($result, 1);
}

function postOrderBatch($departure, $destination){
    $order = conn();
    $result = $order->readBatch($departure, $destination, 'postInfo');

    packResult($result, 1);
}
function detelePostOrder(){
    $order = conn();

    $input = file_get_contents('php://input');
    $object = json_decode($input);
    //print_r($object);
    print_r($order->deletePostOrder($object->postId));

}
function activetiedOrder($userId){
    $order = conn();
    $result = $order->activitedOrder("postInfo","post_userId", $userId);

    packResult($result, 1);
}
function matchOrder($st, $et, $dep, $des){
    $order = conn();
    $result = $order->matchOrder("postInfo", $st, $et, $dep, $des);

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
                'finished' => $finished,
                'departure_city' => $departure_city,
                'departure_state' => $departure_state,
                'destination_city' => $destination_city,
                'destination_state' => $destination_state
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
        echo "";

    }
}