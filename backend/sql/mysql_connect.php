<meta charset="utf-8" />
<?php
function this_monday()
{
    $date = date('Y-m-d');  
    $first = 1; 
    $w = date('w', strtotime($date));  //Sunday start,return 0~6
    $now_start = date('md', strtotime("$date -" . ($w ? $w - $first : 6) . ' days')); 
    //Sunday minus 6 days
    return $now_start;
}

$host = 'localhost';
$sqluser = 'root';
$password = file_get_contents("../../../password.txt");
$db_name = 'd' . this_monday();
$check_db = file_get_contents("../../database/week.sql");

$con = mysqli_connect($host, $sqluser, $password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

  if ($con -> select_db($db_name) === true){
    
  }else if($con -> query($check_db) === false){
    die("Unexpected error!");
  }
  