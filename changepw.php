<?php
session_start();
// 檢查是否登入
if(isset($_SESSION["user"]) == false){
    echo "不要亂來喔ww笑";
    header("Refresh: 2; url=index.php");
    exit;
}

?>
<html>
<title>更改密碼</title>

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
    <div class="ts tertiary  menu">
        <div class="right menu">
            <a class="item" href="index.php">登入首頁</a>
            <a class="item" href="logout.php">登出</a>
            <a class="item" href="http://www.pcsh.ntpc.edu.tw/">本校首頁</a>
        </div>
    </div>

    <div class="ts huge center aligned header">
        更改密碼
        <div class="sub header" style="color:red">首次登入請更改密碼</div>
        <div class="sub header">以免影響自身權益及造成不必要的麻煩</div>
        <div class="sub header">若有使用上的疑問或系統故障</div>
        <div class="sub header">請洽詢生輔組，我們會盡快解決</div>
    </div>

    <div class="ts centered secondary segment">
        <form class="ts form" action="changepw_back.php" method="post">

            <div class="field">
                <label>舊密碼：</label>
                <!-- 字元檢查，https://stackoverflow.com/questions/35324229/how-to-interpret-this-regular-expression-w-g -->
                <input type="password" class=input onKeyUp="value=value.replace(/[\W_]/g,'')" placeholder="(新密碼不能重複)" name="oldpassword">
            </div>

            <div class="field">
                <label>新密碼：</label>
                <input type="password" class=input onKeyUp="value=value.replace(/[\W_]/g,'')" placeholder="(20個字母或數字)" name="changedpassword">
            </div>

            <div class="field">
                <label>確認新密碼：</label>
                <input type="password" placeholder="請再輸入一次" name="checkchangedpassword">
            </div>
            
            <?php
            // 如果更改密碼失敗(從_back設定的值)
            if (isset($_SESSION["changestate"]) and ($_SESSION["changestate"] === false)){
                unset($_SESSION["changestate"]);
                echo "<div class='field'>
                <label style='color:red'>更改失敗！</label>
                </div>";
            }
            ?>

            <input type="submit" class="ts positive fluid button" value="確認">

        </form>
    </div>

</body>

</html>