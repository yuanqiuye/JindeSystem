<?php

include ("common.php");
include ("jwt.php");
  

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$jwt = $data["jwt"];
$file = $data["file"];
$return = array(
    "type"=>"upload_jinde",
    "err" => "",
    "user" => $user,
);
    $file_data = base64_decode($file);
    file_put_contents("test.csv", $file_data);
    echo $file_data;
