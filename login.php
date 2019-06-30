<?php
session_start();
include 'mysql_connect.inc.php';

$user = $_POST["user"]; // 取得輸入用戶
$password = $_POST["password"]; // 取得輸入密碼
$con -> select_db("accounts");
$database = array("teacher", "student");
// 如果登入失敗次數小於5次
if ($_SESSION["loginfailed"] < 5){ 
    foreach ($database as $select){
        // 防止被注入攻擊
        $stmt = $con -> prepare("SELECT username,password,cpw FROM $select 
        WHERE username = ?");
        if(!$stmt)
        {
            die("Error: ".mysqli_error($con));
            exit();
        }
        $stmt -> bind_param('s', $user); 
        $stmt -> execute();
        $result = $stmt->get_result();
        $row = $result -> fetch_row();
        // 檢查符合資料庫且不為空
        if ($row[0] == $user && $row[1] == $password 
        && null != $user && null != $password){
            $_SESSION["user"] = $user; // 現在用戶
            $_SESSION["password"] = $password; // 現在密碼
            $_SESSION["type"] = $select; // 現在是學生還是老師
            $_SESSION["hadchangedpw"] = $row[2]; // 是否已經換過密碼
            unset($_SESSION["loginfailed"]); // 重置登入失敗次數
            // 如果未換過密碼，導向更改密碼
            if($row[2] == 0){
                header("Location:changepw.php");
                exit;
            }
            // 否則導向選擇頁面
            header("Location:selection.php");
            exit();
        }else{
            // 最後一個還沒登入成功 = 登入失敗
            if ($select =="student"){
                // 登入失敗狀態
                $_SESSION["loginstate"] = false;
                // 重置現在用戶
                unset($_SESSION["user"]);
                // 登入失敗次數增加
                $_SESSION["loginfailed"]++;
                header("Location:index.php");
                exit;
            }
        }
    }
}else{
    // 前面五次失敗 = 這是第六次
    // 取得登入失敗時間，用於防止爆破
    $_SESSION["time"] = time();
    $_SESSION["loginfailed"]++;
    header("Location:index.php");
    exit();
    
}

?>