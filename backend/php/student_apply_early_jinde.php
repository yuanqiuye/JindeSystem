<?php
include ("../sql/mysql_connect.php");
include ("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$jwt = $data["jwt"];
$SID = $data["user"];
$number = $data["number"];
$timeID = $data["timeID"];
$nowday = date("w"); //Sunday, 0~6

$return = array(
    "type"=> "apply_jinde",
    "err" => "",
    "user" => $SID,
    "failed_times" => "",
    "success_location" => ""
);

if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) !== 0){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{
    $con -> select_db($db_name);

    $sjp = $con -> prepare("SELECT JID FROM jinde WHERE SID = ? AND finished = 0");
    $sjp = bind_param("s", $SID);
    $sjp -> execute();
    $sjpr = $sjp -> get_result();
    $sjp -> close();

    $officecheckp = $con -> prepare("SELECT office FROM event WHERE JID = null");
    $officecheckp -> execute();
    $officecheckpr = $officecheckp -> get_result();
    $officecheckp -> close();
    $officecheckprr = mysqli_fetch_array($officecheckpr);
    $office = $officecheckprr["office"];

    while($sjpr = mysqli_fetch_array($sjpr) && $number !== 0){
        $ep = $con -> prepare("UPDATE event SET JID = ? WHERE JID = NULL AND office = ?");
        if ($ep === false) break;
        $notsuccess--;
        $ep -> bind_param("ss", $sjpr["JID"], $office);
        $ep -> execute();
        $ep -> close();
        $number--;
    }
    $return["failed_times"] = $number;
    $return["success_location"] = $office;

    echo json_encode($return);
}