
 
                <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" name="submit" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                    </form>
                </div>
                
                   <!-- Login -->
                <div class="well">
       <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'): ?> 
               <h4>Login as : <?php  echo $_SESSION['username']  ?></h4>     
              <a href="includes/logout.php" class="btn btn-primary">Logout</a>     
           <?php  else: ?>           
                   
                 <h4>Login</h4>
                    <form method="post" action="login.php">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Enter Username">    
                    </div>
                    <!-- /.input-group -->
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">  
                         <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit">
                             Login
                        </button>
                        </span>
                          
                   </div>
                   </form>
                                  
<?php endif; ?>  
                </div>
   
                
                

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                       


                    <?php   

                    $query="SELECT * FROM categories";    /*here to limit the caterg we can add LIMIT then no in query */
                    $result=mysqli_query($connection,$query);
                    ?>
                    <div class="col-lg-12">
                    <ul class="list-unstyled">
                    <?php
                    while($fetch=mysqli_fetch_assoc($result)){
                         $cat_side=$fetch['cat_title'];
                         $cat_id=$fetch['cat_id'];
                        
                    echo"<li><a href='category.php?cat_id={$cat_id}'>{$cat_side}</a></li>";
                     }
                    ?>
                               </ul>
                            </div>

                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
              <?php include "widget.php"  ?>