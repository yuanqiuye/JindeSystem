<?php

include ("common.php");
include ("jwt.php");
  

$data = json_decode(file_get_contents('php://input'), true);

$user = $data["user"];
$jwt = $data["jwt"];
$file = $data["file"];
$upload_time = $data["upload_time"];
$upload_type = $data["upload_type"];

$return = array(
    "type"=>"upload_jinde",
    "err" => "",
    "user" => $user,
);

function late_csv($file){
    while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
        $SID = $data[10];
        $time = $data[8];
        
    }
}

function bibi_csv($file){

}

function red_csv($file){

}

function leave_call_csv($file){

}

if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 3){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{
    
    if($upload_time == "this_week"){
        $red_time = $date_array[1];
    }else{
        $red_time = $date_array[4];
    }
    $file_data = base64_decode($file);

    switch($upload_type){
        case "late":

    }
    echo $file_data;
}
