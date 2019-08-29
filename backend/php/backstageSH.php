<?php
//ini_set('display_errors','off');
include ("../sql/mysql_connect.php");
include ("jwt.php");
/*$data = json_decode(file_get_contents('php://input'), true);
if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 3){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{*/
	$return=array(
		"RID" => array(),
	);
	$SID=$_POST["SID"];
	$finished=$_POST["finished"];
	$RID=$_POST["reason"];
	$applytime=$_POST["date"];
	//if($data==null){$data="";}
	$con -> select_db($db_name);
    	$ar = $con -> prepare("SELECT * FROM jinde WHERE RID=? & SID=? & finished=? & applytime=?");
	$ar -> bind_param("ssis", $RID ,$SID,$finished,$applytime);
	$ar -> execute();
	if($ar === false){
        	die($con->error);
    	}
	$arr = $ar -> get_result();
	$ar -> close();
	while($arrow = mysqli_fetch_array($arr)){
		array_push($return["RID"],$arrow["RID"]);
		echo 1;
    	}
	for($i=0;$i<sizeof($return);$i++){
		echo $return["RID"][$i];
		echo 2;
	}
//}
?>
