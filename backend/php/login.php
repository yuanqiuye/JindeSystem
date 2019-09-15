<?php
use function PHPSTORM_META\type;

include ("../sql/mysql_connect.php");
include ("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$password = $data["password"];
$return = array(
    "type"=>"login",
    "err" => "",
    "user" => "",
    "member" => "",
    "jwt" => "",
    "status" => sizeof($jinde_number));

$sd = $con->prepare("SELECT SID FROM student WHERE SID = ? AND pwd = ?");
$sd->bind_param('ss', $user, $password);
$sd->execute();
$sdr = $sd->get_result();
$sd->close();

$td = $con->prepare("SELECT UID, level FROM teacher WHERE UID = ? AND pwd = ?");
$td->bind_param("ss", $user, $password);
$td->execute();
$tdr = $td->get_result();
$td->close();

if($sdr->num_rows > 0){
    $jwt = encode_jwt($user, 10, "0");

    $return["user"] = $user;
    $return["member"] = "student";
    $return["jwt"] = $jwt;
    $return["err"] = "";

    $sjinde = $con->prepare("SELECT applytime, RID FROM jinde WHERE SID = ? AND finished = 0 AND applytime BETWEEN  '$date_array[3]' AND '$date_array[4]'");
    $sjinde->bind_param("s", $user);
    $sjinde->execute();
    $sjinder = $sjinde->get_result();
    $sjinde->close();

    $applytimearray = array(

    );

    $reasonarray = array(

    );

    while($row=mysqli_fetch_array($sjinder)){
        $RID = $row["RID"];
        $reasonp = $con -> prepare("SELECT description FROM reason WHERE RID = ?");
        $reasonp -> bind_param("s", $RID);
        $reasonp -> execute();
        $reasonresult = $reasonp -> get_result();
        $reasonp -> close(); 
        $reasonrow = mysqli_fetch_array($reasonresult);

        $reason = $reasonrow["description"];
        $applytime = $row["applytime"];

        array_push($reasonarray, $reason);
        array_push($applytimearray, $applytime);
    }

    $return["reason"] = $reasonarray;
    $return["applytime"] = $applytimearray;

    echo json_encode($return);
}else if($tdr->num_rows > 0){
    $tlevelresultp = $con -> prepare("SELECT level FROM teacher WHERE UID = ?");
    $tlevelresultp->bind_param("s", $user);
    $tlevelresultp->execute();
    $tlevelresult = $tlevelresultp->get_result();

    if($tlevelresult === false){
        die(printf($con -> error));
    }
    $tlevelrow = mysqli_fetch_array($tlevelresult);

    $tlevel = $tlevelrow["level"];
    $jwt = encode_jwt($user, 10, $tlevel);

    $return["user"] = $user;
    $return["member"] = "teacher";
    $return["jwt"] = $jwt;
    $return["err"] = "";
    $return["level"] = $tlevel;

    echo json_encode($return);
}else{
    $return["err"] = "帳號或密碼錯誤!";
    echo json_encode($return);
}

