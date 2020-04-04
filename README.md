# JindeSystem

### V1 (2019/9/15完工)

#### 學生
    * 查看進德
    * 登記提早進德
    
#### 教師
    * 發送、審核提早進德名額
    * 登記進德
    * 大量銷進德
    
#### ToDo
    1. 線上上傳下載
    2. 查詢學生資料 (遠大的夢想
 
### 學生API解說
1. Login（POST http://jindesys.nctu.me/JindeSystem/backend/php/login.php）：
```javascript=
request:

{
    "user": "your user name",
    "password": "yout password"
}

reply:

{
    "type": "login",
    "err": "", //if not correct, err="帳號或密碼錯誤"
    "user": "your user name"
    "member": "student",
    "jwt": "your token", //default last time is 10 minute 
    "reason": ["遲到", "未刷卡"...],
    "applytime": ["2020-04-03", "2020-04-06"...]
}
```
