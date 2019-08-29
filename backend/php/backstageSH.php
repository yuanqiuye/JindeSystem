<?php
//ini_set('display_errors','off');
include ("../sql/mysql_connect.php");
include ("jwt.php");
/*$data = json_decode(file_get_contents('php://input'), true);
if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 3){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{*/
	echo '
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
			<script>
				function deleteJID(id) {
					  $.ajax({
						type: "GET",
						async: true,
						url: "BSdelete.php",
						data: {"id":id},
						cache: false,
					  }).done(function( msg ) {
						location.reload();
					  }).fail(function(){
						alert("failed");
					  });
				} 
			</script>
	</head>
	';
	$return=array(
		"JID" => array(),
		"RID" => array(),
		"UID" => array(),
		"SID" => array(),
		"finished" => array(),
		"applytime" => array(),
	);
	$SID=$_GET["SID"];
	$finished=$_GET["finished"];
	$RID=$_GET["reason"];
	$applytime=$_GET["date"];
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
		echo $i.'&nbsp;&nbsp;&nbsp;&nbsp;';
		echo $return["SID"][$i].'&nbsp;&nbsp;&nbsp;&nbsp;';
		echo $return["applytime"][$i].'&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<button id="'.$return["JID"][$i].'" onclick="deleteJID('.$return["JID"][$i].')">刪除</button><br>';
	}
	echo '</table>';
	echo '</center>';
//}
?>
