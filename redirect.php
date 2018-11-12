<?php

$ticket = $_SERVER["QUERY_STRING"];
$osuhtrl = 'https://login.oregonstate.edu/idp/profile/cas/serviceValidate';
$requestUrl = $osuhtrl."?".$ticket.'&service=http://web.engr.oregonstate.edu/~hezhi/redirect.php';

$opts = array(
    'http'=>array(
        'method'=>"GET",
        'timeout'=>60,
    )
);
$context = stream_context_create($opts);

$data = file_get_contents($requestUrl, false, $context);

$p = xml_parser_create();
xml_parse_into_struct($p, $data, $data, $index);
xml_parser_free($p);

if($data[3][tag] == "CAS:AUTHENTICATIONSUCCESS"){
    echo "Success!";


    $od = null;
    $ln = null;
    $fn = null;
    $em = null;

    foreach ($data as $value){
        if($value['tag'] == "CAS:USER"){
            $od = $value['value'];
        }
        if($value['tag'] == "CAS:LASTNAME"){
            $ln = $value['value'];
        }
        if($value['tag'] == "CAS:FIRSTNAME"){
            $fn = $value['value'];
        }
        if($value['tag'] == "CAS:EMAIL"){
            $em = $value['value'];
        }

    }
    queryAndInsert($od, $fn, $ln, $em);
    sleep(1);

}
else{
    echo "fail to log in.";
}

function queryAndInsert($onid, $firstname, $lastname, $email){
    try {
        $pdo = new PDO("mysql:host=oniddb.cws.oregonstate.edu;dbname=hezhi-db", "hezhi-db", "J3NL61BXyBFGtxBV");

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM userInfo WHERE userId='".$onid."' limit 1";
        $result = $pdo->query($query);
        if(!$result->rowCount()){
            $insert = "INSERT INTO `userInfo` (`userId` ,`firstname`,`lastname`,`email`)VALUES (:userId, :firstname, :lastname, :email)";
            $stmt = $pdo->prepare($insert);
            $stmt->execute(array(':userId'=>$onid,':firstname'=>$firstname, ':lastname'=>$lastname,':email'=>$email));
            echo $pdo->lastinsertid();
        }

    }catch (PDOException $exception){
        echo $exception;
    }
}

?>

<html>
<head>
    <script type="text/javascript">


        var userInfo = <?php echo json_encode($data);?>;
        if (userInfo[1]['tag'] == "CAS:AUTHENTICATIONSUCCESS"){
            //alert("success");
            for(i = 0; i < userInfo.length; i++){
                if (userInfo[i]['tag'] == "CAS:USER") {
                 //   alert(userInfo[i]['value']);
                    localStorage.setItem("currentUserInfo", userInfo[i]['value']);
                    window.location.replace("http://web.engr.oregonstate.edu/~hezhi/profile.html");
                    break;
                }
            }

        }


    </script>
</head>
<body>
</body>
</html>