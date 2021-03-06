<?php

include ("common.php");
include ("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$jwt = $data["jwt"];
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
    $cp = $con -> prepare("SELECT EID, JID FROM event WHERE teacher = ? AND finished = 0 AND JID IS NOT NULL 
    AND applytime BETWEEN '$date_array[0]' AND '$date_array[1]'");
    $cp -> bind_param("s", $user);
    $cp -> execute();
    $cpr = $cp -> get_result();
    $cp -> close();
    while($cprr = mysqli_fetch_array($cpr)){
        $EID = $cprr["EID"];
        $JID = $cprr["JID"];
        $sr = $con -> query("SELECT SID FROM jinde WHERE JID = $JID");
        $srr = mysqli_fetch_array($sr);
        $SID = $srr["SID"];
        $JID = get_classnum($SID);
        
        array_push($return["SID"], $JID);
        array_push($return["EID"], $EID);
    }

    echo json_encode($return);
}
