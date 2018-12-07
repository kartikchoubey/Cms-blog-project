
<?php  include "includes/database.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php  include "admin/function.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 <?php
   if(isset($_POST['submit'])){
       
      $to= 'chaubeykartik@gmail.com';
       $subject =wordwrap($_POST['subject'],70);
        $content =$_POST['content'];
       $header=$_POST['email'];
       mail($to,$subject,$content,$header);
       $message= "THANKS!!";
          
   }else{
       $message="";
   }
            
             
      ?>        
 <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your email">
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
                        </div>
                         <div class="form-group">
                            <label for="Content" class="sr-only">Content</label>
                          <!-- <input type="password" name="password" id="key" class="form-control" placeholder="Password"> -->
                        <textarea id="Content" class="form-control" name="content" placeholder="Write Here" cols="50" rows="10" ></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 <h4 class="text-center"><?php echo $message;   ?></h4>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
