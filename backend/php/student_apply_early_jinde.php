<?php
include("../sql/mysql_connect.php");
include("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$jwt = $data["jwt"];
$SID = $data["user"];
$timeID = $data["timeID"];
$nowday = date("w"); //Sunday, 0~6
$nowdate = date("Y-m-d");
$number="1";

$return = array(
    "type" => "student_apply_early_jinde",
    "err" => "",
    "user" => $SID,
    "failed_times" => "",
    "success_location" => ""
);

if (decode_jwt($SID, $jwt) === false || (int) decode_jwt($SID, $jwt) !== 0) {
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
} else {

    $con->select_db("resourse");
    if($timeID=="1"){
        $checkdo = $con-> query("SELECT applyday1 FROM student WHERE SID = $SID");
        $checkdor = mysqli_fetch_array($checkdo);
        if($checkdor["applyday1"] === $nowdate){
            $return["failed_times"] = $number;
            echo json_encode($return);
            exit();
        }
    }
    else if($timeID=="2"){
        $checkdo = $con-> query("SELECT applyday2 FROM student WHERE SID = $SID");
        $checkdor = mysqli_fetch_array($checkdo);
        if($checkdor["applyday2"] === $nowdate){
            $return["failed_times"] = $number;
            echo json_encode($return);
            exit();
        }
    }
        
        
    $con->select_db($db_name);

    $sjp = $con->prepare("SELECT JID FROM jinde WHERE SID = ? AND finished = 0 
    AND NOT EXISTS (SELECT * FROM event WHERE jinde.JID = event.JID)");
    $sjp->bind_param("s", $SID);
    $sjp->execute();
    if ($sjp === false) {
        die($con->error);
    }
    $sjpr = $sjp->get_result();
    $sjp->close();

    $officecheckp = $con->prepare("SELECT office, EID FROM event WHERE JID is null AND wantday = ? AND wanttime = ?");
    if ($officecheckp === false) {
        $return["failed_times"] = $number;
        echo json_encode($return);
        exit();
    }
    $officecheckp -> bind_param("ss", $nowday, $timeID);
    $officecheckp->execute();
    $officecheckpr = $officecheckp->get_result();
    $officecheckp->close();
    $office = "";

    while ($sjprr = mysqli_fetch_array($sjpr)) {
        if ($officecheckprr = mysqli_fetch_array($officecheckpr)) {
            if ($number !== 0) {
                $JID = $sjprr["JID"];
                $office = $officecheckprr["office"];
                $EID = $officecheckprr["EID"];
       
                $ep = $con->prepare("UPDATE event SET JID = ? WHERE EID = ? AND office = ? AND wantday = ? AND wanttime = ?");
                $ep->bind_param("sssss", $JID, $EID, $office, $nowday, $timeID);
                $ep->execute();
                $epr = $ep->get_result();
                if ($ep === false || mysqli_affected_rows($con) === 0) break;
                $ep->close();
                $number--;
            } else {
                break;
            }
        } else {
            break;
        }
    }

    $return["failed_times"] = $number;
    $return["success_location"] = $office;
    
    $con->select_db("resourse");
    if($timeID=="1"){
        $dp = $con-> prepare("UPDATE student SET applyday1 = ? WHERE SID = $SID");
        $dp -> bind_param("s", $nowdate);
        $dp -> execute();
        $dp -> close();
        echo json_encode($return);
    }
    else if($timeID=="2"){
        $dp = $con-> prepare("UPDATE student SET applyday2 = ? WHERE SID = $SID");
        $dp -> bind_param("s", $nowdate);
        $dp -> execute();
        $dp -> close();
        echo json_encode($return);
    }
        
}
