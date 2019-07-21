<?php
include ("../sql/mysql_connect.php");
include ("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$jwt = $data["jwt"];
$SID = $data["user"];
$number = $data["number"];
$timeID = $data["timeID"];

$return = array(
    "type"=> "apply_jinde",
    "err" => "",
    "user" => $user,
    "failed_times" => "",
    "success_location" => ""
);

