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
    "type"=> "student_apply_early_jinde",
    "err" => "",
    "user" => $SID,
    "failed_times" => "",
    "success_location" => ""
);

if(decode_jwt($SID, $jwt) === false || (int)decode_jwt($SID, $jwt) !== 0){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{
    $con -> select_db($db_name);

    $sjp = $con -> prepare("SELECT JID FROM jinde WHERE SID = ? AND finished = 0");
    $sjp -> bind_param("s", $SID);
    $sjp -> execute();
    if($sjp === false){
        die($con->error);
    } 
    $sjpr = $sjp -> get_result();
    $sjp -> close();

    $officecheckp = $con -> prepare("SELECT office, EID FROM event WHERE JID is null");
    if($officecheckp === false){
        $return["failed_times"] = $number;
        echo json_encode($return);
        exit();
    }
    $officecheckp -> execute();
    $officecheckpr = $officecheckp -> get_result();
    $officecheckp -> close();

    while($sjprr = mysqli_fetch_array($sjpr) &&  
    $officecheckprr = mysqli_fetch_array($officecheckpr)
    && $number !== 0){

        $JID = $sjprr["JID"]; 
        $office = $officecheckprr["office"];
        $EID = $officecheckprr["EID"];

        $ep = $con -> prepare("UPDATE event SET JID = ? WHERE EID = ? AND office = ? AND wantday = ? AND wanttime = ?");
        $ep -> bind_param("sssss", $JID, $EID, $office, $nowday, $timeID);
        $ep -> execute();
        if ($ep === false) break;
        $ep -> close();
        $number--;
    }
    $return["failed_times"] = $number;
    $return["success_location"] = $office;

    echo json_encode($return);
}