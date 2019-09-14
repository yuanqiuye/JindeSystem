<?php

function check_access_flag($SID){
    include("../sql/mysql_connect.php");
    $sjinde = $con -> prepare("SELECT JID FROM jinde WHERE SID = ? AND finished = 0 
    AND NOT EXISTS (SELECT * FROM jinde WHERE jinde.EID = 'g1')
    AND applytime BETWEEN '$date_array[3]' AND '$date_array[4]'");
    $sjinde->bind_param("s", $SID);
    $sjinde->execute();
    $sjinder = $sjinde->get_result();
    $sjinde->close();

    if(sizeof($sjinder) >= 3){
        for($i = 0; $i < sizeof($sjinder); $i++){
            $nowJID = $sjinder[$i];
            $con ->  query("UPDATE jinde SET access_flag = 0 WHERE JID = $nowJID");
        }
    }else{
        for($i = 0; $i < sizeof($sjinder); $i++){
            $nowJID = $sjinder[$i];
            $con ->  query("UPDATE jinde SET access_flag = 1 WHERE JID = $nowJID");
        }
    }
}

$result = $con -> query("SELECT check_date FROM system_inform WHERE type = 'access_flag'");

$checkdate = mysqli_fetch_array($result);

if(sizeof($checkdate) == 0){
    $result = $con -> query("SELECT SID FROM student");
    $SID = mysqli_fetch_array($result);
    for($i = 0; $i < sizeof($SID); $i++){
        check_access_flag($SID[$i]);
    }
}