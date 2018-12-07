
<?php include "includes/database.php";    ?>

<?php include "includes/header.php";    ?>
 <!-- Navigation -->
    
    <?php include "includes/navigation.php";    ?>

<!-- Page Content -->
    <div class="container">

        <div class="row">
 <!-- Blog Entries Column -->
            <div class="col-md-8">

               
               

                        <?php
                
                
                         if(isset($_GET['p_id'])){
                             $the_post_id=$_GET['p_id'];
                                       
                
                             $query="UPDATE post SET post_view_count=post_view_count + 1 WHERE post_id={$the_post_id}  ";
                             $result=mysqli_query($connection,$query);
                             if(!$result){
                                 die("query failed".mysqli_error($connection));
                             }
                         }
                 if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                      $query="SELECT * FROM post WHERE post_id={$the_post_id}";
                 }else{
                     $query="SELECT * FROM post WHERE post_id={$the_post_id} AND post_status='published'";
                 }
                
                      
                        $post_connect=mysqli_query($connection,$query);
                     if(mysqli_num_rows($post_connect)<1){
                      echo"<h1 class='text-center'>NO POST AVAILABLE!!</h1>";
                }    else{          
                            ?> 
                             
                             <h1 class="page-header">
                   POSTS
                  
                </h1>

                       <?php      
                             
                        while($row=mysqli_fetch_assoc($post_connect)){

                        $post_title=$row['post_title'];
                        $post_author=$row['post_user'];
                        $post_date=$row['post_date'];
                        $post_image=$row['post_image'];
                        $post_content=$row['post_content'];

                        ?>

                        <!-- First Blog Post -->
                        <h2>
                        <a href="#"><?php echo $post_title;   ?></a>
                        </h2>
                        <p class="lead">
                        by <a href="index.php"><?php echo $post_author;   ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span><?php echo " ".$post_date;   ?> </p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image;    ?>" alt="">
                        <hr>
                        <p><?php echo $post_content;   ?></p>
                       
                        <hr>



                        <?php      
                        
                     }
                ?>
                
                     <!-- Blog Comments -->

                <!-- Comments Form -->
                
                <?php
                if(isset($_POST['comment_it'])){
                    $the_post_id=$_GET['p_id'];
                    
                 $comment_author= $_POST['comment_author'];
                     $comment_email= $_POST['comment_email'];
                     $comment_content= $_POST['comment_content'];
                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content) ){
                    
                    $query="INSERT  INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date)";
                    $query.="VALUES( $the_post_id,'{$comment_author}','{$comment_email}','{$comment_content}','unapprove',now())";
                    
                    $comment_query=mysqli_query($connection,$query);
                    if(!$comment_query){
                        die('query failed'.mysqli_error($connection));
                    }
                    
//                    $query="UPDATE post SET post_comment_count=post_comment_count+1 ";
//                    $query.="WHERE post_id=$the_post_id ";
//                    $update_post_comment_count=mysqli_query($connection,$query);
                    
                    
                    }else{
                        echo  "<script>alert('These Feild Should Not Be Empty')</script>";
                
                    }
                    
                    
                    
                }
                
              ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form  action="" method="post" role="form">
                        <div class="form-group">
                           <label for="author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                         <div class="form-group">
                           <label for="email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name="comment_it" class="btn btn-primary">Comment</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                
                <?php
                        $query="SELECT * FROM comments WHERE comment_post_id=$the_post_id ";
                        $query.="AND comment_status='approve' ";
                        $query.="ORDER BY comment_id DESC ";
                // this query in which order by comment_id desc mean latest post comment will se first
                
                    $comment_show_query=mysqli_query($connection,$query);
                     
                while($row=mysqli_fetch_assoc($comment_show_query)){
                    
                    $comment_author=$row['comment_author'];
                    $comment_date=$row['comment_date']; 
                     $comment_cont=$row['comment_content'];
                    ?>
                    
                      <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php  echo  $comment_author;  ?>
                            <small><?php  echo $comment_date;  ?></small>
                        </h4>
                       <?php  echo $comment_cont;  ?>
                    </div>
                </div>

                
       <?php   } } ?>
          </div>
 
 <!-- Blog Sidebar Widgets Column -->
             <?php include "includes/sidebar.php";     ?>
         
        </div>
<!-- /.row -->

        <hr>

 <!-- Footer -->
     <?php include "includes/footer.php";     ?>