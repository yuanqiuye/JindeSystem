<?php
//ini_set('display_errors','off');
include ("../sql/mysql_connect.php");
include ("jwt.php");
/*$data = json_decode(file_get_contents('php://input'), true);
if(decode_jwt($user, $jwt) === false || (int)decode_jwt($user, $jwt) < 3){
    $return["err"] = "登入逾時,不然就是你想亂來哈哈";
    echo json_encode($return);
}else{*/
	echo '<form method="post">
			搜尋<br><br>
			學號<input type="text" name="SID"/>
			狀態
				<select name="finished">
				<option></option>
				  <option value="0">未完成</option>
				  <option value="1">完成</option>
				</select>
			理由<select name="reason">
				  <option></option>
				  <option value="r1">放學未刷卡</option>
				  <option value="r2">家長為來電請假</option>
				  <option value="r3">刷備卡</option>
				  <option value="r4">使用3c產品</option>
				  <option value="r5">未簽到</option>
				  <option value="r6">遲交單子</option>
				  <option value="r7">違規打球</option>
				  <option value="r8">午休在教室外</option>
				  <option value="r9">學藝股長未依時簽到</option>
				  <option value="r10">大小點未交或遲交</option>
				  <option value="r11">請假流程錯誤</option>
				  <option value="r12">訂外食</option>
				  <option value="r13">朝會用餐</option>
				  <option value="r14">未交作業</option>
				  <option value="r15">未依時或躺窗台</option>
				  <option value="r16">代理同學未盡義務</option>
				  <option value="r17">其他</option>
				  <option value="g1">遲到</option>
				</select>
			日期<input type="date" name="date"/>
			<br><br><input type="submit"/>
		</form>';
//}
?>
