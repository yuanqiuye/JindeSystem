<?php
include ("../sql/mysql_connect.php");
include ("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$jwt = $data["jwt"];
$weekID = $data["weekID"];
$timeID = $data["timeID"];
$number = $data["number"];
$nowtime = date("Y-m-d");

$return = array(
    "type"=> "apply_jinde",
    "err" => "",
    "user" => $user
);