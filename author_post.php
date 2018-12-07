
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
                
                
                         if(isset($_GET['author'])){
                             $the_post_author=$_GET['author'];
                         }                
                
                
                        $query="SELECT * FROM post WHERE post_user='{$the_post_author}'";
                        $post_connect=mysqli_query($connection,$query);
                        while($row=mysqli_fetch_assoc($post_connect)){

                        $post_title=$row['post_title'];
                        $post_author=$row['post_user'];
                        $post_date=$row['post_date'];
                        $post_image=$row['post_image'];
                        $post_content=$row['post_content'];

                        ?>

                        <!-- First Blog Post -->
                        
                <h1 class="page-header">
                 All Post By <?php echo $post_author;   ?>
                    <small>Secondary Text</small>
                </h1>

                    
                        <h2>
                        <a href="#"><?php echo $post_title;   ?></a>
                        </h2>
                        <p class="lead">
                        by <a href="#"><?php echo $post_author;   ?></a>
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
                    
                    $query="UPDATE post SET post_comment_count=post_comment_count+1 ";
                    $query.="WHERE post_id=$the_post_id ";
                    $update_post_comment_count=mysqli_query($connection,$query);
                    
                    
                    }else{
                        echo  "<script>alert('These Feild Should Not Be Empty')</script>";
                
                    }
                    
                    
                    
                }
                
              ?>
               
                <hr>

                <!-- Posted Comments -->
                
          
          </div>
 
 <!-- Blog Sidebar Widgets Column -->
             <?php include "includes/sidebar.php";     ?>
         
        </div>
<!-- /.row -->

        <hr>

 <!-- Footer -->
     <?php include "includes/footer.php";     ?>