<?php
session_start();
error_reporting(0);
include("include/config.php");
if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=md5($_POST['password']);
$ret=mysqli_query($con,"SELECT * FROM admin WHERE username='$username' and password='$password'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$_SESSION['loggedin-admin']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');                          $_SESSION["loggedin-admin"] = true;  
header("location:admin.php");
exit();
}
else
{
$_SESSION['errmsg']="Invalid username or password";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:index.php");
exit();
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
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
   
</button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    

</div>     
</nav>
<br>
<div class="container">
  <h2><center><i class="fa fa-lock"></i> Admin Login</center></h2>
  <form method="post" action="index.php">
        <div class="form-group">
      <label>Username:</label>
      <input type="text" class="form-control" placeholder="Enter username" name="username" id="inputEmail"> 
    </div>
    <div class="form-group">
      <label>Password:</label>
      <input type="password" class="form-control" placeholder="Enter password" name="password" id="inputPassword>    
    </div>
    <br>
    <br>
    <br>
         <div class="form-group">
         <label></label>
           <center><button type="submit" class="btn btn-primary" name="submit">Admin login</button></center>
            </div>  
    </form>
    </div>

</body>
</html>



	
						

						


	
