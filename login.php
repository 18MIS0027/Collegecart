<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Code for User login
if(isset($_POST['submit']))
{
   $phoneno=$_POST['phoneno'];
   $password=$_POST['password'];
$query=mysqli_query($con,"SELECT * FROM users WHERE contactno='$phoneno' and password='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['phoneno']=$num['contactno'];
$_SESSION['email']=$num['email'];
$_SESSION['name']=$num['name'];
$_SESSION['college']=$num['coid'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['email']."','$uip','$status')");
$_SESSION["login"] = true;  
header("location:home.php");
exit();
}
else
{
$email=$_POST['email'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
header("location:login.php");
$_SESSION['errmsg']="Invalid email id or Password";
exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">
	    <title>Gunasekhar</title>
	<?php include('includes/library-user.php');?>
<script src="js/validate-form.js"></script>
</head>
    <body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="#">MENU</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
</button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      
      <li class="nav-item">
        <a class="nav-link" href="index.php">BACK TO WEBSITE PORTAL</a>
</li>
     <li class="nav-item">
        <a class="nav-link" href="signup.php">SIGNUP</a>
</li>
</div>     
</nav>
<br>
<div class="container">
  <h2><center><i class="fa fa-lock"></i> Signin form</center></h2>
  <center><h7 style="color:red;" >Signup if you don't have an account</h7></center>
	<span style="color:red;" >
<?php
echo htmlentities($_SESSION['errmsg']="");
?>
	</span>  
  <form method="post" name='login' onSubmit="return loginformValidation();" action="login.php">
        <div class="form-group">
      <label for="phoneno">Mobile number:</label>
      <input type="number" class="form-control" placeholder="Enter mobile number" name="phoneno" id="phoneno" required>  
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" placeholder="Enter password" name="password" id="password" required>
       <br>
         <div class="form-group">
           <center><button type="submit" class="btn btn-primary" name="submit">Login</button></center>
<br>
<!--
<center><a href="forgot-password.php">Forgot your Password?</a></center>
<br> 
-->
<center><a href="signup.php">Don't have an account?Signup</a></center>            
            </div> 
<br>
    </div>           
    </form>
    </div>
	
<br>	
<br>
<br>
<br>
 <div class="icon-bar">
  <a href="index.php"><i class="fa fa-home"></i></a> 
  <a href="login.php"><i class="fa fa-shopping-bag"></i></a>
  <a href="login.php"><i class="fa fa-shopping-cart"></i></a>
  <a href="login.php"><i class="fa fa-user"></i></a>
  
  
  <a href="#"><i class=""></i></a>   
</div>      

<br>
</body>
</html>
