<?php

function get_date()
{
    $date = date('Y-m-d');  
    $first = 1; 
    $w = date('w', strtotime($date));  //Sunday start,return 0~6
    $date_array = array (

    );
    $date_array[0] = date('Y-m-d', strtotime("$date -" . ($w ? $w - $first : 6) . ' days'));  //this monday
    $date_array[1] =  date('Y-m-d', strtotime("$date_array[0] + 6 days"));  //this friday
    $date_array[3] = date('Y-m-d', strtotime("$date_array[0] - 7 days")); //last monday
    $date_array[4] =  date('Y-m-d', strtotime("$date_array[3] + 6 days")); //last friday
    //Sunday minus 6 days
    return $date_array;
}

$date_array = get_date();
$date = date('Y-m-d');
$host = 'localhost';
$sqluser = 'qiuye';
$password = file_get_contents(__DIR__ ."/../../../../password.txt", FALSE, NULL, 0, 10);

$con = mysqli_connect($host, $sqluser, $password,  "resourse");

if (!$con){
  die('Could not connect: ' . mysql_error());
}

function check_access_flag($SID){

  global $date_array, $con;

  $sjinde = $con -> query("SELECT JID FROM jinde");// WHERE finished = 0 
  //AND NOT EXISTS (SELECT * FROM jinde WHERE jinde.RID = 'g1')
  //");

  //$sjinde->bind_param($SID);
  //$sjinde->execute();
  //$sjinder = $sjinde->get_result();
  //$sjinde->close();
  $jinde_number = mysqli_fetch_array($sjinde);
  //if(TRUE){
      for($i = 0; $i < sizeof($jinde_number); $i++){
          $nowJID = $jinde_number[$i];
          $con ->  query("UPDATE jinde SET access_flag = 0 WHERE JID = $nowJID");
      }
  //}else{
  //    for($i = 0; $i < sizeof($jinde_number); $i++){
  //        (int)$nowJID = $jinde_number[$i];
   //       $con ->  query("UPDATE jinde SET access_flag = 1 WHERE JID = $nowJID");
   //   }
  //}
}

$result = $con -> query("SELECT check_date FROM system_inform WHERE type = 'access_flag'
AND check_date BETWEEN '$date_array[0]' AND '$date_array[1]'");

$checkdate = mysqli_fetch_array($result);
$date_time = date('Y-m-d');

if(TRUE){
  $result = $con -> query("SELECT SID FROM student");
  $SID = mysqli_fetch_array($result);
  //for($i = 0; $i < sizeof($SID); $i++){
      check_access_flag($SID[0]);
  //}
  $con -> query("UPDATE system_inform SET check_date = '$date_time' WHERE type = 'access_flag'");
}
