<?php
include ("../sql/mysql_connect.php");
include ("jwt.php");
include ("check_access_flag.php");

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$jwt = $data["jwt"];
$EID = $data["EID"];

$return = array(
    "type"=>"check_early_jinde",
    "err" => "",
    "user" => $user
);

if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 1){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{
     $checklength = sizeof($EID);
     for($i = 0; $i < $checklength; $i++){
        $nowEID = $EID[$i];
        $con -> query("UPDATE event SET finished = 1 WHERE EID = $nowEID");
        $JIDr = $con -> query("SELECT JID FROM event WHERE EID = $nowEID");
        $JIDrr = mysqli_fetch_array($JIDr);
        $nowJID = $JIDrr["JID"];
        $con ->  query("UPDATE jinde SET finished = 1 WHERE JID = $nowJID");
     }
     echo json_encode($return);
}