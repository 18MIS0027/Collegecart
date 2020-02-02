<?php
// Initialize the session
session_start();
error_reporting(0);
include('includes/config.php'); 
// Check if the user is logged in, if not then redirect him to index page
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: index.php");
    exit;
}
?>
<?php

/*
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
*/
$pid=intval($_GET['id']);// product id
if(isset($_POST['submit']))
{
	$productname=$_POST['productName'];
	$productimage1=$_FILES["productimage1"]["name"];
//$dir="admin/productimages";
//unlink($dir.'/'.$pimage);
	move_uploaded_file($_FILES["productimage1"]["tmp_name"],"admin/productimages/$pid/".$_FILES["productimage1"]["name"]);
	$sql=mysqli_query($con,"update  products set productImage1='$productimage1' where id='$pid' ");
$_SESSION['msg']="Product Image Updated Successfully !!";

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gunasekhar</title>
		<?php include('includes/library-user.php');?>	    
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
<center><h2><i class="fa fa-pencil"></i>Update product image 1</h2></center>				
									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>



									<br />

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">

<?php 

$query=mysqli_query($con,"select productName,productImage1 from products where id='$pid'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
  


?>
<div class="form-group">
<label class="control-label" for="basicinput">Product Name:</label>
<div class="controls">
<input type="text"    name="productName"  readonly value="<?php echo htmlentities($row['productName']);?>" class="form-control" required>
</div>
</div>


<div class="form-group">
<label class="control-label" for="basicinput">Current Product Image1:</label>
<div class="controls">
<img src="admin/productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($row['productImage1']);?>" width="200" height="100"> 
</div>
</div>



<div class="form-group">
<label class="control-label" for="basicinput">New Product Image1:</label>
<div class="controls">
<input type="file" name="productimage1" id="productimage1" value="" class="" required>
</div>
</div>


<?php } ?>
<br>

	<div class="from-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn btn-primary" style="float:right;">Update</button>
<a class="btn btn-primary" style="float:left;" href = "javascript:history.go(-3)">Back</a>

											</div>
										</div>
									</form>
							</div>
						</div>
<?php include('includes/iconbar-user.php');?>			
</body>
</html>
<?php  ?>
