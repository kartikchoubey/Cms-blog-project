  <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Username</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                             <th>Delete</th>
                                             <th>Admin</th>
                                             <th>Subscriber</th>
                                              <th>Edit</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
<?php
    
    $query="SELECT * FROM user";
   $user_query=mysqli_query($connection,$query);
  while($post_out=mysqli_fetch_assoc($user_query)){
          
         $user_id=$post_out['user_id'];
         $username=$post_out['username'];
         $user_password=$post_out['user_password'];
         $user_firstname=$post_out['user_firstname'];
         $user_lastname=$post_out['user_lastname'];
         $user_image=$post_out['user_image'];
         $user_email=$post_out['user_email'];
         $user_role=$post_out['user_role'];
        
      
      
      echo"<tr>";
           echo "<td>{$user_id}</td>";
           echo "<td>{$username}</td>";
           echo "<td>{$user_firstname}</td>";
      
//             
//                $query="SELECT * FROM categories WHERE cat_id ={$post_category_id}";   
//                $result=mysqli_query($connection,$query);
//                query_error($result);
//                while($fetch=mysqli_fetch_assoc($result)){
//                $cat_id=$fetch['cat_id'];
//                $cat_title=$fetch['cat_title'];
//                 echo "<td>{$cat_title}</td>";
//      
//                  }
//      
           echo "<td>{$user_lastname}</td>";
          // echo "<td><img width='80' src='../images/$post_image'</td>";
           echo "<td>{$user_email}</td>";
           echo "<td>{$user_role}</td>";
          
             echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
         echo "<td><a href='users.php?admin={$user_id}'>Admin</a></td>";
            echo "<td><a href='users.php?subscriber= {$user_id}'>Subscriber</a></td>";
  echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";


      echo"</tr>";
      
      
  }
    
 ?>
                                       </tbody>            
                                  
                                    
</table>
                               
                                
<?php
if(isset($_GET['delete'])){
     if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role']='admin'){
    $delete_user=mysqli_real_escape_string($connection,$_GET['delete']);
   
    $query="DELETE FROM user WHERE user_id={$delete_user}";
    $delete_query=mysqli_query($connection,$query);
    query_error($delete_query);
    header("location: users.php");
}}}




?>
                                
<?php
if(isset($_GET['admin'])){
    
    $update_user=$_GET['admin'];
    $query="UPDATE user SET user_role='admin' WHERE user_id= $update_user";
    $update_query=mysqli_query($connection,$query);
    query_error($update_query);
    header("Location: users.php");
}

?>
                                 
                                
<?php
if(isset($_GET['subscriber'])){
    
    $update_user=$_GET['subscriber'];
    $query="UPDATE user SET user_role='subscriber' WHERE user_id= $update_user";
    $update_query=mysqli_query($connection,$query);
    query_error($update_query);
    header("Location: users.php");
}

?>
                                                                                                                     
                                                                                                                               
                                                                                                                                                                           
                                                                                                                                                                                                                                      
                                                                                                                                                                                                                                                                                                 
                                                                                                                                                                                                                                                               
                                                                                                                 
                                