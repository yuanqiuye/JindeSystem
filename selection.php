<?php
session_start();
include 'mysql_connect.inc.php';
// 是否登入且是否更改過密碼
if((isset($_SESSION["user"]) && $_SESSION["hadchangedpw"] == 1) 
    == false){
    echo "不要亂來喔ww笑";
    header("Refresh: 2; url=index.php");
    exit;
}

$user = $_SESSION["user"]; // 取得現在用戶
$con -> select_db("accounts");

if ($_SESSION["type"] == "teacher"){

    $result = $con -> query("SELECT priority, chushi FROM teacher 
    WHERE username = $user");

    if(!$result){
		die("Error: ".mysqli_error($con));
		exit();
    }

    $row = $result -> fetch_assoc();
    // 取得老師權限以及處室
    $_SESSION["chushi"] = $row["chushi"];
    $_SESSION["priority"] = $row["priority"];
}
?>

<html>
<title>選擇選項</title>

<head>
    <meta charset="utf-8" />
    <META HTTP-EQUIV="REFRESH" CONTENT="600;URL=logout.php">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.3/tocas.css" />
    <style type="text/css">
    .segment {
        max-width: 300px;
    }
    </style>
</head>

<body>

    <div class="ts tertiary menu">
        <div class="right menu">
        <a class="item" href="index.php">登入首頁</a>
        <a class="item" href="changepw.php">更改密碼</a>
        <a class="item" href="logout.php">登出</a>
        <a class="item" href="http://www.pcsh.ntpc.edu.tw/">本校首頁</a>
        </div>
    </div>

    <div class="ts huge center aligned header">
        請選擇選項
        <div class="sub header">若有使用上的疑問或系統故障</div>
        <div class="sub header">請洽詢生輔組，我們會盡快解決</div>
        <?php
            // 如果是從更改密碼頁面過來
            if (isset($_GET["success"])){
                echo '<div class="sub header" style="color:red">
                更改成功！
                </div>';
            }
        ?>
    </div>
    <br>
    <div class="ts centered center aligned secondary raised segment">
    <!-- 分配身份以及權限能看到的按鈕 -->
    <?php
    if ($_SESSION["type"] == "student"){
        echo "<button class='ts large button' onclick='location.href='''>登記提早進德</button>
                <br><br>
            <button class='ts large button' onclick='location.href='''>查看這週進德</button>";
    }
    ?>

    <?php
    if ($_SESSION["type"] == "teacher"){
        echo "<button class='ts large button' onclick='location.href='''>登記學生進德</button>
      <br><br><button class='ts large button' onclick='location.href='''>登記三好卡</button>";
    }
    ?>

    <?php
    if ($_SESSION["type"] == "teacher" and 
        $_SESSION["priority"] >= 2){
        echo "<br><br><button class='ts large button' onclick='location.href='''>發送提早進德</button>
              <br><br><button class='ts large button' onclick='location.href='''>審核提早進德</button>";
    }
    ?>

    <?php
    if ($_SESSION["type"] == "teacher" and
        $_SESSION["priority"] == 3){
        echo "<br><br><button class='ts large button' onclick='location.href='''>大量銷進德</button>";
    }
    ?>

    </div>
</body>

</html>