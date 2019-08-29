<?php
//ini_set('display_errors','off');
include ("../sql/mysql_connect.php");
include ("jwt.php");
/*$data = json_decode(file_get_contents('php://input'), true);
if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 3){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{*/
	echo '	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js">
		<script>
			function delete(id) {
				  $.ajax({
				    type: "POST",
				    async: true,
				    url: "BSdelete.php",
				    data: {"id":id},
				    cache: false,
				  }).done(function( msg ) {
					location.reload();
				  }).fail(function(){alert("failed");});
			}
		</script>
	';
	$return=array(
		"JID" => array(),
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
		array_push($return["JID"],$arrow["JID"]);
		array_push($return["RID"],$arrow["RID"]);
		array_push($return["UID"],$arrow["UID"]);
		array_push($return["SID"],$arrow["SID"]);
		array_push($return["finished"],$arrow["finished"]);
		array_push($return["applytime"],$arrow["applytime"]);
    	}
	echo '<center>';
	echo '<table style="border-top:3px #FFD382 solid;border-bottom:3px #82FFFF solid;" >';
	for($i=0;$i<sizeof($return);$i++){
		echo '<tr>';
		echo '<td><button id="'.$return["JID"].'">刪除</button></td>';
		echo '<td>'.$return["SID"][$i].'</td>';
		echo '<td>'.$return["applytime"][$i].'</td>';
		echo '</tr>';
	}
	echo '</table>';
	echo '</center>';
//}
?>
