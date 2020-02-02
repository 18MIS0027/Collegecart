<?php
// Initialize the session
session_start();
include('includes/config.php'); 
?>
<?php
if(isset($_POST['submit'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;

			}
		}
			echo "<script>alert('Your Cart has been Updated');</script>";
		}
	}
// Code for Remove a Product from Cart
if(isset($_POST['remove_code']))
	{

if(!empty($_SESSION['cart'])){
		foreach($_POST['remove_code'] as $key){
			
				unset($_SESSION['cart'][$key]);
		}
			echo "<script>alert('Product has been removed from cart');</script>";
	}
}
// code for insert product in order table


if(isset($_POST['ordersubmit'])) 
{

if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{

	$quantity=$_POST['quantity'];
	$pdd=$_SESSION['pid'];
	$value=array_combine($pdd,$quantity);
		foreach($value as $qty=> $val34){
mysqli_query($con,"insert into orders(userId,productId,quantity) values('".$_SESSION['id']."','$qty','$val34')");
header('location:payment-method.php');
}
}
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
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="#">MENU</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
</button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="login.php"><i class="fa fa-lock"></i> SIGNIN/SIGNUP</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php"><i class="fa fa-home"></i> HOME</a>
      </li>
    </ul>
  </div>  
</nav>      
<br>	
<center><h2><i class="fa fa-shopping-cart"></i> CART</h2></center>    
<form name="cart" method="post">	
<?php
if(!empty($_SESSION['cart'])){
	?>
	<div class="templatemo-content-container">
 <div class="panel panel-default table-responsive">               	
		<table class="table table-striped table-bordered templatemo-user-table">
			<thead>
				<tr>
					<th>Remove</th>
					<th>Product Image</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Shipping Charge</th>
					<th>Grand Total</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="shopping-cart-btn">
							<span class="">
								<a href="home.php" class="btn btn-upper btn-primary outer-left-xs">Back to Home page</a>
								<input type="submit" name="submit" value="Refresh Cart" class="btn btn-upper btn-primary pull-right outer-right-xs">
							</span>
						</div><!-- /.shopping-cart-btn -->
					</td>
				</tr>
			</tfoot>
			<tbody>
 <?php
 $pdtid=array();
    $sql = "SELECT * FROM products WHERE id IN(";
			foreach($_SESSION['cart'] as $id => $value){
			$sql .=$id. ",";
			}
			$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
			$query = mysqli_query($con,$sql);
			$totalprice=0;
			$totalqunty=0;
			if(!empty($query)){
			while($row = mysqli_fetch_array($query)){
				$quantity=$_SESSION['cart'][$row['id']]['quantity'];
				$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
				$totalprice += $subtotal;
				$_SESSION['qnty']=$totalqunty+=$quantity;

				array_push($pdtid,$row['id']);
//print_r($_SESSION['pid'])=$pdtid;exit;
	?>

				<tr>
					<td>	<button type="submit" class="btn btn-outline-success" name="remove_code[]" value="<?php echo htmlentities($row['id']);?>">Remove</button></td>
					<td class="cart-image">
						<a class="entry-thumbnail" href="product-details.php?pid=<?php echo htmlentities($pd=$row['id']);?>">
						    <img src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" alt="" width="114" height="auto">
						</a>
					</td>
					<td class="cart-product-name-info">
						<h4 class='cart-product-description'><a href="product-details.php?pid=<?php echo htmlentities($pd=$row['id']);?>" ><?php echo $row['productName'];

$_SESSION['sid']=$pd;
						 ?></a></h4>

						
					</td>
					<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo "Rs"." ".$row['productPrice']; ?>.00</span></td>
<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo "Rs"." ".$row['shippingCharge']; ?>.00</span></td>

					<td class="cart-product-grand-total"><span class="cart-grand-total-price"><?php echo ($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge']); ?>.00</span></td>
				</tr>

				<?php } }
$_SESSION['pid']=$pdtid;
				?>
				
			</tbody><!-- /tbody -->
		</table><!-- /table -->
</div>
</div>
		
	




<!--

	<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Shipping Address</span>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
						<?php $qry=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
while ($rt=mysqli_fetch_array($qry)) {
	echo htmlentities($rt['shippingAddress'])."<br />";
	echo htmlentities($rt['shippingCity'])."<br />";
	echo htmlentities($rt['shippingState']);
	echo htmlentities($rt['shippingPincode']);
}

						?>
		
						</div>
					
					</td>
				</tr>
		</tbody>
	</table>
</div>

<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Billing Address</span>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
						<?php $qry=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
while ($rt=mysqli_fetch_array($qry)) {
	echo htmlentities($rt['billingAddress'])."<br />";
	echo htmlentities($rt['billingCity'])."<br />";
	echo htmlentities($rt['billingState']);
	echo htmlentities($rt['billingPincode']);
}

						?>
		
						</div>
					
					</td>
				</tr>
		</tbody>
	</table>
</div>
-->


<div class="col-md-4 col-sm-12 cart-shopping-total">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					
					<div class="cart-grand-total">
						Grand Total :<span class="inner-left-md"><?php echo $_SESSION['tp']="$totalprice". ".00"; ?></span>
					</div>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
							<button type="submit" name="ordersubmit" class="btn btn-primary">PROCCED TO CHEKOUT</button>
						
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table>
	<?php } else {
echo "Your shopping Cart is empty";
		}?>
</div>			
</div>
		</div> 
		</form>

</div>
</div>
</div>
<br>
	<br>
	<br>
<br>
	<br>
	<br>
	 <div class="icon-bar">
  <a href="index.php"><i class="fa fa-home"></i></a> 
  <a href="login.php"><i class="fa fa-shopping-bag"></i></a>
  <a href="my-cart.php"><i class="fa fa-shopping-cart"></i></a>
  <a href="login.php"><i class="fa fa-user"></i></a>
  
  
  <a href="#"><i class=""></i></a>   
</div>      

</body>
</html>
