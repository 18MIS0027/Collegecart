<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Code user Registration
if(isset($_POST['submit']))
{
$name=$_POST['fullname'];
$email=$_POST['emailid'];
$contactno=$_POST['contactno'];
$couid=$_POST['country'];
$coid=$_POST['college'];
$password=$_POST['password'];
$query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' or contactno='$contactno'");
$num=mysqli_fetch_array($query);
if($num>0)
{
echo "<script>alert('Mobile number or Email you entered is already registered');</script>";
}
else{
$query=mysqli_query($con,"insert into users(name,email,contactno,password,couid,coid) values('$name','$email','$contactno','$password','$couid','$coid')");
if($query)
{
	echo "<script>alert('You are successfully registered,Now you can signin into your account');</script>";
echo'<script> window.location="login.php"; </script> '; 
}
else{
echo "<script>alert('Not registered something went worng');</script>";
}
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

<script type="text/javascript">
function valid()
{
 if(document.register.password.value!= document.register.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.register.confirmpassword.focus();
return false;
}
return true;
}
</script>
<script>
function getcollege(val) {
	$.ajax({
	type: "POST",
	url: "get_college.php",
	data:'cou_id='+val,
	success: function(data){
		$("#college").html(data);
	}
	});
}
function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>	
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
        <a class="nav-link" href="login.php">SIGNIN</a>
</li>
</div>     
</nav>
<br>
<div class="container">
  <h2><center><i class="fa fa-lock"></i> Signup form</center></h2>
  <center><h7 style="color:red;" >Signin if you already have an account</h7></center>
	<span style="color:red;" >
<?php
echo htmlentities($_SESSION['errmsg']);
?>
<?php
echo htmlentities($_SESSION['errmsg']="");
?>
	</span>  
  <form method="post" id="register_form" action="signup.php"> 



        <div class="form-group">
      <label for="fullname">Fullname:</label>
      <input type="text" class="form-control" placeholder="Enter fullname" name="fullname" id="fullname" required>  
    </div>    
    <div class="form-group">
      <label for="contactno">Mobile number:</label>
      <input type="text" class="form-control" placeholder="Enter mobile number" name="contactno" maxlength="10" id="contactno" required>
    </div> 
    <div class="form-group">
      <label for="exampleInputEmail2">Email id:</label>
      <input type="email" class="form-control" placeholder="Enter email" name="emailid" id="email" required>
    </div>    
<div class="form-group">
<label class="control-label" for="basicinput">Country:</label>
<div class="controls">
<select name="country" class="form-control" onChange="getcollege(this.value);"  required>
<option value="">Select Country</option> 
<?php $query=mysqli_query($con,"select * from country order by name");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
<?php } ?>
</select>
</div>
</div>

									
<div class="form-group">
<label class="control-label" for="basicinput">College:</label>
<div class="controls">
<select name="college" id="college" class="form-control" required>
</select>
</div>
</div>

         
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" placeholder="Enter password" name="password" id="password" required>    
    </div>      
   
    <div class="form-group">
      <label for="confirmpassword">Confirm password:</label>
      <input type="password" class="form-control" placeholder="Confirm password" name="confirmpassword" id="confirmpassword" required>    
    </div>   
<br>  
         <div class="form-group">
           <center><button type="submit" class="btn btn-primary" name="submit" id="reg_btn">Signup</button></center>
<br>
  <center><a href="login.php">Already have an account?Signin</a></center>             
            </div>            
    </form>
    </div>
		
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
<script src="validate.js"></script>
<br>
</body>
</html>
