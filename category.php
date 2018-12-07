
<?php include "includes/database.php";    ?>
<?php include "admin/function.php";    ?>
<?php include "includes/header.php";    ?>
 <!-- Navigation -->
    
    <?php include "includes/navigation.php";    ?>

<!-- Page Content -->
    <div class="container">

        <div class="row">
 <!-- Blog Entries Column -->
            <div class="col-md-8">

             
                        
                        
                     
                        <?php
                
                            if(isset($_GET['cat_id'])){
                                $cat_id=$_GET['cat_id'];
                            
if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
     $stmt1=mysqli_prepare($connection,"SELECT post_id,post_title,post_user,post_date,post_image,post_content FROM post WHERE post_category_id=?");
   
}else{
     $stmt2=mysqli_prepare($connection,"SELECT post_id,post_title,post_user,post_date,post_image,post_content FROM post WHERE post_category_id=? AND post_status=?");
       $status='published';
   
}
              
         if(isset($stmt1)){
             mysqli_stmt_bind_param($stmt1,"i",$cat_id);
             mysqli_stmt_execute($stmt1);
            mysqli_stmt_bind_result($stmt1,$post_id,$post_title,$post_user,$post_date,$post_image,$post_content);
            $stmt=$stmt1;
            mysqli_stmt_store_result($stmt);
         } else{
              mysqli_stmt_bind_param($stmt2,"is",$cat_id,$status);
             mysqli_stmt_execute($stmt2);
             mysqli_stmt_bind_result($stmt2,$post_id,$post_title,$post_user,$post_date,$post_image,$post_content);
            $stmt=$stmt2;
             mysqli_stmt_store_result($stmt);
         }    
                     if(mysqli_stmt_num_rows($stmt)=== 0){
                      echo"<h1 class='text-center'>NO POST AVAILABLE!!</h1>";
                }
                 else{     
                                 
         
                    ?>
                        <h1 class="page-header">
                    Page Heading
                    <small>Secondary Te</small>
                </h1>
                      <?php 
                                
                        while($row=mysqli_stmt_fetch($stmt)){
                     
                        ?>

                        <!-- First Blog Post -->
                        <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title;   ?></a>
                        </h2>
                        <p class="lead">
                        by <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_user;   ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span><?php echo " ".$post_date;   ?> </p>
                        <hr>
                        <img  class="img-responsive" src="images/<?php echo $post_image;    ?>" alt="">
                        <hr>
                        <p><?php echo $post_content;   ?></p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>



                        <?php      
                        
                     

                        }
                            }
                            }else{
                                header("Location: index.php");
                            }

                        ?>
            </div>
 
 <!-- Blog Sidebar Widgets Column -->
             <?php include "includes/sidebar.php";     ?>
         
        </div>
<!-- /.row -->

        <hr>

 <!-- Footer -->
     <?php include "includes/footer.php";     ?>