<?php
include ("../sql/mysql_connect.php");
include ("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$jwt = $data["jwt"];
$return = array(
    "type"=>"",
    "err" => "",
    "user" => "",
    "reason" => array(
        "name" => array(

        ),
        "RID" => array(

        )
    )
);

if(decode_jwt($user, $jwt) === false){
    
}