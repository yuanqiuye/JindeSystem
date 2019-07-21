<?php
include ("../sql/mysql_connect.php");
include ("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$password = $data["password"];
$return = array(
    "type"=>"",
    "err" => "",
    "user" => "",
    "member" => "",
    "jwt" => "");

$con -> select_db("resourse");
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
    $jwt = encode_jwt($user, 10);

    $return["user"] = $user;
    $return["member"] = "student";
    $return["jwt"] = $jwt;
    $return["type"] = "login";
    $return["err"] = "";

    $con -> select_db($db_name);
    $sjinde = $con->prepare("SELECT applytime, RID FROM jinde WHERE SID = ?");
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
        $con -> select_db("resourse");
        $reasonresult = $con -> query("SELECT description FROM reason WHERE RID = $RID");
        $reasonrow = mysqli_fetch_array($reasonresult);

        $reason = $reasonrow["description"];
        $applytime = $row["applytime"];

        array_push($reasonarray, $reason);
        array_push($reasonarray, $applytime);
    }

    $return["reason"] = $reasonarray;
    $return["applytime"] = $applytimearray;

    echo json_encode($return);
}else if($tdr->num_rows > 0){
    $con -> select_db("resourse");
    $tlevelresult = $con -> query("SELECT level FROM teacher WHERE UID = $user");
    $tlevelrow = mysqli_fetch_array($tlevelresult);

    $tlevel = $tlevelrow["level"];
    $jwt = encode_jwt($user, 10);

    $return["user"] = $user;
    $return["member"] = "teacher";
    $return["jwt"] = $jwt;
    $return["type"] = "login";
    $return["err"] = "";
    $return["level"] = $tlevel;

    echo json_encode($return);
}else{
    $return["err"] = "帳號或密碼錯誤!";
    echo json_encode($return);
}

