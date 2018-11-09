<?php

// Hearders

header('Access-Control-Allow-Origin: *');
header('Conten-Type: application/json');

include_once '../db_conn/DatabaseUserInfo.php';
include_once '../db_conn/order.php';


switch ($_GET['view']) {
    case 'confirmed':
        o
}