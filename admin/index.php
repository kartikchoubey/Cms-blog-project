<?php   include"includes/header.php"  ?>
 
  

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
                        </div>
                        <!-- /.row -->
                        
                        
                        
                               
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
 <?php                   
        $query="SELECT * FROM post";
        $post_con=mysqli_query($connection,$query);
        $post_count=mysqli_num_rows($post_con);
         echo "<div class='huge'>$post_count</div>"  ;             
                        
                    
      ?>   
                     <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./post.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php                   
        $query="SELECT * FROM comments";
        $comments_con=mysqli_query($connection,$query);
        $comments_count=mysqli_num_rows($comments_con);
         echo "<div class='huge'>$comments_count</div>"  ;             
                        
                    
      ?> 
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="./comment.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                   <?php                   
        $query="SELECT * FROM user";
        $user_con=mysqli_query($connection,$query);
        $user_count=mysqli_num_rows($user_con);
         echo "<div class='huge'>$user_count</div>"  ;             
                        
                    
      ?> 
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="./users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                      <?php                   
        $query="SELECT * FROM categories";
        $cat_con=mysqli_query($connection,$query);
        $cat_count=mysqli_num_rows($cat_con);
         echo "<div class='huge'>$cat_count</div>"  ;             
                        
                    
      ?> 
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="./categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
          <?php 

 $query = "SELECT * FROM post WHERE post_status = 'published' ";
$select_all_published_posts = mysqli_query($connection,$query);
$post_published_count = mysqli_num_rows($select_all_published_posts);
                                     

                                      
$query = "SELECT * FROM post WHERE post_status = 'draft' ";
$select_all_draft_posts = mysqli_query($connection,$query);
$post_draft_count = mysqli_num_rows($select_all_draft_posts);


$query = "SELECT * FROM comments WHERE comment_status = 'unapprove' ";
$unapproved_comments_query = mysqli_query($connection,$query);
$unapproved_comment_count = mysqli_num_rows($unapproved_comments_query);


$query = "SELECT * FROM user WHERE user_role = 'subscriber'";
$select_all_subscribers = mysqli_query($connection,$query);
$subscriber_count = mysqli_num_rows($select_all_subscribers);



    ?>
                
                           
                    
       <div class="row">
                    
    <script type="text/javascript">
      google.load("visualization", "1.1", {packages:["bar"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            
            <?php
                                      
    $element_text = ['All Posts','Draft Posts','Published Post', 'Comments','Pending Comments', 'Users','Subscribers', 'Categories'];       
    $element_count = [$post_count,$post_draft_count,$post_published_count,$comments_count,$unapproved_comment_count,$user_count,$subscriber_count,$cat_count];


    for($i =0;$i <8; $i++) {
    
        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
       
   }
                                                            
            ?>
               
     
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

         chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
                   
                   
  <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                    
                    
                    
                    
                    
                </div>

  

            </div>
            <!-- /.container-fluid -->

        </div>
        
    
        <!-- /#page-wrapper -->

    <?php include "includes/footer.php" ?>

   