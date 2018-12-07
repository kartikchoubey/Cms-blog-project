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
                                        <small>Post Comments</small>
                                    </h1>
                                </div>
          <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Author</th>
                                            <th>Comment</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>In Responce To</th>
                                            <th>Date</th>
                                            <th>Approve</th>
                                            <th>Unapprove</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
<?php
    
    if(isset($_GET['id'])){
       $comment_post_id= $_GET['id'];
    
    $query="SELECT * FROM comments WHERE comment_post_id={$comment_post_id}";
   $post_query=mysqli_query($connection,$query);
  while($post_out=mysqli_fetch_assoc($post_query)){
          
         $comment_id=$post_out['comment_id'];
         $comment_post_id=$post_out['comment_post_id'];
         $comment_author=$post_out['comment_author'];
         $comment_email=$post_out['comment_email'];
         $comment_content=$post_out['comment_content'];
         $comment_status=$post_out['comment_status'];
         $comment_date=$post_out['comment_date'];
      
      
      echo"<tr>";
           echo "<td>{$comment_id}</td>";
           echo "<td>{$comment_author}</td>";
           echo "<td>{$comment_content}</td>";
      
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
           echo "<td>{$comment_email}</td>";
           echo "<td>{$comment_status}</td>";
      
             $query="SELECT * FROM post WHERE post_id={$comment_post_id}";
             $result=mysqli_query($connection,$query);
             while($row=mysqli_fetch_assoc($result)){
                 
                 $post_id=$row['post_id'];
                 $post_title=$row['post_title'];
                 
                  echo "<td><a href='../post.php?p_id= $post_id'>{$post_title}</a></td>";
                 
             }
       
      
       echo "<td>{$comment_date}</td>";
            echo "<td><a href='post_comment.php?id={$comment_post_id}&approve=$comment_id'>Approve</a></td>";
            echo "<td><a href='post_comment.php?id={$comment_post_id}&unapprove=$comment_id'>Unapprove</a></td>";
            echo "<td><a href='post_comment.php?id={$comment_post_id}&delete= $comment_id'>delete</a></td>";

   
      echo"</tr>";
      
      
  }}
    
 ?>
                                       </tbody>            
                                  
                                    
</table>
                               
                                
<?php
if(isset($_GET['delete'])){
    
    $delete_comment=$_GET['delete'];
    $query="DELETE FROM comments WHERE comment_id={$delete_comment}";
    $delete_query=mysqli_query($connection,$query);
    query_error($delete_query);
    header("Location: post_comment.php?id={$comment_post_id}");
}

?>
                                
<?php
if(isset($_GET['approve'])){
    
    $delete_comment=$_GET['approve'];
    $query="UPDATE comments SET comment_status='approve' WHERE comment_id= $delete_comment";
    $delete_query=mysqli_query($connection,$query);
    query_error($delete_query);
    header("Location: post_comment.php?id={$comment_post_id}");
}

?>
                                 
<?php
if(isset($_GET['unapprove'])){
    
    $delete_comment=$_GET['unapprove'];
    $query="UPDATE comments SET comment_status='unapprove' WHERE comment_id=$delete_comment";
    $delete_query=mysqli_query($connection,$query);
    query_error($delete_query);
    header("Location: post_comment.php?id={$comment_post_id}");
}

?>
  
                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.container-fluid -->

                </div>
        <!-- /#page-wrapper -->
         <?php   include"includes/footer.php"  ?>                                                                                                                   
                                                                                                                                                                           
                                                                                                                                                                                                                                      
                                                                                                                                                                                                                                                                                                 
                                                                                                                                                                                                                                                               
                                                                                                                 
                                