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
                                        <small>Author</small>
                                    </h1>
                                </div>
         
<?php
if(isset($_GET['source']))
{
$source=$_GET['source'];
}else
{
$source="";
}
switch($source){

case 'add_post':
include"includes/add_post.php";   
break;
case 'edit_post':
include"includes/edit_post.php";  
break;
case '56':
echo"56";
break;
case '400':
echo"400";
break;
default:
include"includes/view_all_comment.php";   
break;
}

?>

                                
                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.container-fluid -->

                </div>
        <!-- /#page-wrapper -->
         <?php   include"includes/footer.php"  ?>

   