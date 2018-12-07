
   <?php 

        if(isset($_POST['create_user'])){
            
    $user_firstname=escape($_POST['user_firstname']);
    $user_lastname=escape($_POST['user_lastname']);
    $user_role=escape($_POST['user_role']);
    $username=escape($_POST['username']);
  //  $post_image=$_FILES['image']['name'];
   // $post_image_temp=$_FILES['image']['tmp_name']);
    $user_email=escape($_POST['user_email']);
    $user_password=escape($_POST['user_password']);
//        $hashformat="$2x$10$";
//        $salt="iusesomecrazystrings22";
//        $hash_and_salt=$hashformat.$salt;
//        $user_new_password=crypt($user_password,$hash_and_salt);
//   // $post_date=date('d-m-y');
   // $post_comment_count=4;
$user_new_password=password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>10));
    //move_uploaded_file($post_image_temp,"../images/$post_image");

    $query="INSERT INTO user(user_firstname,user_lastname,user_role,username,user_email,user_password) ";
    $query .="VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_new_password}')";


            $add_user_query=mysqli_query($connection,$query);
            
            query_error( $add_user_query); 
            echo "USER ADDED GO =>"." "."<a href ='users.php'>View All Users</a>";
            
        }
        
          
        ?>    
              
  <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="user_firstname">Firstname</label>
          <input type="text" class="form-control" name="user_firstname">
      </div>
      
       <div class="form-group">
         <label for="user_lastname">Lastname</label>
          <input type="text" class="form-control" name="user_lastname">
      </div>
      
      <div class="form-group">
         <select name="user_role" id="">
             <option value="subscriber">Select Option</option>
             <option value="subscriber">Subscriber</option>
             <option value="admin">Admin</option>
             
         </select>
      </div>
      
      <div class="form-group">
         <label for="username">Username</label>
          <input type="text" class="form-control" name="username">
      </div>
      
<!--
        
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>
-->

      <div class="form-group">
         <label for="user_email">Email</label>
          <input type="email" class="form-control" name="user_email">
      </div>
      
      <div class="form-group">
         <label for="user_password">Password</label>
          <input type="password" class="form-control" name="user_password">
      </div>
      
     
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
      </div>


</form>
    