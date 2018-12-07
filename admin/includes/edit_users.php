 <?php
if(isset($_GET['edit_user'])){
    $user_id=escape($_GET['edit_user']);

    
  $query="SELECT * FROM user WHERE user_id=$user_id";
   $edit_query=mysqli_query($connection,$query);
   query_error($edit_query);
  while($user_out=mysqli_fetch_assoc($edit_query)){
          
        
         $user_firstname=$user_out['user_firstname'];
         $user_lastname=$user_out['user_lastname'];
         $user_role=$user_out['user_role'];
         $username=$user_out['username'];
         $user_email=$user_out['user_email'];
         $user_password=$user_out['user_password'];
            
        
  }
//            $hashformat="$2x$10$";
//            $salt="iusesomecrazystrings22";
//            $hash_and_salt=$hashformat.$salt;
//            $user_password=crypt($user_password,$hash_and_salt);
//           

?>

                <?php 

                if(isset($_POST['update_user'])){
                    
                   
             
                $user_firstname=escape($_POST['user_firstname']);
                $user_lastname=escape($_POST['user_lastname']);
                $user_role=escape($_POST['user_role']);
                $username=escape($_POST['username']);
                //  $post_image=$_FILES['image']['name'];
                // $post_image_temp=$_FILES['image']['tmp_name'];
                $user_email=escape($_POST['user_email']);
                $user_password=escape($_POST['user_password']);
//                $hashformat="$2x$10$";
//                $salt="iusesomecrazystrings22";
//                $hash_and_salt=$hashformat.$salt;
                $user_new_password=password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>10));


                $query="UPDATE user SET ";
                $query .="user_firstname = '{$user_firstname}', ";
                $query .="user_lastname = '{$user_lastname}', ";
                $query .="user_role = '{$user_role}', ";
                $query .="username = '{$username}', ";
                $query .="user_email = '{$user_email}', ";
                $query .="user_password = '{$user_new_password}' ";
                $query .="WHERE user_id={$user_id} ";
                $update_user=mysqli_query($connection,$query);
                query_error($update_user);

                if(!$update_user){
                die("query failed".mysqli_error($connection));
                }



   echo"<h4> User Edit:<a href='./users.php'>View Users</a></h4>";

                }}else{
    header("Location: ./index.php");
}


          ?>      

           
  <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="user_firstname">Firstname</label>
          <input type="text" class="form-control" value="<?php  echo $user_firstname; ?>" name="user_firstname">
      </div>
      
       <div class="form-group">
         <label for="user_lastname">Lastname</label>
          <input type="text" class="form-control" value="<?php  echo $user_lastname; ?>" name="user_lastname">
      </div>
      
      <div class="form-group">
         <select name="user_role" id="">
             <option value="subscriber"><?php  echo $user_role; ?></option>
         <?php
           if($user_role =='admin'){
              echo "<option value='subscriber'>Subscriber</option>";
           }
            if($user_role =='subscriber'){
              echo "<option value='admin'>admin</option>";
           }
           
           
           ?>
         </select>
         
      </div>
      
      <div class="form-group">
         <label for="username">Username</label>
          <input type="text"  value="<?php  echo $username; ?>"class="form-control" name="username">
      </div>
      
<!--
        
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>
-->

      <div class="form-group">
         <label for="user_email">Email</label>
          <input type="email" class="form-control" value="<?php  echo $user_email; ?>" name="user_email">
      </div>
      
      <div class="form-group">
         <label for="user_password">Password</label>
          <input type="password" autocomplete="off" class="form-control" name="user_password">
      </div>
      
     
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
      </div>


</form>
    