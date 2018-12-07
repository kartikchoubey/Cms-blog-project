
   



<?php
if(isset($_GET['p_id'])){
    $post_id=escape($_GET['p_id']);
}
    
  $query="SELECT * FROM post WHERE post_id=$post_id";
   $edit_query=mysqli_query($connection,$query);
   query_error($edit_query);
  while($post_out=mysqli_fetch_assoc($edit_query)){
          
        
         $post_author=$post_out['post_user'];
         $post_title=$post_out['post_title'];
         $post_category_id=$post_out['post_category_id'];
         $post_status=$post_out['post_status'];
         $post_image=$post_out['post_image'];
         $post_tags=$post_out['post_tags'];
         $post_comment_count=$post_out['post_comment_count'];
         $post_date=$post_out['post_date'];
         $post_content=$post_out['post_content'];
  }

?>
<?php    

        if(isset($_POST['update_post'])){
   

            $post_title=escape($_POST['title']);
            $post_category_id=escape($_POST['post_category']);
            $post_author=escape($_POST['post_user']);
            $post_status=escape($_POST['post_status']);
            $post_image=escape($_FILES['image']['name']);
            $post_image_temp=escape($_FILES['image']['tmp_name']);
            $post_tags=escape($_POST['post_tags']);
            $post_content=escape($_POST['post_content']);
            $post_date=escape(date('d-m-y'));

            move_uploaded_file($post_image_temp,"../images/$post_image");
            if(empty($post_image))   {
                
                $query="SELECT * FROM post WHERE post_id = $post_id ";
                $display_image =mysqli_query($connection,$query);
                query_error($display_image);
                while($row=mysqli_fetch_assoc($display_image)){
                    $post_image=$row['post_image'];
                }
                                     }
            

                $query="UPDATE post SET ";
                $query .="post_title = '{$post_title}', ";
                $query .="post_category_id = '{$post_category_id}', ";
                $query .="post_user = '{$post_author}', ";
                $query .="post_status = '{$post_status}', ";
                $query .="post_image = '{$post_image}', ";
                $query .="post_tags = '{$post_tags}', ";
                $query .="post_content = '{$post_content}', ";
                $query .="post_date = now() ";
                $query .="WHERE post_id={$post_id} ";
                $update_post=mysqli_query($connection,$query);
                query_error($update_post);
            
                  if(!$update_post){
                      die("query failed".mysqli_error($connection));
                  }

                 echo"<h4>Post Updated :<a href='../post.php?p_id=$post_id'>View Post</a> OR <a href='./post.php'>Edit More Posts</a></h4>";
            
            
            
            }


?>
             
 <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Post Title</label>
          <input  value="<?php  echo $post_title  ?>" type="text" class="form-control" name="title">
      </div>
    <div class="form-group">
  <label for="title">Categories :</label>
       <select name="post_category" id="">
          <?php echo "<option value='{$post_category_id}'>Select categories</option>"; ?>
           
        <?php
        $query="SELECT * FROM categories";
        $fetch_cat=mysqli_query($connection,$query);
           while($row=mysqli_fetch_assoc($fetch_cat)){
               $cat_title=$row['cat_title'];
               $cat_id=$row['cat_id'];
               echo "<option value={$cat_id}>$cat_title</option>";
           }
     
        
        ?>
        </select>
        
      
      </div>
      
         <div class="form-group">
          <label for="title">User :</label>
         <select name="post_user" id="">
      
        <?php echo "<option value='{$post_author}'>Select User</option>"; ?>
           
          <?php
           
        $query="SELECT * FROM user";
        $fetch_user=mysqli_query($connection,$query);
           while($row=mysqli_fetch_assoc($fetch_user)){
               $username=$row['username'];
             
               echo "<option value='{$username}'>$username</option>";
           }
     
        
        ?>
        </select>
        
       
      </div>
    
      
      <div class="form-group">
        <select name="post_status" id="">
            <option value='<?php echo $post_status;  ?>'><?php echo $post_status;  ?></option>
            <?php
            if($post_status == 'published')
            {
                echo"<option value='draft'>Draft</option>";
                
            }else
            {
               echo "<option value='published'>Published</option>";
            }
            
         ?>
            
            
        </select>
      </div>
      
        
    <div class="form-group">
        <img  width="100" src="../images/<?php echo $post_image; ?>" alt="">
         <input type="file"  name="image">
      </div>
           
    

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input   value="<?php  echo $post_tags;  ?>" type="text" class="form-control" name="post_tags">
      </div>
      
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea  class="form-control "name="post_content" id="body" cols="30" rows="10">
         <?php  echo $post_content; ?>
         </textarea>
        <!--  <script>
             ClassicEditor
                 .create( document.querySelector( '#body' ) )
                 .catch( error => {
            console.error( error );
                 } );
         </script> -->
         
     </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
      </div>


</form>
    