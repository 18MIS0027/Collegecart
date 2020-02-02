<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
	if(isset($_POST['update']))
	{
		$name=$_POST['name'];
		$contactno=$_POST['contactno'];
		$query=mysqli_query($con,"update users set name='$name',contactno='$contactno' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Your info has been updated');</script>";
echo'<script> window.location="my-account.php"; </script> '; 
		}
	}
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{
$sql=mysqli_query($con,"SELECT password FROM  users where password='".$_POST['cpass']."' && id='".$_SESSION['id']."'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($con,"update users set password='".$_POST['newpass']."', updationDate='$currentTime' where id='".$_SESSION['id']."'");
echo "<script>alert('Password Changed Successfully !!');</script>";
echo'<script> window.location="my-account.php"; </script>';
}
else
{
	echo "<script>alert('Current Password not match !!');</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">
	    <title>Gunasekhar</title>
		<?php include('includes/library-user.php');?>   
<script type="text/javascript">
function valid()
{
if(document.chngpwd.cpass.value=="")
{
alert("Current Password Filed is Empty !!");
document.chngpwd.cpass.focus();
return false;
}
else if(document.chngpwd.newpass.value=="")
{
alert("New Password Filed is Empty !!");
document.chngpwd.newpass.focus();
return false;
}
else if(document.chngpwd.cnfpass.value=="")
{
alert("Confirm Password Filed is Empty !!");
document.chngpwd.cnfpass.focus();
return false;
}
else if(document.chngpwd.newpass.value!= document.chngpwd.cnfpass.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.chngpwd.cnfpass.focus();
return false;
}
return true;
}
</script>

	</head>
    <body>
<?php include('includes/navbar-user.php');?>
<br>	
<div class="container">
  <h2><center><i class="fa fa-pencil"></i> My profile</center></h2>
<?php
$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query))
{
?>
					<form class="register-form" role="form" method="post">
        <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control"  value="<?php echo $row['name'];?>" id="name"name="name">  
    </div>
        <div class="form-group">
      <label for="exampleInputEmail1">Email id:</label>
      <input type="email" class="form-control"  value="<?php echo $row['email'];?>" id="exampleInputEmail1">  
    </div>
        <div class="form-group">
      <label for="Contact No:">Contact No:</label>
      <input type="text" class="form-control"  value="<?php echo $row['contactno'];?>" id="contactno"name="contactno">  
    </div>
					  <button type="submit" name="update" class="btn-upper btn btn-primary checkout-page-button">Update</button>
					</form>
					<?php } ?>
				</div>	

<br>	
<br>
<div class="container">
  <h4><center><i class="fa fa-pencil"></i> Change password</center></h4>
  <br>
					<form class="register-form" role="form" method="post" name="chngpwd" onSubmit="return valid();">
        <div class="form-group">
      <label for="Current Password:">Current password:</label>
      <input type="password" class="form-control" placeholder="Enter current password"  id="cpass"name="cpass">  
    </div>
    <div class="form-group">
      <label for="New password:">New Password:</label>
      <input type="password" placeholder="Enter new password"  class="form-control" id="newpass"name="newpass">  
    </div>
    <div class="form-group">
      <label for="Confirm Password:">Confirm new password:</label>
      <input type="password" class="form-control" placeholder="Enter new password"   id="cnfpass"name="cnfpass">  
    </div>
					  <button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button">Update</button>
					</form> 
			</div>
			<br>
			<br>
<?php include('includes/myaccount-sidebar.php');?>				
<br>
<br>
<br>
<br>
<br>
<?php include('includes/iconbar-user.php');?>

</body>
</html>
<?php } ?>
	
	
	
	







