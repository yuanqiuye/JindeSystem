<?php

include ("common.php");
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
    "failed_SID" =>array(),
    "non_jinde_SID" =>array(),
    "non_jinde_times" => array()
);

if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 3){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{
    $checklength = sizeof($SID);
    for($i = 0; $i < $checklength; $i++){
        $nowSID = (int)get_SID($SID[$i]);
        $SIDr = $con -> query("SELECT SID FROM student WHERE SID = $nowSID");
        if ($SIDr->num_rows < 1){
            array_push($return["failed_SID"],(string)$SID[$i]);
        }else{
            $nowtimes = $times[$i];
            $sp = $con -> prepare("SELECT JID FROM jinde WHERE 
            (SID = ? && finished = 0 && access_flag = 1) 
            AND applytime BETWEEN '$date_array[3]' AND '$date_array[4]'");

            $sp -> bind_param("s",$nowSID);
            $sp -> execute();
            $spr = $sp -> get_result();
            $sp -> close();

            $JID = array();

            while($row = mysqli_fetch_array($spr)){
                array_push($JID,$row["JID"]);
            }
            
            $non_jinde_times = $nowtimes - sizeof($JID);

            if($non_jinde_times > 0){
                array_push($return["non_jinde_SID"],(string)$SID[$i]);
                array_push($return["non_jinde_times"],(string)$non_jinde_times);
                $loop_times = sizeof($JID);
            }else{
                $loop_times = $nowtimes;
            }

            array_push($return,$JID);
            array_push($return,$loop_times);

            for($ii = 0; $ii < $loop_times ; $ii++){
                $nowJID = $JID[$ii];
                $con -> query("UPDATE jinde SET finished = 1 where JID = $nowJID");
            }
        }
    }
    
    echo json_encode($return);
}
