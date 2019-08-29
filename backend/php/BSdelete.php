<?php
ini_set('display_errors','off');
include ("../sql/mysql_connect.php");
include ("jwt.php");
$data = json_decode(file_get_contents('php://input'), true);
if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 3){
    header("Location:http://jindesys.nctu.me");
}else{
	$return="";
	$JID=$_GET["id"];
	$con -> select_db($db_name);
  $ar = $con -> prepare("UPDATE jinde SET finished=1 WHERE JID=?");
	$ar -> bind_param("s", $JID);
	$ar -> execute();
	if($ar === false){
        	//die($con->error);
          echo 'failed';
  }
  else{
    echo 'success';
  }
	$ar -> close();
  
}
?>
