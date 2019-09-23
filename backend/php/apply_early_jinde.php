<?php
include ("common.php");
include ("jwt.php");


$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$jwt = $data["jwt"];
$weekID = $data["weekID"];
$timeID = $data["timeID"];
$number = $data["number"];
$r_date = date("Y-m-d");

$return = array(
    "type"=> "apply_early_jinde",
    "err" => "",
    "user" => $user
);

if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 1){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{
    $ar = $con -> prepare("SELECT office FROM teacher WHERE UID = ?");
    $ar -> bind_param("s", $user);
    $ar -> execute();
    $arr = $ar -> get_result();
    $ar -> close();
    $arrow = mysqli_fetch_array($arr);
    $office = $arrow["office"];
    for($i = $number; $i > 0 ; $i--){
        $ar = $con -> prepare("INSERT INTO event (teacher, wantday, wanttime, office , applytime) VALUES (?, ?, ?,?,?)");
        $ar -> bind_param("sssss", $user, $weekID, $timeID, $office,$r_date);
        $ar -> execute();
        $ar -> close();
    }

    echo json_encode($return);

}
