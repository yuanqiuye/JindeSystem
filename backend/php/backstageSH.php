<?php
//ini_set('display_errors','off');
include ("../sql/mysql_connect.php");
include ("jwt.php");
/*$data = json_decode(file_get_contents('php://input'), true);
if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 3){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{*/
	$SID=$_POST["SID"];
	$finished=$_POST["finished"];
	$RID=$_POST["reason"];
	$applytime=$_POST["date"];
	if($data==null){$data="";}
	$con -> select_db($db_name);
    $ar = $con -> prepare("SELECT RID,UID,SID,finished,applytime FROM jinde WHERE RID=? &SID=? & finished=? & applytime=?");
    $ar -> bind_param("ssis", $RID ,$SID,$finished,$applytime);
    $ar -> execute();
    $arr = $ar -> get_result();
    $ar -> close();
    $arrow = mysqli_fetch_array($arr);
	echo $arrow; 
	echo $arr;
//}
?>
