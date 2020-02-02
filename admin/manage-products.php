<?php
// Initialize the session
session_start();
include('include/config.php'); 
// Check if the admin is logged in, if not then redirect him to admin page
if(!isset($_SESSION["loggedin-admin"]) || $_SESSION["loggedin-admin"] !== true){
    header("location: index.php");
    exit;
}
?>
<?php
if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from products where id = '".$_GET['id']."'");
	$dproductid=$_GET['id'];
array_map('unlink', array_filter((array) array_merge(glob("productimages/$dproductid/*")))); 

$dir="productimages/$dproductid";
rmdir("productimages/".$dproductid);
	
echo'<script> window.location="javascript:history.go(-1)"; </script> ';               
		  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gunasekhar</title>
<?php include('include/library-admin.php');?>
	<?php include('include/table-search-admin.php');?>	
</head>
<body>
<?php include('include/navbar-admin.php');?>
<br>
<center><h2><i class="fa fa-pencil"></i>Add New Products</h2></center>
        <center><a class="btn btn-primary"
href="insert-product.php"> Add New Product</a></center>
												
<br>
<center><h2><i class="fa fa-shopping-bag"></i> Manage Products</h2></center>
<br>
<div class="container">
    <div class="form-group">
      <label for="basicinput">Search table</label>
<input id="myInput" class="form-control" type="text" placeholder="Search..">
    </div> 
</div>    
<br>
	<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>
<div class="templatemo-content-container">
            <div class="panel panel-default table-responsive"> 	
              <table class="table table-striped table-bordered templatemo-user-table">
                <thead>
                  <tr>                   
                    <td><a href="" class="white-text templatemo-sort-by"># <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Product Id<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Product College Id<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Product Seller Mobile Number<span class="caret"></span></a></td> 
                    <td><a href="" class="white-text templatemo-sort-by">Product Seller Email Id<span class="caret"></span></a></td> 
                    <td><a href="" class="white-text templatemo-sort-by">Product name<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Category<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Subcategory<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Company name<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Product creation date<span class="caret"></span></a></td>                    
                    <td><a href="" class="white-text templatemo-sort-by">Action<span class="caret"></span></a></td>                                                             
                  </tr>
                </thead>
                <tbody id="myTable">       

<?php $query=mysqli_query($con,"select products.*,category.categoryName,subcategory.subcategory from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory order by id desc");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                                        <td><?php echo htmlentities($row['id']);?></td>
<td><?php echo htmlentities($row['coid']);?></td>
											<td><?php echo htmlentities($row['userphoneno']);?></td>											
											<td><?php echo htmlentities($row['useremail']);?></td>											
											<td><?php echo htmlentities($row['productName']);?></td>
											<td><?php echo htmlentities($row['categoryName']);?></td>
											<td> <?php echo htmlentities($row['subcategory']);?></td>
											<td><?php echo htmlentities($row['productCompany']);?></td>
											<td><?php echo htmlentities($row['postingDate']);?></td>
											<td>
											<a href="edit-products.php?id=<?php echo $row['id']?>" ><i class="fa fa-pencil"></i></a>
											<a href="manage-products.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
								</table>
							</div>
						</div>						

<br>
<br>
<br>
<br>
</body>
</html>
