<?php   include"includes/header.php"  ?>
   
<?php   Delete_query();  ?>

<?php   insert_query();  ?>

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
                       
                       
                       
                        <div class="col-xs-6">

                        <form action="" method="post">
                        <div class="form-group">
                        <label for="cat-title">Add category</label>     
                        <input type="text" class="form-control" name="cat_title">
                        </div>
                        <div class="form_group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
                        </div>
                        </form>     
                        </div>

        

        <div class="col-xs-6">


        <table class="table table-bordered table-hover">
        <thead>
        <tr>
        <th>ID</th>
        <th> Category Title</th>
         <th> Delete</th>
          <th> Edit</th>
        </tr>
        </thead>
                        <tbody>
                       <?php   display_cat(); ?>
                       </tbody>
                        </table>
  </div>

<?php
if(isset($_GET['edit'])){
$cat_id=$_GET['edit'];
    include "includes/update_cat.php";
}

?> 
</div>
                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.container-fluid -->

                </div>
        <!-- /#page-wrapper -->
         <?php   include"includes/footer.php"  ?>

   