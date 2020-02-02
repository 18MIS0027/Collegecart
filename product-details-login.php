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
 <div class="templatemo-content-widget no-padding" id="portfolio">	
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
	    <br>
	</div>
</div></center>
</div>
<br>
<div class="templatemo-content-widget no-padding">
<?php 
$ret=mysqli_query($con,"select * from products where id='$pid'");
while($row=mysqli_fetch_array($ret))
{
				
?>

							<center><h1><?php echo htmlentities($row['productName']);?></h1></center>
																	
<center><img  src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="auto" alt=""></a></center>
<br>
										<center>	<span class="price-strike">Price: Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span></center>
										
												<center><span class="value"><span class="label">Product Brand :</span><?php echo htmlentities($row['productCompany']);?></span>	</center>				
<br>
			
																	<center><h2 class="btn btn-outline-success" style="float:center;"><a href="product-details-login.php?pid=<?php echo htmlentities($row['id']);?>&&action=wishlist">Add to cart</a></h2></center>	
                                                                    <br>
                                                                    <br>															
																						
<?php $cid=$row['category'];
			$subcid=$row['subCategory']; } ?>
</div>
			
<?php 
$ret=mysqli_query($con,"select users.* from users inner join products on products.userphoneno=users.contactno where  products.id='$pid'");
while($row=mysqli_fetch_array($ret))
{
				
?>

							<center><h2>Seller Details</h2></center>
<center><div class="templatemo-content-widget no-padding" id="portfolio1">	
<br>			
		
<div class="form-group">
<div class="col-md-12">		       		                       <h4><i class="fa fa-user"> <?php echo htmlentities($row['name']);?></i></h4>
</div>		            		            		           </div>

<div class="form-group">
<div class="col-md-12">		       		                       <h4><a class="fa fa-phone" href="tel: +91 <?php echo htmlentities($row['contactno']);?>">+91 <?php echo htmlentities($row['contactno']);?></a></h4>
</div>		            		            		           </div>
<div class="form-group">
<div class="col-md-12">		       		                       <h4><a class="fa fa-envelope" href="mailto:<?php echo htmlentities($row['email']);?>"> <?php echo htmlentities($row['email']);?></a></h4>
</div>		            		            		           </div>
<br>			
																	<?php } ?>

			</div>	</center>						
<br>
<br>
<br>
<br>
<br>
<?php include('includes/iconbar-user.php');?>
</body>
</html>




					
