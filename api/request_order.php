<?php

// Hearders

header('Access-Control-Allow-Origin: *');
header('Conten-Type: application/json');

include_once '../db_conn/DatabaseUserInfo.php';
include_once '../db_conn/order.php';


switch ($_GET['view']){

    case 'request_info':
        orderInfo($_GET['requestId']);
        break;
    case 'update':
        updateRequestOrder();
        break;
    case 'insert':
        newRequestOrder();
        break;
    case 'request_order_all':
        requestOrderAll();

}
function orderInfo($oderId){
    $database = new DatabaseUserInfo();
    $db = $database->connect();

    $order = new Order($db);
    $result = $order->read($oderId, 'requestInfo', 'request_orderId');

    $num = $result->rowCount();

    if($num > 0) {
        $posts_arr = array();
        $posts_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $post_item = array(
                'request_orderid' => $request_orderid,
                'request_userid' => $request_userid,
                'departure_location' => $departure_location,
                'destination_location' => $destination_location,
                'departure_time' => $departure_time,
                'post_time' => $post_time,
                'remarks' => $remarks,
                'available_seats' => $waitlist,
                'available' => $acceotlist,
                'finished' => $finished
            );
            array_push($posts_arr['data'], $post_item);
        }
        echo json_encode($posts_arr['data'][0]);
    }
    else{
        echo json_encode(array('message' => 'No users'));

    }
}



function updateRequestOrder(){
    $database = new DatabaseUserInfo();
    $db = $database->connect();
    $order = new Order($db);

    $input = file_get_contents('php://input');
    $object = json_decode($input);
    print_r($order->updateRequestOrderInfo($object));
    //   print_r($mess);
}
function newRequestOrder(){
    $database = new DatabaseUserInfo();
    $db = $database->connect();
    $order = new Order($db);

    $input = file_get_contents('php://input');
    $object = json_decode($input);
    print_r($order->newOrder($object));
    //   print_r($mess);
}
function requestOrderAll(){
    $database = new DatabaseUserInfo();
    $db = $database->connect();

    $order = new Order($db);
    $result = $order->readAll( 'requestInfo', 'request_orderId');

    $num = $result->rowCount();

    if($num > 0) {
        $posts_arr = array();
        $posts_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $post_item = array(
                'request_orderid' => $request_orderid,
                'request_userid' => $request_userid,
                'departure_location' => $departure_location,
                'destination_location' => $destination_location,
                'departure_time' => $departure_time,
                'post_time' => $post_time,
                'remarks' => $remarks,
                'available_seats' => $waitlist,
                'available' => $acceotlist,
                'finished' => $finished
            );
            array_push($posts_arr['data'], $post_item);
        }
        echo json_encode($posts_arr['data']);
    }
    else{
        echo json_encode(array('message' => 'Nothing'));

    }
}
