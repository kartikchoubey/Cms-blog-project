<?php session_start(); ?>
<?php include "database.php"; ?>

<?php
if(isset($_POST['login'])){
     $username=$_POST['username'];
     $password=$_POST['password'];
   
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
}else{
        header("Location: /cms/index.php");
    }}}

        }
