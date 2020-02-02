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
	$subcat=$_POST['subcategory'];
	$id=intval($_GET['id']);
$sql=mysqli_query($con,"update subcategory set categoryid='$category',subcategory='$subcat',updationDate='$currentTime' where id='$id'");
$_SESSION['msg']="Sub-Category Updated !!";
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
<center><h2><i class="fa fa-pencil"></i>Edit  Subcategories</h2></center>
									<?php if(isset($_POST['submit']))
{ ?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>

									<br>
			<form class="form-horizontal row-fluid" name="subcategory" method="post">
   <div class="form-group">
      <label for="basicinput">Category:</label>
<select name="category" class="custom-select mb-3" required>
<option value="">Select Category</option> 
<?php $query=mysqli_query($con,"select * from category");
while($row=mysqli_fetch_array($query))
{?>
<option value="<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></option>
<?php } ?>
</select>

<?php
$id=intval($_GET['id']);
$query=mysqli_query($con,"select * from subcategory where id='$id'");
while($row=mysqli_fetch_array($query))
{
?>	  
    <div class="form-group">
      <label for="basicinput">Subcategory Name:</label>
      <input type="text" class="form-control" placeholder="Enter subcategory name" name="subcategory" value="<?php echo  htmlentities($row['subcategory']);?>"> 
    </div>
<?php } ?>	         	     
   <div class="form-group">
      <button type="submit" class="btn btn-primary" style="float:right;" name="submit">Update</button>
       <a href="subcategory.php" class="btn btn-primary" style="float:left;">Back</a>      
    </div> 
									</form>
							</div>     
<br>
<br>
<br>
<br>
</body>
</html>          







	
