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
    "user" => $user,
    "failed_SID" =>array()
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
            array_push($return["failed_SID"],(string)$nowSID);
        }else{
            $nowtimes = $times[$i];
            $con -> select_db($db_name);
            for($ii = 0; $ii < $nowtimes ; $ii++){
                $result = $con -> query("SELECT JID FROM jinde WHERE (SID = $nowSID && finished = 0)");
                $JIDr = mysqli_fetch_array($result,MYSQLI_NUM);
                $ar = $con -> prepare("UPDATE jinde SET finished = 1 where JID = ?");
                $ar -> bind_param("s", $JIDr[0]);
                $ar -> execute();
                $ar -> close();
            }
        }
    }
    echo json_encode($return);
}
