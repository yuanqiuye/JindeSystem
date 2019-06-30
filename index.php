<?php 
session_start(); 
?>
<html>
<title>板中進德系統</title>

<head>
    <meta charset="utf-8" />
    <META HTTP-EQUIV="REFRESH" CONTENT="600;URL=logout.php">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="板橋高中提早進德系統">
    <meta name="keywords" content="進德,板橋高中">
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
            <?php
            // 檢查是否已經登入
            if(isset($_SESSION["user"])){ 
                echo '<a class="item" href="logout.php">登出</a>
                      <a class="item" href="changepw.php">更改密碼</a>';
            }
            ?>
            <a class="item" href="http://www.pcsh.ntpc.edu.tw/">本校首頁</a>
        </div>
    </div>

    <?php
    // 取得現在時間
    $current=time(); 
    // 如果登入失敗超過五次，拿現在時間減登入失敗時間檢查
    if(isset($_SESSION["loginfailed"]) && $_SESSION["loginfailed"] > 5 
    && ($current - $_SESSION["time"]) < 30){
        echo '<div class="ts negative centered center aligned segment">
             <p>登入連續失敗超過五次，請五分鐘再試</p>
             </div>';
    }else{
        // 時間結束後，重設檢查的SESSION
        if(isset($_SESSION["loginfailed"]) && $_SESSION["loginfailed"] > 5){
            unset($_SESSION["loginfailed"]);
            unset($_SESSION["time"]);
            unset($_SESSION["loginstate"]);
        }
        echo '<div class="ts huge center aligned header">
        歡迎來到進德系統
        <div class="sub header" style="color:red">首次登入請更改密碼</div>
        <div class="sub header">以免影響自身權益及造成不必要的麻煩</div>
        <div class="sub header">若有使用上的疑問或系統故障</div>
        <div class="sub header">請洽詢生輔組，我們會盡快解決</div>';
        // 如果是從logout.php過來的，顯示登出訊息
        if (isset($_GET["logout"])){
            echo '<div class="sub header" style="color:red">登出成功！</div>';
        }
    echo '</div>

    <div class="ts centered secondary segment">
        <form class="ts form" action="login.php" method="post">

            <div class="field">
                <label>帳號：</label>
                <input type="text" placeholder="例:710999" name="user">
            </div>

            <div class="field">
                <label>密碼：</label>
                <input type="password" placeholder="預設為身分證後六碼" name="password">
            </div>';

            // 檢查是否登入失敗的狀態
            if (isset($_SESSION["loginstate"]) and ($_SESSION["loginstate"] === false)){
                unset($_SESSION["loginstate"]);
                echo "<div class='field'>
                <label style='color:red'>登入失敗！</label>
                </div>";
            }
            
            echo '
            <input type="submit" class="ts positive fluid button" value="登入">

        </form>
    </div>';
    }
    ?>

    

</body>

</html>