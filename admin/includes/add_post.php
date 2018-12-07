
   
   <?php 

        if(isset($_POST['create_post'])){
            
    $post_title=escape($_POST['title']);
    $post_category_id=escape($_POST['post_category_id']);
    $post_author=escape($_POST['post_user']);
    $post_status=escape($_POST['post_status']);
    $post_image=escape($_FILES['image']['name']);
    $post_image_temp=escape($_FILES['image']['tmp_name']);
    $post_tags=escape($_POST['post_tags']);
    $post_content=escape($_POST['post_content']);
    $post_date=escape(date('d-m-y'));
    $post_comment_count=0;

    move_uploaded_file($post_image_temp,"../images/$post_image");

    $query="INSERT INTO post(post_title,post_category_id,post_user, post_status, post_image,post_tags,post_content,post_date,post_comment_count) ";
    $query .="VALUES('{$post_title}',{$post_category_id},'{$post_author}','{$post_status}','{$post_image}','{$post_tags}','{$post_content}',now(),'{$post_comment_count}')";


            $add_post_query=mysqli_query($connection,$query);
            
            query_error( $add_post_query); 
            $post_id=mysqli_insert_id($connection);// this will pull out last id which is added 
            
            
            echo"<h4>POST ADDED:<a href='../post.php?p_id={$post_id}'>View Post</a> OR <a href='./post.php'>Edit More Post</a> </h4>";
            
        }
        
          
        ?>    
              
  <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="title">
      </div>
      
       <div class="form-group">
  <label for="title">Categories :</label>
       <select name="post_category_id" id="">
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
              <option value="">Post Status</option>
              <option value="published">Published</option>
              <option value="draft">Draft</option>
              
          </select>
         
      </div>
      
        
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div>
      
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control" name="post_content" id="body" cols="30" rows="10">
         </textarea>
       <!--   <script>
             ClassicEditor
                 .create( document.querySelector( '#body' ) )
                 .catch( error => {
            console.error( error );
                 } );
         </script> -->
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>


</form>
    