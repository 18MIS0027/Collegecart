<?php
// Initialize the session
session_start();
include('include/config.php'); 
// Check if the admin is logged in, if not then redirect him to admin page
if(!isset($_SESSION["loggedin-admin"]) || $_SESSION["loggedin-admin"] !== true){
    header("location: index.php");
    exit;
}
?>

<?php
if(isset($_POST['submit']))
{
	$category=$_POST['category'];
	$description=$_POST['description'];
	$id=intval($_GET['id']);
$sql=mysqli_query($con,"update category set categoryName='$category',categoryDescription='$description',updationDate='$currentTime' where id='$id'");
$_SESSION['msg']="Category Updated !!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gunasekhar</title>
<?php include('include/library-admin.php');?>
</head>
<body>
<?php include('include/navbar-admin.php');?>
<div class="container">
<br>
<center><h2><i class="fa fa-pencil"></i>Edit  Categories</h2></center>
  
									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>
									<br>  
			<form class="form-horizontal row-fluid" name="Category" method="post" >
<?php
$id=intval($_GET['id']);
$query=mysqli_query($con,"select * from category where id='$id'");
while($row=mysqli_fetch_array($query))
{
?>	  
    <div class="form-group">
      <label for="basicinput">Category Name:</label>
      <input type="text" class="form-control" placeholder="Enter category name" name="category" value="<?php echo  htmlentities($row['categoryName']);?>"> 
    </div>     
    <div class="form-group">
      <label for="basicinput">Description:</label>
												<textarea class="form-control" name="description" rows="4"><?php echo  htmlentities($row['categoryDescription']);?></textarea>       
    </div>  
<?php } ?>	            
   <div class="form-group">
      <button type="submit" class="btn btn-primary" style="float:right;" name="submit">Update</button>
       <a href="category.php" class="btn btn-primary" style="float:left;">Back</a>      
    </div> 
									</form>
							</div>     
<br>
<br>
<br>
<br>
</body>
</html>          

  
  
  
  
  
	
