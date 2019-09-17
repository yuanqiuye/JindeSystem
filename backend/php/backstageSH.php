<?php
ini_set('display_errors','off');
include ("common.php");
include ("jwt.php");

$user=$_COOKIE["user"];
$jwt=$_COOKIE["jwt"];
if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 3){
    header("Location:http://jindesys.nctu.me");
}else{
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
		"SID" => array(),
		"applytime" => array(),
	);
	$SID=$_GET["SID"];
	$finished=$_GET["finished"];
	$RID=$_GET["reason"];
	$applytime=$_GET["date"];
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
		array_push($return["SID"],$arrow["SID"]);
		array_push($return["applytime"],$arrow["applytime"]);
    	}
	echo '<center>';
	for($i=1;$i<=sizeof($return[JID]);$i++){
		echo $i.'&nbsp;&nbsp;&nbsp;&nbsp;';
		echo $return["SID"][$i-1].'&nbsp;&nbsp;&nbsp;&nbsp;';
		echo $return["applytime"][$i-1].'&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<button id="'.$return["JID"][$i-1].'" onclick="deleteJID('.$return["JID"][$i-1].')">刪除</button><br>';
	}
	echo '</center>';
}
?>
