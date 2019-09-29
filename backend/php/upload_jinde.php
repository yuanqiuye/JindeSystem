<?php

include ("common.php");
include ("jwt.php");
  

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$jwt = $data["jwt"];
$file = $_FILES["file"];
$return = array(
    "type"=>"upload_jinde",
    "err" => "",
    "user" => $user,
);

if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 3){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{
    $return["file"] = var_dump($file);
    echo json_encode($return);
}