<?php

if(isset($_POST['checkboxarray'])){
    foreach($_POST['checkboxarray'] as $collect_all_post_id){
        $bulkoption=$_POST['bulk_options'];
        switch($bulkoption){
                
            case 'published':
                $query="UPDATE post SET post_status='{$bulkoption}' WHERE post_id={$collect_all_post_id} ";
                $update_query=mysqli_query($connection,$query);
                query_error($update_query);
                break;
                
            case 'draft':
                $query="UPDATE post SET post_status='{$bulkoption}' WHERE post_id={$collect_all_post_id} ";
                $update_query=mysqli_query($connection,$query);
                query_error($update_query);
                break;    
                
                             
            case 'delete':
                $query="DELETE FROM post WHERE post_id={$collect_all_post_id} ";
                $update_query=mysqli_query($connection,$query);
                query_error($update_query);
                break;    
                
            case 'clone':


            $query = "SELECT * FROM post WHERE post_id = '{$collect_all_post_id}' ";
            $select_post_query = mysqli_query($connection, $query);


          
            while ($row = mysqli_fetch_array($select_post_query)) {
            $post_title         = escape($row['post_title']);
            $post_category_id   = escape($row['post_category_id']);
            $post_date          = escape($row['post_date']); 
            $post_author        = escape($row['post_user']);
            $post_status        = escape($row['post_status']);
            $post_image         = escape($row['post_image']) ; 
            $post_tags          = escape($row['post_tags']); 
            $post_content       = escape($row['post_content']);

          }

                 
      $query = "INSERT INTO post(post_category_id, post_title, post_user, post_date,post_image,post_content,post_tags,post_status) ";
             
      $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 

                $copy_query = mysqli_query($connection, $query);   

               if(!$copy_query ) {

                die("QUERY FAILED" . mysqli_error($connection));
               }   
                 
                 break;

                
                
        }
        
      
    }
}




?>
<form action="" method="post"> 
<table class="table table-bordered table-hover">
                                   
        
        <div id="bulkOptionContainer" class="col-xs-4">

        <select class="form-control" name="bulk_options" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
        
        </select>

        </div> 

            
<div class="col-xs-4">

<input type="submit" name="submit" class="btn btn-success" value="Apply">
<a class="btn btn-primary" href="post.php?source=add_post">Add New</a>

 </div>                           
                                   
                                   
        <thead>
                                        <tr>
                                            <th><input  id="selectAllBoxes" type="checkbox" ></th>
                                            <th>Id</th>
                                            <th>User</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Tags</th>
                                            <th>Comments</th>
                                            <th>Date</th>
                                            <th>View Post</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <th>No Of Time Post View</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>


                                    
<?php
    
    $query="SELECT * FROM post ORDER BY post_id DESC";
   $post_query=mysqli_query($connection,$query);
  while($post_out=mysqli_fetch_assoc($post_query)){
          
         $post_id=$post_out['post_id'];
         $post_user=$post_out['post_user'];
      $post_author=$post_out['post_author'];
         $post_title=$post_out['post_title'];
         $post_category_id=$post_out['post_category_id'];
         $post_status=$post_out['post_status'];
         $post_image=$post_out['post_image'];
         $post_tags=$post_out['post_tags'];
         $post_comment_count=$post_out['post_comment_count'];
         $post_date=$post_out['post_date'];
         $post_view_count=$post_out['post_view_count'];
      
      
      echo"<tr>";
      ?>
        <td><input type="checkbox" class="checkBoxes" name="checkboxarray[]" value="<?php echo $post_id; ?>"></td> 
          <?php
           echo "<td>{$post_id}</td>";
      
      
      
        if(!empty($post_user)){
           echo "<td>{$post_user}</td>";
      }
      
      
           echo "<td>{$post_title}</td>";
      
             
                $query="SELECT * FROM categories WHERE cat_id ={$post_category_id}";   
                $result=mysqli_query($connection,$query);
                query_error($result);
                while($fetch=mysqli_fetch_assoc($result)){
                $cat_id=$fetch['cat_id'];
                $cat_title=$fetch['cat_title'];
                 echo "<td>{$cat_title}</td>";
      
                  }
      
           echo "<td>{$post_status}</td>";
           echo "<td><img width='80' src='../images/$post_image'</td>";
           echo "<td>{$post_tags}</td>";
      $select_comment_count=mysqli_query($connection,"SELECT * FROM comments WHERE comment_post_id={$post_id}");
      $comment_count=mysqli_num_rows($select_comment_count);
    
      
      
           echo "<td> <a href='post_comment.php?id={$post_id}'>{$comment_count}</a></td>";
           echo "<td>{$post_date}</td>";
           echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View Post</a></td>";
        ?>
        <form method="post">

            <input type="hidden" name="post_id" value="<?php echo $post_id ?>">

         <?php   

            echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';

          ?>


        </form>

          <?php
           echo "<td><a class='btn btn-info' href='post.php?source=edit_post&p_id={$post_id}'>edit</a></td>";
           echo"<td><a href='post.php?renum={$post_id}'>{$post_view_count}</a></td>";
      echo"</tr>";
      
      
  }
    
 ?>
                                     
                                         </tbody>            
                                  
                                  
</table>
 
  </form> 
<!-- <script>
$(document).ready(function(){
$('#selectAllBoxes').click(function(event){

if(this.checked) {

$('.checkBoxes').each(function(){

this.checked = true;

});

} else {


$('.checkBoxes').each(function(){

this.checked = false;

});


}

});  });    


</script>
                         -->       
                                
<?php
if(isset($_POST['delete'])){
    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role']='admin'){
    $delete_var=mysqli_real_escape_string($connection,$_POST['post_id']);
    $query="DELETE FROM post WHERE post_id={$delete_var}";
    $delete_query=mysqli_query($connection,$query);
    query_error($delete_query);
    header("Location: ./post.php");
}}}
if(isset($_GET['renum'])){
    
    $renum_var=$_GET['renum'];
    $query="UPDATE post SET post_view_count= 0 WHERE post_id={$renum_var}";
    $delete_query=mysqli_query($connection,$query);
    query_error($delete_query);
    header("Location: ./post.php");
}




?>
                                                                                                               
                                                                                                                                                                           
                                                                                                                                                                                                                                      
                                                                                                                                                                                                                                                                                                 
                                                                                                                                                                                                                                                               
                                                                                                                 
                                