<?php
// known bug
// when you create a whole new database, will get problem, process multiquery
function this_monday()
{
    $date = date('Y-m-d');  
    $first = 1; 
    $w = date('w', strtotime($date));  //Sunday start,return 0~6
    $now_start = date('md', strtotime("$date -" . ($w ? $w - $first : 6) . ' days')); 
    //Sunday minus 6 days
    return $now_start;
}

function next_monday(){
  return date("md",strtotime("next Monday"));
}

$host = 'localhost';
$sqluser = 'qiuye';
$password = file_get_contents(__DIR__ ."/../../../password.txt", FALSE, NULL, 0, 10);
$db_name = 'd' . this_monday();
$next_db_name = 'd' . next_monday();
$check_table = file_get_contents(__DIR__ ."/../../database/week.sql");


// 之後可以再做優化
$con = mysqli_connect($host, $sqluser, $password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

  if ($con -> select_db($db_name) === true){
    if($con -> multi_query($check_table) === false){
      die("Unexpected error!");
    }else{
      do {
        /* store first result set */
        if ($result = $con->store_result()) {
            while ($row = $result->fetch_row()) {
                printf("%s\n", $row[0]);
            }
            $result->free();
        }
       
    } while ($con->next_result());
    }
  }else{
    $con -> query("CREATE DATABASE $db_name");
    $con -> select_db($db_name);
    if($con -> query($check_table) === false){
      die("expected error!");
    }
  }


  if ($con -> select_db($next_db_name) === true){
    if($con -> multi_query($check_table) === false){
      die("Unexpected error!");
    }else{
      do {
        /* store first result set */
        if ($result = $con->store_result()) {
            while ($row = $result->fetch_row()) {
                printf("%s\n", $row[0]);
            }
            $result->free();
        }
       
    } while ($con->next_result());
    }
  }else{
    $con -> query("CREATE DATABASE $next_db_name");
    $con -> select_db($next_db_name);
    if($con -> query($check_table) === false){
      die("expected error!");
    }
  }
    
  
