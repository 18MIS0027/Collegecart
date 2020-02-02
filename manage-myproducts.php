<?php
// Initialize the session
session_start();
include('includes/config.php'); 
// Check if the user is logged in, if not then redirect him to index page
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: index.php");
    exit;
}
?>
<?php
$user=$_SESSION['phoneno'];
if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from products where id = '".$_GET['id']."'");
$dproductid=$_GET['id'];
array_map('unlink', array_filter((array) array_merge(glob("admin/productimages/$dproductid/*")))); 

$dir="admin/productimages/$dproductid";
rmdir("admin/productimages/".$dproductid);
	
echo'<script> window.location="javascript:history.go(-1)"; </script> ';                       
		  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gunasekhar</title>
<?php include('includes/library-user.php');?>	
<?php include('includes/table-search.php');?>	

</head>
<body>
<?php include('includes/navbar-user.php');?>
<br>
<center><h2><i class="fa fa-pencil"></i>Sell New Product</h2></center>
        <center><a class="btn btn-primary"
href="insert-myproduct.php"> Add New Product</a></center>
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
                    <td><a href="" class="white-text templatemo-sort-by">Product name<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Category<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Subcategory<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Company name<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Product creation date<span class="caret"></span></a></td>                    
                    <td><a href="" class="white-text templatemo-sort-by">Action<span class="caret"></span></a></td>                                                             
                  </tr>
                </thead>
                <tbody id="myTable">       

<?php $query=mysqli_query($con,"select products.*,category.categoryName,subcategory.subcategory from products join category on category.id=products.category join subcategory on subcategory.id=products.subcategory where products.userphoneno='$user' order by id desc");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['productName']);?></td>
											<td><?php echo htmlentities($row['categoryName']);?></td>
											<td> <?php echo htmlentities($row['subcategory']);?></td>
											<td><?php echo htmlentities($row['productCompany']);?></td>
											<td><?php echo htmlentities($row['postingDate']);?></td>
											<td>
                                            
											<a href="edit-products.php?id=<?php echo $row['id']?>" ><i class="fa fa-pencil"></i></a>
											<a href="manage-myproducts.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a>
                                            
                                            </td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
								</table>
							</div>
						</div>						

<br>
<br>
<br>
<br>

<?php include('includes/iconbar-user.php');?>
</body>
</html>
