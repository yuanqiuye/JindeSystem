<?php

include ("../sql/mysql_connect.php");
include ("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$password = $data["password"];
$return = array(
    "type"=>"check_inform",
    "err" => "",
    "user" => $user,
    "SID" => [],
    "EID" => []
);

if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 1){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{
    $con -> select_db($db_name);
    $cr = $con -> query("SELECT EID, JID FROM event WHERE teacher = $user");
    while($crr = mysqli_fetch_array($cr)){
        $EID = $crr["EID"];
        $JID = $crr["JID"];
        $sr = $con -> query("SELECT SID FROM jinde WHERE JID = $JID");
        $srr = mysqli_fetch_array($sr);
        $SID = $srr["SID"];
        array_push($return["SID"], $SID);
        array_push($return["EID"], $EID);
    }

    echo json_encode($return);
}
