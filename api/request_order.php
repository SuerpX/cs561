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


}
function orderInfo($oderId){
    $database = new DatabaseUserInfo();
    $db = $database->connect();

    $order = new Order($db);
    $result = $order->read($oderId, 'requestInfo', 'request_orderId');

    packResult($result, 0);
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
    print_r($order->newRequestOrder($object));
    //   print_r($mess);
}
function requestOrderAll(){
    $database = new DatabaseUserInfo();
    $db = $database->connect();

    $order = new Order($db);
    $result = $order->readAll( 'requestInfo');

    packResult($result, 1);
}

function requestOrderBatch($departure, $destination){
    $database = new DatabaseUserInfo();
    $db = $database->connect();

    $order = new Order($db);
    $result = $order->readBatch($departure, $destination, 'requestInfo');

    packResult($result, 1);
}
function deteleRequestOrder(){
    $database = new DatabaseUserInfo();
    $db = $database->connect();
    $order = new Order($db);

    $input = file_get_contents('php://input');
    $object = json_decode($input);
    //print_r($object);
    print_r($order->deleteRequestOrder($object->requestId));

}
function activetiedOrder($userId){
    $database = new DatabaseUserInfo();
    $db = $database->connect();

    $order = new Order($db);
    $result = $order->activitedOrder("requestInfo","request_userId", $userId);

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
                'post_orderid' => $request_orderid,
                'post_userid' => $request_userid,
                'departure_location' => $departure_location,
                'destination_location' => $destination_location,
                'departure_time' => $departure_time,
                'post_time' => $post_time,
                'remarks' => $remarks,
                'people_number' => $people_number,
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