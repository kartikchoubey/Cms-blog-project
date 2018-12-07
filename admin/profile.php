<?php   include"includes/header.php"  ?>
  
    <?php
    
    if(isset($_SESSION['username'])){
        
             $username=$_SESSION['username'];
        
         $query="SELECT * FROM user WHERE username='{$username}'";
   $profie_update_query=mysqli_query($connection,$query);
   query_error($profie_update_query);
  while($user_out=mysqli_fetch_assoc($profie_update_query)){
          
        
         $user_firstname=$user_out['user_firstname'];
         $user_lastname=$user_out['user_lastname'];
       
         $username=$user_out['username'];
         $user_email=$user_out['user_email'];
         $user_password=$user_out['user_password'];
       
        
  }
    }
    
   ?>
           <?php 

                if(isset($_POST['update_profile'])){

                $user_firstname=escape($_POST['user_firstname']);
                $user_lastname=escape($_POST['user_lastname']);
               
                $username=escape($_POST['username']);
                //  $post_image=$_FILES['image']['name'];
                // $post_image_temp=$_FILES['image']['tmp_name'];
                $user_email=escape($_POST['user_email']);
                $user_password=escape($_POST['user_password']);
                $query="UPDATE user SET ";
                $query .="user_firstname = '{$user_firstname}', ";
                $query .="user_lastname = '{$user_lastname}', ";
              
                $query .="username = '{$username}', ";
                $query .="user_email = '{$user_email}', ";
                $query .="user_password = '{$user_password}' ";
                $query .="WHERE username='{$username}' ";
                $update_user=mysqli_query($connection,$query);
                query_error($update_user);

                if(!$update_user){
                die("query failed".mysqli_error($connection));
                }





                }


          ?>      

    
    
    
    
 <div id="wrapper">
 <!-- Navigation -->
    
       <?php   include"includes/navigation.php"  ?>
            <div id="page-wrapper">

                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">
                                    Welcome To Admin
                                    <small><?php  echo $_SESSION['username']; ?></small>
                                </h1>
                             </div>
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
          <input type="password" value="<?php  echo $user_password; ?>" class="form-control" name="user_password">
      </div>
      
     
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
      </div>


</form>
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.container-fluid -->

                </div>
        <!-- /#page-wrapper -->
         <?php   include"includes/footer.php"  ?>

   