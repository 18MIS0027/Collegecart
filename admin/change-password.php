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
$sql=mysqli_query($con,"SELECT password FROM  admin where password='".md5($_POST['password'])."'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($con,"update admin set password='".md5($_POST['newpassword'])."'");
$_SESSION['msg']="Password Changed Successfully !!";
}
else
{
$_SESSION['msg']="Old Password not match !!";
}
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
<center><h2><i class="fa fa-pencil"></i>Change admin password</h2></center>
									<?php if(isset($_POST['submit']))
{ ?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Attempted to change admin password :</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>

									<br>
			<form class="form-horizontal row-fluid" name="admin" method="post">
    <div class="form-group">
      <label for="basicinput">Old password:</label>
      <input type="password" class="form-control" placeholder="Enter old password" id="username" name="password"> 
    </div>
    <div class="form-group">
      <label for="basicinput">New password:</label>
      <input type="password" class="form-control" placeholder="Enter new password" id="username" name="newpassword"> 
    </div>         	     
         <div class="form-group">
         <label></label>
           <center><button type="submit" class="btn btn-primary" name="submit">Change admin password</button></center>
            </div>  
    </div> 
									</form>
							</div>     
<br>
<br>
<br>
<br>
</body>
</html>          







	
