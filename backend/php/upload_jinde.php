<?php

include ("common.php");
include ("jwt.php");
  

$data = json_decode(file_get_contents('php://input'), true);

$user = $data["user"];
$jwt = $data["jwt"];
$file = $data["file"];
$upload_time = $data["upload_time"];
$upload_type = $data["upload_type"];

$return = array(
    "type"=>"upload_jinde",
    "err" => "",
    "user" => $user,
);

$file_data = base64_decode($file);
file_put_contents("/home/jindesys/Desktop/python/late.csv", $file_data);
$path="python ~/Desktop/python/late.py "; //需要注意的是：末尾要加一個空格
$result = passthru($path.$params);
if($result == "complete"){
    echo "true";
}else{
    echo $result;
}
