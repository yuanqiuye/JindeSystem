<?php
include("../sql/mysql_connect.php");
include("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$jwt = $data["jwt"];
$SID = $data["user"];
$number = $data["number"];
$timeID = $data["timeID"];
$nowday = date("w"); //Sunday, 0~6
$nowdate = date('Y-m-d');

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
    $checkdo = $con-> query("SELECT applyday FROM student WHERE SID = $SID");
    $checkdor = mysqli_fetch_array($checkdo);
    if($checkdor["applyday"] === $nowdate){
        $return["failed_times"] = $number;
        echo json_encode($return);
        exit();
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

    $officecheckp = $con->prepare("SELECT office, EID FROM event WHERE JID is null");
    if ($officecheckp === false) {
        $return["failed_times"] = $number;
        echo json_encode($return);
        exit();
    }
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
                if ($ep === false) break;
                if (mysqli_affected_rows($con) === 0) {
                    die("no");
                }
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
    $con-> query("UPDATE student SET applyday = $nowdate WHERE SID = $SID");
    echo json_encode($return);
}
