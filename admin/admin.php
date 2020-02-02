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

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Gunasekhar</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include('include/library-admin.php');?>
</head>
<body>
<?php include('include/navbar-admin.php');?>

<br>
<br>
<br>
<center><h1>Admin Portal</h1></center>

<div class="form-group">
					<div class="col-md-12">			
						<h1 class="margin-bottom-15"></h1>
<section class="testimonials text-center bg-light">
<br>
    <div class="container">      
<img class="img-circle" src="../images/g.jpg">
    
            
            <h5>Gunasekhar A</h5>
            <p class="font-weight-light mb-0">VIT University,Vellore</p>
<br>	            		            		            
					</div>
				</div>		        		            		    
  </div>
<br>
<br>
<br>

<style>
.img-circle {

position: relative;
width: 135px; 
height: 135px; 
overflow: hidden;
border-radius: 50%;

}

</style>
</body>
</html>
