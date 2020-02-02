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
$cid=intval($_GET['cid']);
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






<div class="side-menu animate-dropdown outer-bottom-xs">       
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i>Sub Categories</div>        
    <nav class="yamm megamenu-horizontal" role="navigation">
  
        <ul class="nav">
            <li class="dropdown menu-item">
              <?php $sql=mysqli_query($con,"select id,subcategory  from subcategory where categoryid='$cid'");

while($row=mysqli_fetch_array($sql))
{
    ?>
                <a href="sub-category-login.php?scid=<?php echo $row['id'];?>" class="dropdown-toggle"><i class="icon fa fa-desktop fa-fw"></i>
                <?php echo $row['subcategory'];?></a>
                <?php }?>
                        
</li>
</ul>
    </nav>
</div>
</div>








<br>

<center><div class="container">
					       <?php $sql=mysqli_query($con,"select categoryName  from category where id='$cid'");
while($row=mysqli_fetch_array($sql))
{
    ?>
						<center><h2><?php echo htmlentities($row['categoryName']);?></h2></center>
			<?php } ?>
</div>
<div class="container">
<?php
$ret=mysqli_query($con,"select * from products where category='$cid' and coid='$college'");
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
																	<h2 class="btn btn-outline-success" style="float:left;"><a href="category-login.php?pid=<?php echo htmlentities($row['id']);?>&&action=wishlist">Add to cart</a></h2>																	
																<h2 class="btn btn-outline-success" style="float:right;"><a href="product-details-login.php?pid=<?php echo htmlentities($row['id']);?>">Product details</a></h2>		
<br>
<br>		
<br>																											
								</div>
							</div>
							 <?php } ?>
							</div></center>

<br>
<br>
<br>
<br>
<?php include('includes/iconbar-user.php');?>

</body>
</html>
