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
		"UID" => array(),
		"SID" => array(),
		"finished" => array(),
		"applytime" => array(),
	);
	$SID=$_POST["SID"];
	$finished=$_POST["finished"];
	$RID=$_POST["reason"];
	$applytime=$_POST["date"];
	//if($data==null){$data="";}
	$con -> select_db($db_name);
    	$ar = $con -> prepare("SELECT * FROM jinde WHERE RID=? AND SID=? AND finished=? AND applytime=?");
	$ar -> bind_param("ssis", $RID ,$SID,$finished,$applytime);
	$ar -> execute();
	if($ar === false){
        	die($con->error);
    	}
	$arr = $ar -> get_result();
	$ar -> close();
	while($arrow = mysqli_fetch_array($arr)){
		array_push($return["RID"],$arrow["RID"]);
		array_push($return["UID"],$arrow["UID"]);
		array_push($return["SID"],$arrow["SID"]);
		array_push($return["finished"],$arrow["finished"]);
		array_push($return["applytime"],$arrow["applytime"]);
    	}
	echo '<table border="1">';
	for($i=0;$i<sizeof($return);$i++){
		echo '<tr>';
		echo '<td>'.$return["RID"][$i].'</td>';
		echo '<td>'.$return["UID"][$i].'</td>';
		echo '<td>'.$return["SID"][$i].'</td>';
		echo '<td>'.$return["finished"][$i].'</td>';
		echo '<td>'.$return["applytime"][$i].'</td>';
		echo '</tr>';
	}
	echo '</table>';
//}
?>
