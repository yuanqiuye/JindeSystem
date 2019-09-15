<?php

function get_date()
{
    $date = date('Y-m-d');  
    $first = 1; 
    $w = date('w', strtotime($date_time));  //Sunday start,return 0~6
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
$date_time = date('Y-m-d');
$host = 'localhost';
$sqluser = 'qiuye';
$password = file_get_contents(__DIR__ ."/../../../../password.txt", FALSE, NULL, 0, 10);

$con = mysqli_connect($host, $sqluser, $password,  "resourse");

if (!$con){
  die('Could not connect: ' . mysql_error());
}
