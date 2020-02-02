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
	$description=$_POST['description'];
$sql=mysqli_query($con,"insert into category(categoryName,categoryDescription) values('$category','$description')");
$_SESSION['msg']="Category Created !!";

}

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from category where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Category deleted !!";
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
  <h3><center>Create New Category</center></h3>
									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>
									<br>

			<form class="form-horizontal row-fluid" name="Category" method="post" >

    <div class="form-group">
      <label for="basicinput">Category Name:</label>
      <input type="text" class="form-control" placeholder="Enter category name" name="category" required> 
    </div>     
    <div class="form-group">
      <label for="basicinput">Description:</label>
												<textarea class="form-control" name="description" rows="4" required></textarea>       
    </div>            
   <div class="form-group">
      <center><button type="submit" class="btn btn-primary" name="submit">Create</button></center>
    </div> 
									</form>
							</div>     

<br>
<center><h2><i class="fa fa-clone"></i> Manage Categories</h2></center>
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
                    <td><a href="" class="white-text templatemo-sort-by">Category Id<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Category<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Description<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Created date<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Updated date<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Action<span class="caret"></span></a></td>                                                             
                  </tr>
                </thead>
                <tbody id="myTable">                       
<?php $query=mysqli_query($con,"select * from category");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>						                
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['id']);?></td>
											<td><?php echo htmlentities($row['categoryName']);?></td>
											<td><?php echo htmlentities($row['categoryDescription']);?></td>
											<td> <?php echo htmlentities($row['creationDate']);?></td>
											<td><?php echo htmlentities($row['updationDate']);?></td>
											<td>
											<a href="edit-category.php?id=<?php echo $row['id']?>" ><i class=" fa fa-pencil "> </i></a>
											<a href="category.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class=" fa fa-trash "> </i></a></td>
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

   





   
       									


	
