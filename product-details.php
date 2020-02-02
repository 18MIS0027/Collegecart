<?php 
session_start();
error_reporting(0);
include('includes/config.php');
$pid=intval($_GET['pid']);
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
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="#">MENU</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
</button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link"
href="index.php"><i class="fa fa-home"></i> HOME</a>
      </li>        
      <li class="nav-item">
        <a class="nav-link" href="login.php"><i class="fa fa-lock"></i> SIGNIN/SIGNUP</a>
      </li>
      
    </ul>
  </div>  
</nav>      
<br>		
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
			
																	<center><h2 class="btn btn-outline-success" style="float:center;"><a href="login.php">Add to cart</a></h2>	</center>																
																						
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
 <div class="icon-bar">
  <a href="index.php"><i class="fa fa-home"></i></a> 
  <a href="login.php"><i class="fa fa-shopping-bag"></i></a>
  <a href="login.php"><i class="fa fa-shopping-cart"></i></a>
  <a href="login.php"><i class="fa fa-user"></i></a>
  
  
  <a href="#"><i class=""></i></a>   
</div>      

</body>
</html>










