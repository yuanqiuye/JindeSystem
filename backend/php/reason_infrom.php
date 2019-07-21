<?php
include ("../sql/mysql_connect.php");
include ("jwt.php");

$data = json_decode(file_get_contents('php://input'), true);
$user = $data["user"];
$jwt = $data["jwt"];
$return = array(
    "type"=>"reason_inform",
    "err" => "",
    "user" => $user,
    "reason" => array(
        "name" => array(

        ),
        "RID" => array(

        )
    )
);

if(decode_jwt($user, $jwt) === false){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";

    echo json_encode($return);
}else{
    $reasonresult = $con -> query("SELECT * FROM reason");
    while($reasonrow = mysqli_fetch_array($reasonresult)){
        array_push($return["reason"]["name"], $reasonrow["description"]);
        array_push($return["reason"]["RID"], $reasonrow["RID"]);
    }

    echo json_encode($return);

}