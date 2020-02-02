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
		          mysqli_query($con,"delete from users where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="User deleted !!";
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
<br>
<center><h2><i class="fa fa-users"></i> Manage Users</h2></center>
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
                    <td><a href="" class="white-text templatemo-sort-by">User Id<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Name <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Email<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Password<span class="caret"></span></a></td> 
                     <td><a href="" class="white-text templatemo-sort-by">College Id<span class="caret"></span></a></td>  
                     <td><a href="" class="white-text templatemo-sort-by">Country Id<span class="caret"></span></a></td>                 
                    <td><a href="" class="white-text templatemo-sort-by">Contact no<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Shippping Address<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Billing Address<span class="caret"></span></a></td> 
                    <td><a href="" class="white-text templatemo-sort-by">Reg Date <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Action<span class="caret"></span></a></td>                                                                                                      
                  </tr>
                </thead>
                <tbody id="myTable">                       
<?php $query=mysqli_query($con,"select * from users order by id DESC");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>						                
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['id']);?></td>
											<td><?php echo htmlentities($row['name']);?></td>
											<td><?php echo htmlentities($row['email']);?></td>										
											<td><?php echo htmlentities($row['password']);?></td>											
										<td><?php echo htmlentities($row['coid']);?></td>						
										<td><?php echo htmlentities($row['couid']);?></td>									
											<td> <?php echo htmlentities($row['contactno']);?></td>
	  								<td><?php echo htmlentities($row['shippingAddress'].",".$row['shippingCity'].",".$row['shippingState']."-".$row['shippingPincode']);?></td>
											<td><?php echo htmlentities($row['billingAddress'].",".$row['billingCity'].",".$row['billingState']."-".$row['billingPincode']);?></td>
											<td><?php echo htmlentities($row['regDate']);?></td>
											<td>
										<a href="edit-users.php?id=<?php echo $row['id']?>" ><i class="fa fa-pencil"></i></a>
											<a href="manage-users.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class=" fa fa-trash "> </i></a></td>											
											
										<?php $cnt=$cnt+1; } ?>
										
								</table>
							</div>
<br>
<br>
<br>
<br>

</body>
</html>          


                
                               
							
								
