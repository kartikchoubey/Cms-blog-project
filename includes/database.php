<?php
 $db['user_host']="localhost";
$db['user_user']="root";
$db['user_pass']="";
$db['user_db']="cms";
foreach($db as $key => $value){
    define(strtoupper($key),$value);
    
}
$connection=mysqli_connect(USER_HOST,USER_USER,USER_PASS,USER_DB);
  //  if($connection){
    //    echo "connection is done";
    //}






?>