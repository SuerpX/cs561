<?php
	$hostname = "oniddb.cws.oregonstate.edu";
	$database_name = "hezhi-db";
	$database_password = "J3NL61BXyBFGtxBV";
	$database_username  = "hezhi-db";
	$link = mysqli_connect($hostname, $database_name, $database_password, $database_username);
	if(!$link){
		echo "Fail to conntect!";
		exit;
	}else{
		echo "success to conntect!";
	}

?>