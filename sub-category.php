<?php
session_start();
error_reporting(0);
include('includes/config.php');
$cid=intval($_GET['scid']);
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
	                <a href="category.php?cid=<?php echo $row['id'];?>"  class="accordion-toggle collapsed">
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

<div class="container">
					       <?php $sql=mysqli_query($con,"select subcategory  from subcategory where id='$cid'");
while($row=mysqli_fetch_array($sql))
{
    ?>
						<center><h2><?php echo htmlentities($row['subcategory']);?></h2></center>
			<?php } ?>
</div>
<div class="container">
<?php
$ret=mysqli_query($con,"select * from products where subCategory='$cid'");
while ($row=mysqli_fetch_array($ret)) 
{
?>		
<div class="col-md-4">
							<div class="panel panel-info">
								<div class="panel-body">
								<a href="#" class="imageproduct" pid="$pro_id">
									<center><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
				<img  src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="auto" alt=""></a></center>
									</a>
								<center><h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3></center>		
								</div>
								<div class="panel-heading"><h4>Price:Rs <?php echo htmlentities($row['productPrice']);?></h4></div>	
																	<h2 class="btn btn-light" style="float:left;"><a href="login.php?pid=<?php echo htmlentities($row['id']);?>">Add to cart</a></h2>											
																<h2 class="btn btn-light" style="float:right;"><a href="product-details-login.php?pid=<?php echo htmlentities($row['id']);?>">Product details</a></h2>		
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

 <div class="icon-bar">
  <a href="index.php"><i class="fa fa-home"></i></a> 
  <a href="login.php"><i class="fa fa-shopping-bag"></i></a>
  <a href="login.php"><i class="fa fa-shopping-cart"></i></a>
  <a href="login.php"><i class="fa fa-user"></i></a>
  
  
  <a href="#"><i class=""></i></a>   
</div>      


</body>
</html>
