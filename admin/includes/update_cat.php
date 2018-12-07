
<div class="col-xs-6">

<form action="" method="post">
<div class="form-group">
<label for="cat-title">Update_categories</label>  




<?php  
$query="SELECT * FROM categories WHERE cat_id='{$cat_id}'";   
$result=mysqli_query($connection,$query);

while($fetch=mysqli_fetch_assoc($result)){
$cat_id=$fetch['cat_id'];
$cat_title=$fetch['cat_title'];
?>
<input type="text" class="form-control" name="cat_title_edit" value="<?php echo $cat_title; ?>">

     <?php } ?>
      
      
<?php //update query/////////////////////////////////////////////

if(isset($_POST['update'])){
$cat_update=escape($_POST['cat_title_edit']);
$query="UPDATE categories SET cat_title='{$cat_update}' WHERE cat_id={$cat_id}";
$result_one=mysqli_query($connection,$query);
if(!$result_one){
die("not exicuted".mysqli_error($connection));
}
header("location: categories.php");

}
?>


</div>
<div class="form_group">
<input type="submit" name="update" class="btn btn-primary" value="Update Category">
</div>
</form>     

</div>
