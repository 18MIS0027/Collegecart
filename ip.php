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
if(isset($_POST['submit']))
{			
	$productimage1=$_FILES["productimage1"]["name"];
	$productimage2=$_FILES["productimage2"]["name"];
	$productimage3=$_FILES["productimage3"]["name"];
//for getting product id
$query=mysqli_query($con,"select max(id) as pid from products");
	$result=mysqli_fetch_array($query);
	 $productid=$result['pid'];
	$dir="admin/productimages/$productid";
if(!is_dir($dir)){
		mkdir("admin/productimages/".$productid);
	}	move_uploaded_file($_FILES["productimage1"]["tmp_name"],"admin/productimages/$productid/".$_FILES["productimage1"]["name"]);
	move_uploaded_file($_FILES["productimage2"]["tmp_name"],"admin/productimages/$productid/".$_FILES["productimage2"]["name"]);
	move_uploaded_file($_FILES["productimage3"]["tmp_name"],"admin/productimages/$productid/".$_FILES["productimage3"]["name"]);			
$sql=mysqli_query($con,"update products set productImage1='$productimage1',productImage2='$productimage2',productImage3='$productimage3' where id='$productid' "); 
$_SESSION['msg']="Product Inserted Successfully !!";
echo'<script> window.location="manage-myproducts.php"; </script> '; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Insert Product</title>
<?php include('includes/library-user.php');?>	
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<script>
function getSubcat(val) {
	$.ajax({
	type: "POST",
	url: "get_subcat.php",
	data:'cat_id='+val,
	success: function(data){
		$("#subcategory").html(data);
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
<?php include('includes/navbar-user.php');?>
<br>
<div class="container">
        <div class="templatemo-content-container">
<center><h2><i class="fa fa-pencil"></i>Insert product</h2></center>
							</div>
									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>

									<br>
				<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">
	<div class="form-group">
<label class="control-label" for="basicinput">Product Image1</label>
<div class="controls">
<input type="file" name="productimage1" id="productimage1" value="">
</div>
</div>

<!--
<div class="form-group">
<label class="control-label" for="basicinput">Product Image2</label>
<div class="controls">
<input type="file" name="productimage2" id="productimage2" value="">
</div>
</div>



<div class="form-group">
<label class="control-label" for="basicinput">Product Image3</label>
<div class="controls">
<input type="file" name="productimage3" id="productimage3" value="">
</div>
</div>
-->
<br>
	<div class="form-group">
											<div class="controls">
												<center><button type="submit" name="submit" class="btn btn-primary">Insert</button></center>
									</form>
							</div>
<br>
<br>
<br>
<br>
<br>
</body>
</html>
						









