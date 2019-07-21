<?php
include ("../sql/mysql_connect.php");
include ("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$jwt = $data["jwt"];
$weekID = $data["weekID"];
$timeID = $data["timeID"];
$number = $data["number"];

$return = array(
    "type"=> "apply_early_jinde",
    "err" => "",
    "user" => $user
);

if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 1){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{
    $con -> select_db("resourse");
    $ar = $con -> prepare("SELECT office FROM teacher WHERE UID = ?");
    $ar -> bind_param("s", $user);
    $ar -> execute();
    $arr = $ar -> get_result();
    $ar -> close();
    $arrow = mysqli_fetch_array($arr);
    $office = $arrow["office"];
    $con -> select_db($db_name);
    for($i = $number; $i >= 0 ; $i--){
        $ar = $con -> prepare("INSERT INTO event (teacher, wantday, wanttime, office) VALUES (?, ?, ?,?)");
        $ar -> bind_param("ssss", $user, $weekID, $timeID, $office);
        $ar -> execute();
        $ar -> close();
    }

    echo json_encode($return);

}
