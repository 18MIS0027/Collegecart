<?php
// Initialize the session
session_start();
error_reporting(0);
$college=$_SESSION['college'];
include('includes/config.php'); 
// Check if the user is logged in, if not then redirect him to index page
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: index.php");
    exit;
}
?>

<?php
$pid=intval($_GET['pid']);
if(isset($_GET['pid']) && $_GET['action']=="wishlist" )
{
mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','$pid')");
echo'<script> window.location="javascript:history.go(-1)"; </script> '; 
}
		else{
			$message="Product ID is invalid";
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
	</head>
    <body>
<?php include('includes/navbar-user.php');?>
<br>	


<?php $sql=mysqli_query($con,"select * from college where id='$college'");
while($row=mysqli_fetch_array($sql))
{
    ?>
<center><h5><?php echo $row['name'];?></h5></center>
<?php } ?>
<center><h5>-----</h5></center>   
 <center><div class="templatemo-content-widget no-padding" id="portfolio">	
 <br>
<center>	<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
	<h4 class="section-title">Search products by category</h4>
	<div class="sidebar-widget-body m-t-10">
		<div class="accordion">

		            <?php $sql=mysqli_query($con,"select id,categoryName  from category");
while($row=mysqli_fetch_array($sql))
{
    ?>
	    	<div class="accordion-group">
	            <div class="accordion-heading">
	                <a href="category-login.php?cid=<?php echo $row['id'];?>"  class="accordion-toggle collapsed">
	                   <?php echo $row['categoryName'];?>
	                </a>
	            </div>
	          
	        </div>
	        <?php } ?>
	    </div>
	</div>
</div></center>
<br>
</div>
<br>


	
<div class="container">
<?php
$ret=mysqli_query($con,"select * from products where coid='$college' order by id DESC");
while ($row=mysqli_fetch_array($ret)) 
{
?>		
<div class="col-md-4">
							<div class="panel panel-info">
								<div class="panel-body">
								<a href="#" class="imageproduct" pid="$pro_id">
									<center><a href="product-details-login.php?pid=<?php echo htmlentities($row['id']);?>">
				<img  src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="auto" alt=""></a></center>
									</a>
								<center><h3 class="name"><a href="product-details-login.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3></center>		
								</div>
								<div class="panel-heading"><h4>Price:Rs <?php echo htmlentities($row['productPrice']);?></h4></div>	
								<br>
																	<h2 class="btn btn-outline-success" style="float:left;"><a href="home.php?pid=<?php echo htmlentities($row['id']);?>&&action=wishlist">Add to cart</a></h2>																	
																<h2 class="btn btn-outline-success" style="float:right;"><a href="product-details-login.php?pid=<?php echo htmlentities($row['id']);?>">Product details</a></h2>		
<br>
<br>		
<br>																											
								</div>
							</div>
							 <?php } ?>
							</div></center>
<br>
<style>
.img-circle {
position: relative;
width: 170px; 
height: 170px; 
overflow: hidden;
border-radius: 50%;
}
</style>
<div class="templatemo-content-widget no-padding">	
<div>
			<li class="list-group-item list-group-item-success">For any queries mail us at <b>gunasekhar158@gmail.com</b></li>
</div>
<br>
<div class="form-group">
	<div class="col-md-12">							
						<center><h3 class="margin-bottom-15"></h3></center>
   <center> <div class="container">      
<img class="img-circle" src="images/g.jpg">                
            <h5>Gunasekhar A</h5>
            <p class="font-weight-light mb-0">VIT University,Vellore</p>
          </div></center>      
<br>
<div class="form-group">
					<div class="col-md-12">			
						<h3 class="margin-bottom-15">Contact us</h3>		            		            		            
					</div>
				</div>				
		        <div class="form-group">
		          <div class="col-md-12">		       		            <div 
		            	<i class="fa fa-envelope-o"
<i>  gunasekhar158@gmail.com
		            	 </div>		            		            		           				</div>
				</div>				
		        <div class="form-group">
		          <div class="col-md-12">		       		            <div 
		            	<i class="fa fa-phone"
<i>   +91 7995057295
		            	 </div>		         		            		     </div>
</div>
<center><b>Follow me @</b></center>
</div>
<center><h1><a href="https://www.facebook.com/gunasekhar.a.75"><i class="fa fa-facebook"></i></a>
			        		<a href="https://www.youtube.com/channel/UCP4J8bGBiK2WyMREPGh3UTg"><i class="fa fa-youtube"></i></a>
			        		<a href="http://instagram.com/gunasekhar.a.75"><i class="fa fa-instagram"></i></a>
			        		<a href="https://github.com/18MIS0027"><i class="fa fa-github"></i></a></h1></center>          	<br>
	<br>
		</div></center>
	</div>
	</div>
	<br>
	<br>
	<br>
<?php include('includes/iconbar-user.php');?>	      

</body>
</html>
