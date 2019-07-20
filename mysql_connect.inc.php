<meta charset="utf-8" />
<?php

function generate_DB_name(){
  $weekday = array ("Monday" => 1, "Tuesday" => 2,"Wednesday" => 3,
  "Thursday" => 4,"Friday" => 5,"Saturday" => 6,"Sunday" => 7,);
  $date = date("d") - ($weekday[date("l")] - 1);
  $name = date("Ym") . $date;
  return $name;
}

@$db_server = "localhost";
@$db_user = "root";
@$db_passwd = "";
@$db_name = "d" . generate_DB_name();
$create_event = 
"CREATE TABLE eve (
  EID int NOT NULL AUTO_INCREMENT,
  JID int,
  teacher varchar(50) not null,
  day int not null,
  time int not null,
  finished bit DEFAULT 0,
  PRIMARY KEY(EID))";
$create_jinde = 
  "CREATE TABLE jinde (
  JID int NOT NULL AUTO_INCREMENT,
  YID int NOT NULL,
  teacher varchar(50) not null,
  SID varchar(7) not null,
  applytime datetime NOT NULL DEFAULT NOW(),
  PRIMARY KEY(JID))";

$con = mysqli_connect($db_server, $db_user, $db_passwd);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
   
if ($con -> select_db($db_name) === false){
  if ($con -> query("CREATE DATABASE $db_name")){
    $con -> select_db($db_name);
    if ($con -> query($create_event) 
    && $con -> query($create_jinde) === false) {
        die("Unexpected Error!");
    }
  }
}

?> 