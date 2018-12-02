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
        break;
    case 'location':
        requestOrderBatch($_GET['departure'], $_GET['destination']);
        break;
    case 'delete':
        deteleRequestOrder();
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
    $result = $order->read($oderId, 'requestInfo', 'request_orderId');

    packResult($result, 0);
}



function updateRequestOrder(){
    $order = conn();

    $input = file_get_contents('php://input');
    $object = json_decode($input);
    print_r($order->updateRequestOrderInfo($object));
    //   print_r($mess);
}
function newRequestOrder(){
    $order = conn();

    $input = file_get_contents('php://input');
    $object = json_decode($input);
    print_r($order->newRequestOrder($object));
    //   print_r($mess);
}
function requestOrderAll(){
    $order = conn();
    $result = $order->readAll( 'requestInfo');

    packResult($result, 1);
}

function requestOrderBatch($departure, $destination){
    $order = conn();
    $result = $order->readBatch($departure, $destination, 'requestInfo');

    packResult($result, 1);
}
function deteleRequestOrder(){
    $order = conn();

    $input = file_get_contents('php://input');
    $object = json_decode($input);
    //print_r($object);
    print_r($order->deleteRequestOrder($object->requestId));

}
function activetiedOrder($userId){
    $order = conn();
    $result = $order->activitedOrder("requestInfo","request_userId", $userId);

    packResult($result, 1);
}
function matchOrder($st, $et, $dep, $des){
    $order = conn();
    $result = $order->matchOrder("requestInfo", $st, $et, $dep, $des);

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
                'request_orderid' => $request_orderid,
                'request_userid' => $request_userid,
                'departure_location' => $departure_location,
                'destination_location' => $destination_location,
                'departure_time' => $departure_time,
                'post_time' => $post_time,
                'remarks' => $remarks,
                'people_number' => $people_number,
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