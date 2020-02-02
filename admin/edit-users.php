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
	$uid=intval($_GET['id']);// user id
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$contactno=$_POST['contactno'];
	
$sql=mysqli_query($con,"update  users set name='$name',email='$email',password='$password',contactno='$contactno' where id='$uid' ");
$_SESSION['msg']="User Updated Successfully !!";
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
<br>
<div class="container">
        <div class="templatemo-content-container">       
<center><h2><i class="fa fa-pencil"></i>Edit Users</h2></center>
									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>

									<br>

									
			<form class="form-horizontal row-fluid" name="edituser" method="post">

<?php 
$query=mysqli_query($con,"select name,email,password,contactno from users where id='$uid'");
while($row=mysqli_fetch_array($query))
{
?>
<div class="form-group">
<label class="control-label" for="basicinput">User Name</label>
<div class="controls">
<input type="text"    name="name"  placeholder="User name" value="<?php echo htmlentities($row['name']);?>" class="form-control" >
</div>
</div>
<div class="form-group">
<label class="control-label" for="basicinput">User Email</label>
<div class="controls">
<input type="email"    name="email"  placeholder="User email" value="<?php echo htmlentities($row['email']);?>" class="form-control" >
</div>
</div>
<div class="form-group">
<label class="control-label" for="basicinput">User Password</label>
<div class="controls">
<input type="text"    name="password"  placeholder="User password" value="<?php echo htmlentities($row['password']);?>" class="form-control" >
</div>
</div>
<div class="form-group">
<label class="control-label" for="basicinput">User Contactno</label>
<div class="controls">
<input type="text"    name="contactno"  placeholder="User contactno" value="<?php echo htmlentities($row['contactno']);?>" class="form-control" >
</div>
</div>

<?php } ?>
<br>
<div class="form-group">
												<button type="submit" name="submit" class="btn btn-primary" style="float:right;">Update</button>
	       <a href="manage-users.php" class="btn btn-primary" style="float:left;">Back</a> 											
										</div>
									</form>
							</div>
						</div>

<br>
<br>
<br>
<br>
<br>											
</body>
</html>
