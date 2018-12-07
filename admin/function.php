<?php

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection,trim($string));
}
/////////////////////////////////////////////////////////

function user_online(){
    global $connection;

    $session = session_id();
    $time = time();
    $time_out_in_seconds = 60;
    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM user_online WHERE session = '$session'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

    if($count == NULL) {

    mysqli_query($connection, "INSERT INTO user_online(session, time) VALUES('$session','$time')");


    } else {

    mysqli_query($connection, "UPDATE user_online SET time = '$time' WHERE session = '$session'");


    }

    $users_online_query =  mysqli_query($connection, "SELECT * FROM user_online WHERE time > '$time_out'");
    return $count_user = mysqli_num_rows($users_online_query);

}
/////////////////////////////////////////////////////////////////////////////////////////////
function redirect($location){
    header("Location: .$location");
    exit;
}

function isLogin(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
    return false;
}
function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD']== strtoupper($method)){
        return true;

    }
    return false;
}
function ifUserIsLoggedInAndRedirect($redirectlocation){
    if(isLogin()){
        redirect($redirectlocation);
    }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
function query_error($result){     // function is to check the query have any error
global $connection;
if(!$result){
die("query failed".mysqli_error($connection));
}

}

//////////////////////////////////////////////////////////////////////////////////////////

function Delete_query(){  //////////////delete code of php

global $connection;
if(isset($_GET['delete'])){


$cat_del= $_GET['delete'];
$query="DELETE FROM categories WHERE cat_id ={$cat_del}";
$result= mysqli_query($connection,$query);
if(!$result){
die("not connected".mysqli_error($connection));
}
header("Location: categories.php");
// this will automatically refresh the page  here location and colon should be attach then only it will work
}

}

/////////////////////////////////////////////////////////////////////////////////////////



function insert_query(){
global $connection;
// insert php code where we want to insert the category//
if(isset($_POST['submit']))
{
$cat_title=$_POST['cat_title'];
if($cat_title == "" || empty($cat_title))
{
echo"This field should not be empty";
}else
{
$query="INSERT INTO categories(cat_title) ";
$query .="VALUE('{$cat_title}')";
$insert_query=mysqli_query($connection,$query);
if(!$insert_query)
{
die("not connected".mysqli_error($connection));
}
}

}

}

//////////////////////////////////////////////////////////////////////////////////////////////


function  display_cat(){

// display inserted category with there cat id on to the page//
global $connection;
$query="SELECT * FROM categories";   
$result=mysqli_query($connection,$query);

while($fetch=mysqli_fetch_assoc($result)){
$cat_id=$fetch['cat_id'];
$cat_title=$fetch['cat_title'];
echo"<tr>";
echo "<td>{$cat_id}</td>";
echo "<td>{$cat_title}</td>";
echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a> </td>";
echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
// this will add another delete column with delete link 
echo"</tr>";
}
//////////////////////////////////////////////////////////////////////////////////////////

}
function isadmin($username){
    global $connection;
    $query="SELECT user_role FROM user WHERE username='$username'";
    $result=mysqli_query($connection,$query);
    query_error($result);
    $row=mysqli_fetch_assoc($result);
    if($row['user_role']=='admin'){
        return true;
    }else{
        return false;
    }
    
}
//////////////////////////////////////////////////////////////////////////////////////////
function user_exist($username){
    global $connection;
    $query="SELECT username FROM user WHERE username='$username'";
    $result=mysqli_query($connection,$query);
    query_error($result);
   
    if(mysqli_num_rows($result)>0){
        return true;
    }else{
        return false;
    }
    
}
////////////////////////////////////////////////////////////////////////////////////////////

function email_exist($email){
    global $connection;
    $query="SELECT user_email FROM user WHERE user_email='{$email}'";
    $result=mysqli_query($connection,$query);
    query_error($result);
   
    if(mysqli_num_rows($result)>0){
        return true;
    }else{
        return false;
    }
    
}
///////////////////////////////////////////////////////////////////////////////////
function register_user($username,$email,$password){
    global $connection;
       
       if(!empty($username) && !empty($password)  && !empty($email)){
       
       
    $username=mysqli_real_escape_string($connection,$username);
    $password=mysqli_real_escape_string($connection,$password);
       $email=mysqli_real_escape_string($connection,$email);
//       $hashformat="$2x$10$";
//       $salt="iusesomecrazystrings22";
//       $hash_and_salt=$hashformat.$salt;
//       $password=crypt($password,$hash_and_salt);
           $password=password_hash($password,PASSWORD_BCRYPT,array('cost'=>10));
       
       $query="INSERT INTO user(username,user_password,user_email,user_role) ";
       $query.="VALUES('{$username}','{$password}','{$email}','subscriber')";
       
       $reg_query=mysqli_query($connection,$query);
       query_error($reg_query);
       }
}
////////////////////////////////////////////////////////////////////////////////
function login_user($username,$password){
    global $connection;
      $username=mysqli_real_escape_string($connection,$username);
     $password=mysqli_real_escape_string($connection,$password); 
     $query="SELECT * FROM user WHERE username='{$username}' ";
     $selection_query=mysqli_query($connection,$query);
     if(!$selection_query){
        die("query failed ".mysqli_error($connection));
     }else{
        while($row=mysqli_fetch_assoc($selection_query)){
             $db_user_id=$row['user_id'];
             $db_username=$row['username'];
             $db_user_password=$row['user_password'];
             $db_user_firstname=$row['user_firstname'];
             $db_user_lastname=$row['user_lastname'];
             $db_user_role=$row['user_role'];
        
         if(password_verify($password,$db_user_password)){
    

        $_SESSION['username']=$db_username;
        $_SESSION['user_firstname']=$db_user_firstname;
        $_SESSION['user_password']=$db_user_password;
        $_SESSION['user_lastname']=$db_user_lastname;
        $_SESSION['user_role']=$db_user_role;
        header("Location: /cms/admin");

}
     else{
    
         return false;
   
    
}  }
    }

        

return true;

}