<?php

include ("../sql/mysql_connect.php");
include ("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$jwt = $data["jwt"];
$SID = $data["SID"];
$times = $data["times"];
$return = array(
    "type"=>"huge_check_jinde",
    "err" => "",
    "user" => $user
);

if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 3){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{
    $checklength = sizeof($SID);
    for($i = 0; $i < $checklength; $i++){
        $nowSID = $SID[$i];
        $con -> select_db("resourse");
        $SIDr = $con -> query("SELECT SID FROM student WHERE SID = $nowSID");
        if ($SIDr->num_rows < 1){
            $return["err"] += "找不到學號" + $nowSID + "!\n";
        }else{
            $nowtimes = $times[$i];
            //提出ＪＩＤ
            for($i = 0; $i < $nowtimes; $i++){
                $con -> query("");
                // check if NO JID or times is none
            }
        }

    }
    
}