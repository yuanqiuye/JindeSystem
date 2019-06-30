<?php
session_start();
include 'mysql_connect.inc.php';
$con -> select_db("accounts");

$changedpassword = $_POST["changedpassword"];
$checkchangedpassword = $_POST["checkchangedpassword"];
$oldpassword = $_POST["oldpassword"];
// 更改的密碼和確認密碼

$type = $_SESSION["type"];
$user = $_SESSION["user"];
$password = $_SESSION["password"];

if($changedpassword != $checkchangedpassword || $changedpassword == $password 
|| $changedpassword == null || $oldpassword != $password){
    // 更改密碼失敗
    $_SESSION["changestate"] = false;
    header("Location:changepw.php");
    exit();
}else{
    // 更新SQL
    if($con -> query("UPDATE $type set cpw = 1,password = $changedpassword
    where username = $user") == false)
	{
		die("Error: ".mysqli_error($con));
		exit();
    }else{
        // 更改過密碼
        $_SESSION["hadchangedpw"] = true;
        // 設置新密碼為現在密碼
        $_SESSION["password"] = $changedpassword;
        // 傳送更改成功狀態
        header("Location:selection.php?success=true");
        exit();
    }
}


?>