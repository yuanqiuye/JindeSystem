<?php
include ("common.php");
include ("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$jwt = $data["jwt"];
$SID = get_SID($data["class_number"]);

if(decode_jwt($user,$jwt) === false || (int)decode_jwt($user, $jwt) < 3){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{
    $sjinde = $con->prepare("SELECT JID, applytime, RID FROM jinde WHERE SID = ? 
    AND finished = 0 
    AND applytime BETWEEN '$date_array[3]' AND '$date_array[4]'");
    $sjinde->bind_param("s", $SID);
    $sjinde->execute();
    $sjinder = $sjinde->get_result();
    $sjinde->close();

    $applytimearray = array(

    );

    $reasonarray = array(

    );

    $JIDarray = array(

    );

    $flag = false;

    while($row=mysqli_fetch_array($sjinder)){
        $flag = true;
        $RID = $row["RID"];
        $reasonp = $con -> prepare("SELECT description FROM reason WHERE RID = ?");
        $reasonp -> bind_param("s", $RID);
        $reasonp -> execute();
        $reasonresult = $reasonp -> get_result();
        $reasonp -> close(); 
        $reasonrow = mysqli_fetch_array($reasonresult);

        $reason = $reasonrow["description"];
        $applytime = $row["applytime"];
        $JID = $row["JID"];

        array_push($reasonarray, $reason);
        array_push($applytimearray, $applytime);
        array_push($JIDarray, $JID);
    }

    if($flag === false){
        $return["err"] = "查無此班際座號！";
        echo json_encode($return);
        exit();
    }
    $return["reason"] = $reasonarray;
    $return["applytime"] = $applytimearray;
    $return["JID"] = $JIDarray;
    $return["SID"] = $SID;

    echo json_encode($return);
    }