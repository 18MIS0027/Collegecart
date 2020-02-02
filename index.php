<?php
session_start();
error_reporting(0);
include('includes/config.php');
$id=intval($_GET['id']);
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
		echo'<script> window.location="javascript:history.go(-1)"; </script> '; 
		}else{
			$message="Product ID is invalid";
		}
	}
}
?>
<?php
if(isset($_POST['submit']))
{
 		echo'<script> window.location="index.php"; </script> '; 
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
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="login.php"><i class="fa fa-lock"></i> LOGIN</a>
      </li>
    </ul>
  </div>  
</nav>      
<br>	









<div class="container">
<div>
			<li class="list-group-item list-group-item-success"><b>Buy and Sell your Products</b></li>
</div>
</div>

<br>
<div class="container">
  <div class="jumbotron">
    <center><h3>Buy and Sell products in your college campus</h3></center>     
    <p>Call the seller to buy products,and sell your products of cost of your choice</p>
  </div>     
</div>
<!--
<form method="POST" action="index.php">
<div class="container">
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
</div>
       <br>
         <div class="form-group">
           <center><button type="submit" class="btn btn-primary" name="submit">Search</button></center>
</form>
-->


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


	
<center><div class="container">
<?php
$ret=mysqli_query($con,"select * from products order by id DESC");
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
<!--

<br>
					<a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">Cart</a>

<br>
-->


																	<h2 class="btn btn-light" style="float:left;"><a href="login.php?pid=<?php echo htmlentities($row['id']);?>">Add to cart</a></h2>											
																<h2 class="btn btn-light" style="float:right;"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">Product details</a></h2>		
<br>
<br>		
<br>																											
								</div>								
							</div>
							 <?php } ?>
</div>
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
	 <div class="icon-bar">
  <a href="index.php"><i class="fa fa-home"></i></a> 
  <a href="login.php"><i class="fa fa-shopping-bag"></i></a>
  <a href="login.php"><i class="fa fa-shopping-cart"></i></a>
  <a href="login.php"><i class="fa fa-user"></i></a>
  
  
  <a href="#"><i class=""></i></a>   
</div>      

</body>
</html>
