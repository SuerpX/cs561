<?php
/*$data = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<cas:serviceResponse xmlns:cas=\"http://www.yale.edu/tp/cas\">
    <cas:authenticationSuccess>
        <cas:user>linzhe</cas:user>
        <cas:attributes>
            <cas:commonName>Lin, Zhengxian</cas:commonName>
            <cas:firstname>Zhengxian</cas:firstname>
            <cas:osuprimarymail>linzhe@oregonstate.edu</cas:osuprimarymail>
            <cas:eduPersonAffiliation>student</cas:eduPersonAffiliation>
            <cas:eduPersonAffiliation>member</cas:eduPersonAffiliation>
            <cas:osupidm>3493531</cas:osupidm>
            <cas:givenName>Zhengxian</cas:givenName>
            <cas:osuuid>61646466773</cas:osuuid>
            <cas:lastname>Lin</cas:lastname>
            <cas:uid>linzhe</cas:uid>
            <cas:eduPersonPrimaryAffiliation>student</cas:eduPersonPrimaryAffiliation>
            <cas:UDC_IDENTIFIER>139467D1A27DFFF674362B400EC26579</cas:UDC_IDENTIFIER>
            <cas:surname>Lin</cas:surname>
            <cas:eduPersonPrincipalName>linzhe@oregonstate.edu</cas:eduPersonPrincipalName>
            <cas:fullname>Lin, Zhengxian</cas:fullname>
            <cas:email>linzhe@oregonstate.edu</cas:email>
        </cas:attributes>
    </cas:authenticationSuccess>
</cas:serviceResponse>
";
example:
$data[5]['value']

2:onid, 7: firstname, 9:email, 21:last name
*/
$ticket = $_SERVER["QUERY_STRING"];
$osuhtrl = 'https://login.oregonstate.edu/idp/profile/cas/serviceValidate';
$requestUrl = $osuhtrl."?".$ticket.'&service=http://web.engr.oregonstate.edu/~hezhi/loging_in.php';

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
    echo "success!";


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
    echo $fn;
    queryAndInsert($od, $fn, $ln, $em);
    
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
            echo "(new guy)";
            $insert = "INSERT INTO `userInfo` (`userId` ,`firstname`,`lastname`,`email`)VALUES (:userId, :firstname, :lastname, :email)";
            $stmt = $pdo->prepare($insert);
            $stmt->execute(array(':userId'=>$onid,':firstname'=>$firstname, ':lastname'=>$lastname,':email'=>$email));
            echo $pdo->lastinsertid();
        }
        else{
            echo "(old guy)";
        }

    }catch (PDOException $exception){
        echo $exception;
    }
}

