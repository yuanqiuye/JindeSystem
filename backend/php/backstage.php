<?php
include ("common.php");
include ("jwt.php");
  

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$jwt = $data["jwt"];
$JID = $data["JID"];

$return = array(
    "type"=>"backstage",
    "err" => "",
    "user" => $user
);

if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 3){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{
     $checklength = sizeof($JID);
     for($i = 0; $i < $checklength; $i++){
        $nowJID = $JID[$i];
        $con -> query("UPDATE jinde SET finished = 1 WHERE JID = $nowJID");
     }
     echo json_encode($return);
}