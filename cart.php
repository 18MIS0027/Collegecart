<?php
// Initialize the session
session_start();
include('includes/config.php'); 
// Check if the admin is logged in, if not then redirect him to admin page
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: index.php");
    exit;
}
?>

<?php
$wid=intval($_GET['del']);
if(isset($_GET['del']))
{
$query=mysqli_query($con,"delete from wishlist where id='$wid'");
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
<center><h2><i class="fa fa-shopping-cart"></i> Cart</h2></center>


		<table class="table">	
			<tbody>
<?php
$ret=mysqli_query($con,"select products.productName as pname,products.productName as proid,products.productImage1 as pimage,products.productPrice as pprice,wishlist.productId as pid,wishlist.id as wid from wishlist join products on products.id=wishlist.productId where wishlist.userId='".$_SESSION['id']."'");
$num=mysqli_num_rows($ret);
	if($num>0)
	{
while ($row=mysqli_fetch_array($ret)) {

?>

				<tr>
					<td class="col-md-2"><img src="admin/productimages/<?php echo htmlentities($row['pid']);?>/<?php echo htmlentities($row['pimage']);?>" alt="<?php echo htmlentities($row['pname']);?>" width="120" height="auto"></td>
					<td class="col-md-1">
						<div class="product-name"><a href="product-details-login.php?pid=<?php echo htmlentities($pd=$row['pid']);?>"><?php echo htmlentities($row['pname']);?></a></div>
<?php $rt=mysqli_query($con,"select * from productreviews where productId='$pd'");
$num=mysqli_num_rows($rt);
{
?>						
						<?php } ?>
						<div class="price">Rs. 
							<?php echo htmlentities($row['pprice']);?>.00
						</div>
					</td>
					<td class="col-md-2">
						<a href="cart.php?del=<?php echo htmlentities($row['wid']);?>" onClick="return confirm('Are you sure you want to delete?')" class="btn-upper btn btn-primary"><h6>Delete</h6><i class="fa fa-trash"></i></a>
					</td>					

					</td>
				</tr>
				<?php } } else{ ?>
				<tr>
					<td style="font-size: 18px; font-weight:bold ">Your Cart is Empty</td>

				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>		
	</div>
		</div>
	
</div>
</div>
<br>
<br>
<br>
<br>
<br>

<br>

<?php include('includes/iconbar-user.php');?>





</body>
</html>
