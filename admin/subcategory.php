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
if(isset($_POST['submit']))
{
	$category=$_POST['category'];
	$subcat=$_POST['subcategory'];
$sql=mysqli_query($con,"insert into subcategory(categoryid,subcategory) values('$category','$subcat')");
$_SESSION['msg']="SubCategory Created !!";

}

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from subcategory where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="SubCategory deleted !!";
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
<div class="container">
<br>
  <h3><center>Create New Subcategory</center></h3>
									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>

			<form class="form-horizontal row-fluid" name="subcategory" method="post" >
    <div class="form-group">
      <label for="basicinput">Category:</label>
<select name="category" class="custom-select mb-3" required>
<option value="">Select Category</option> 
<?php $query=mysqli_query($con,"select * from category");
while($row=mysqli_fetch_array($query))
{?>
<option value="<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></option>
<?php } ?>
</select>

    <div class="form-group">
      <label for="basicinput">Subcategory Name:</label>
      <input type="text" class="form-control" placeholder="Enter subcategory name" name="subcategory" required> 
    </div>  
    </div>   
   <div class="form-group">
      <center><button type="submit" class="btn btn-primary" name="submit">Create</button></center>
    </div> 
									</form>
							</div> 
<br>
<center><h2><i class="fa fa-clone"></i> Manage Subcategories</h2></center>
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
                    <td><a href="" class="white-text templatemo-sort-by">Sub-category Id<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Category<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Subcategory<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Created date<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Updated date<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Action<span class="caret"></span></a></td>                                                             
                  </tr>
                </thead>
                <tbody id="myTable">                       
<?php $query=mysqli_query($con,"select subcategory.id,category.categoryName,subcategory.subcategory,subcategory.creationDate,subcategory.updationDate from subcategory join category on category.id=subcategory.categoryid");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>               
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['id']);?></td>
											<td><?php echo htmlentities($row['categoryName']);?></td>
											<td><?php echo htmlentities($row['subcategory']);?></td>
											<td> <?php echo htmlentities($row['creationDate']);?></td>
											<td><?php echo htmlentities($row['updationDate']);?></td>
											<td>
											<a href="edit-subcategory.php?id=<?php echo $row['id']?>" ><i class=" fa fa-pencil "> </i></a>
											<a href="subcategory.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class=" fa fa-trash "> </i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
																				
								</table>
							</div>
<br>
<br>
<br>
<br>
</body>
</html>          





