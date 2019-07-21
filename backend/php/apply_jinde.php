<?php
include ("../sql/mysql_connect.php");
include ("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$jwt = $data["jwt"];
$SID = $data["SID"];
$RID = $data["RID"];
$times = $data["times"];
$applytime = date("Y-m-d");

$return = array(
    "type"=> "apply_jinde",
    "err" => "",
    "user" => $user
);

if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 2){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{
    $con -> select_db("resourse");
    $sd = $con->prepare("SELECT SID FROM student WHERE SID = ?");
    $sd->bind_param('s', $SID);
    $sd->execute();
    $sdr = $sd->get_result();
    $sd -> close();
    if($sdr->num_rows === 0){
        $return["err"] += "找不到" + (string)$SID + "這個學號!";
        echo json_encode($return);
    }else{
        $con -> select_db($db_name);
        $ar = $con -> prepare("INSERT INTO jinde (UID, SID, RID, applytime) VALUES (?, ?, ?, ?)");
        $ar -> bind_param("ssss", $user, $SID, $RID, $applytime);
        $ar -> execute();
        $arr = $ar -> get_result();
        $ar -> close();
        if($arr === false){
            die($con->error);
        }else{
            echo json_encode($return);
        }
    }
    
}