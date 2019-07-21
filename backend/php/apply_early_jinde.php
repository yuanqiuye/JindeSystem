<?php
include ("../sql/mysql_connect.php");
include ("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$jwt = $data["jwt"];
$weekID = $data["weekID"];
$timeID = $data["timeID"];
$number = $data["number"];

$return = array(
    "type"=> "apply_early_jinde",
    "err" => "",
    "user" => $user
);

if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 1){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{
    
}
