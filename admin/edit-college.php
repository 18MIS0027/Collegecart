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
	$couid=$_POST['country'];
	$name=$_POST['name'];
	$type=$_POST['type'];
	$id=intval($_GET['id']);
$sql=mysqli_query($con,"update college set couid='$couid', name='$name',type='$type' where id='$id'");
$_SESSION['msg']="College Updated !!";

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
  <h3><center>Edit College</center></h3>
									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>
									<br>

			<form class="form-horizontal row-fluid" name="college" method="post" >

    

			<form class="form-horizontal row-fluid" name="college" method="post" >
    <div class="form-group">
      <label for="basicinput">Country:</label>
<select name="country" class="form-control" required>
<option value="">Select Country</option> 
<?php $query=mysqli_query($con,"select * from country");
while($row=mysqli_fetch_array($query))
{?>
<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
<?php } ?>
</select>
</div>
<?php
$id=intval($_GET['id']);
$query=mysqli_query($con,"select * from college where id='$id'");
while($row=mysqli_fetch_array($query))
{
?>	  
    <div class="form-group">
      <label for="basicinput">College Name:</label>
      <input type="text" class="form-control" placeholder="Enter college name" name="name" value="<?php echo  htmlentities($row['name']);?>"> 
    </div>     
<div class="form-group">
<label class="control-label" for="basicinput">College type</label>
<div class="controls">
<select   name="type"  id="type" class="form-control" required>
<option value="<?php echo htmlentities($row['type']);?>"><?php echo htmlentities($row['type']);?></option>
<option value="University">University</option>
<option value="College">College</option>
</select>
</div>
</div>  
<?php } ?>  
   <div class="form-group">
      <button type="submit" class="btn btn-primary" style="float:right;" name="submit">Update</button>
       <a href="college.php" class="btn btn-primary" style="float:left;">Back</a>      
    </div> 
									</form>
							</div>     

<br>

<br>
<br>
<br>
<br>
</body>
</html>          

   





   
       									


	
