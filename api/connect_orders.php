<?php

// Hearders

header('Access-Control-Allow-Origin: *');
header('Conten-Type: application/json');

include_once '../db_conn/DatabaseUserInfo.php';
include_once '../db_conn/connectOrder.php';
include_once '../db_conn/order.php';


switch ($_GET['view']) {
    case 'confirmed':
        orderConfirmed();
        break;
    case 'deleteConfirmed':
        deleteConfirmed();
        break;
    case 'newPostWaitList':
        postWaitListOrder();
        break;
    case 'newRequestWaitList':
        requestWaitListOrder();
        break;
    case 'deletePostWaitList':
        deletePostWaitList();
        break;
    case 'deleteRequestWaitList':
        deleteRequestWaitList();
        break;
    case 'newPostAndConnect':
        newPostAndConnect();
        break;
    case 'newRequestAndConnect':
        newRequestAndConnect();
        break;
    case 'readPostWaitListForDriver':
        readPostWaitListForDriver($_GET['postOrderId']);
        break;
    case 'readRequestWaitListForPassenger':
        readRequestWaitListForPassenger($_GET['requestOrderId']);
        break;
    case 'readPostWaitListForPassenger':
        readPostWaitListForPassenger($_GET['requestOrderId']);
        break;
    case 'readRequestWaitListForDriver':
        readRequestWaitListForDriver($_GET['postOrderId']);
        break;
    case 'readConfirmedOrderForPassenger':
        readConfirmedOrderForPassenger($_GET['userId']);
        break;
    case 'readUnconfirmedOrderForPassenger':
        readUnconfirmedOrderForPassenger($_GET['userId']);
        break;
    case 'readConfirmedOrderForRequestOrderId':
        readConfirmedOrderForRequestOrderId($_GET['requestOrderId']);
        break;



}
function conn(){
    $database = new DatabaseUserInfo();
    $db = $database->connect();

    $order = new connectOrder($db);
    return $order;
}
function connOrder(){
    $database = new DatabaseUserInfo();
    $db = $database->connect();

    $order = new Order($db);
    return $order;
}
function orderConfirmed(){
    $connectOrder = conn();
    $input = file_get_contents('php://input');
    $object = json_decode($input);
    $connectOrder->newConfirmed($object);

    $order = connOrder();
    $availableSeats = $order->getAvailableSeats($object->postOrderId);
    $peopleNumber = $order->getPeopleNumber($object->requestOrderId);
    $availableSeats -= $peopleNumber;

    $order->setAvailableSeats($object->postOrderId, $availableSeats);
    $order->setAvailableForRequest($object->requestOrderId, 0);

    $connectOrder->deleteWaitList("post_waitlist", $object);
    $connectOrder->deleteWaitList("request_waitlist", $object);


    echo 'success';

}
function postWaitListOrder(){
    $connectOrder = conn();
    $input = file_get_contents('php://input');
    $object = json_decode($input);
    print_r($connectOrder->newWaitList("post_waitlist",$object));
}
function requestWaitListOrder(){
    $connectOrder = conn();
    $input = file_get_contents('php://input');
    $object = json_decode($input);
    print_r($connectOrder->newWaitList("request_waitlist",$object));
}
function deletePostWaitList(){
    $connectOrder = conn();
    $input = file_get_contents('php://input');
    $object = json_decode($input);
    print_r($connectOrder->deleteWaitList("post_waitlist",$object));
}
function deleteRequestWaitList(){
    $connectOrder = conn();
    $input = file_get_contents('php://input');
    $object = json_decode($input);
    print_r($connectOrder->deleteWaitList("request_waitlist",$object));
}
function deleteConfirmed(){
    $connectOrder = conn();
    $input = file_get_contents('php://input');
    $object = json_decode($input);
    $connectOrder->deleteConfirmedOrder($object);

    $order = connOrder();
    $availableSeats = $order->getAvailableSeats($object->postOrderId);
    $peopleNumber = $order->getPeopleNumber($object->requestOrderId);
    $availableSeats += $peopleNumber;

    $order->setAvailableSeats($object->postOrderId, $availableSeats);
    $order->setAvailableForRequest($object->requestOrderId, 1);


    echo "success";
}
function newPostAndConnect(){
    $database = new DatabaseUserInfo();
    $db = $database->connect();
    $order = new Order($db);
    $input = file_get_contents('php://input');
    $object = json_decode($input);

    $postId = $order->newPostOrder($object);

    $info = '{"postOrderId":"'.$postId.'", "requestOrderId":"'.$_GET['requestOrderId'].'", "userId":"'.$object->post_userid.'"}';
    $connectOrder = conn();
    print_r($connectOrder->newWaitList("request_waitlist",json_decode($info)));
}
function newRequestAndConnect(){
    $order = connOrder();
    $input = file_get_contents('php://input');
    $object = json_decode($input);

    $requestId = $order->newRequestOrder($object);

    $info = '{"requestOrderId":"'.$requestId.'", "postOrderId":"'.$_GET['postOrderId'].'", "userId":"'.$object->request_userid.'"}';
    $connectOrder = conn();
    print_r($connectOrder->newWaitList("post_waitlist",json_decode($info)));
}
function readPostWaitListForDriver($postOrderId){
    $connectOrder = conn();
    $result = $connectOrder->readWaitList("request_orderid","post_waitlist",$postOrderId, "post_orderid" );
    $order = connOrder();
    $availableSeats = $order->getAvailableSeats($postOrderId);
    packResultForRequest($result,$availableSeats, 1);
}
function readRequestWaitListForPassenger($requestOrderId)
{
    $connectOrder = conn();
    $result = $connectOrder->readWaitList("post_orderid", "request_waitlist", $requestOrderId, "request_orderid");
    $order = connOrder();
    $peopleNumber = $order->getPeopleNumber($requestOrderId);
    packResultForPost($result,$peopleNumber, 1);
}
function readPostWaitListForPassenger($requestOrderId){
    $connectOrder = conn();
    $result = $connectOrder->readWaitList("post_orderid", "post_waitlist", $requestOrderId, "request_orderid");
    $order = connOrder();
    $peopleNumber = $order->getPeopleNumber($requestOrderId);
    packResultForPost($result,$peopleNumber, 1);
}
function readRequestWaitListForDriver($postOrderId){
    $connectOrder = conn();
    $result = $connectOrder->readWaitList("request_orderid", "request_waitlist", $postOrderId, "post_orderid");
    $order = connOrder();
    $availableSeats = $order->getAvailableSeats($postOrderId);
    packResultForRequest($result,$availableSeats, 1);
}
function readConfirmedOrderForPassenger($userId){
    $connectOrder = conn();
    $result = $connectOrder->readConfirmedList($userId);
    //print_r($result->rowCount());
    packResultForRequest($result,100, 1);
}
function readUnconfirmedOrderForPassenger($userId){
    $connectOrder = conn();
    $result = $connectOrder->readUnconfirmedList($userId);
    packResultForRequest($result,100, 1);
}
function readConfirmedOrderForRequestOrderId($requestOrderId){
    $connectOrder = conn();
    $result = $connectOrder->readConfirmedOrderForRequestOrderId($requestOrderId);
    packResultForPost($result,-1, 0);
}
function packResultForRequest($result,$availableSeats, $isList){
    $order = connOrder();
    $num = $result->rowCount();
    $result_arr = array();
    for ($i = 0; $i < $num; $i++) {

        $item = $result->fetch(PDO::FETCH_ASSOC)['request_orderid'];
        //print_r($item);
        $r = $order->read($item, 'requestInfo', 'request_orderId');
        while ($row = $r->fetch(PDO::FETCH_ASSOC)) {
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
            if ($post_item['people_number'] <= $availableSeats) {
                array_push($result_arr, $post_item);
            }
        }
        //print_r($result_arr);
    }
    if (count($result_arr) == 0){
        echo "";
    }
    else{
        echo json_encode($result_arr);
    }

}
function packResultForPost($result,$peopleNumber,$isList){
    $order = connOrder();
    $num = $result->rowCount();
    $result_arr = array();
    for ($i = 0; $i < $num; $i++) {

        $item = $result->fetch(PDO::FETCH_ASSOC)['post_orderid'];
        //print_r($item);
        $r = $order->read($item, 'postInfo', 'post_orderId');
        while ($row = $r->fetch(PDO::FETCH_ASSOC)) {
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
            if ($peopleNumber <= $post_item['available_seats']) {
                array_push($result_arr, $post_item);
            }
        }
        //print_r($result_arr);
    }
    if (count($result_arr) == 0){
        echo "";
    }
    else{
        if ($isList) {
            echo json_encode($result_arr);
        }
        else{
            echo json_encode($result_arr[0]);
        }
    }

}
