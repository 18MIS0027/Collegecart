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
 $country=$_POST['country'];
	$name=$_POST['name'];
	$type=$_POST['type'];
$sql=mysqli_query($con,"insert into college(couid,name,type) values('$country','$name','$type')");
$_SESSION['msg']="College Created !!";

}

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from college where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="College deleted !!";
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
  <h3><center>Create New College</center></h3>

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>
									<br>

			<form class="form-horizontal row-fluid" name="college" method="post" >
    <div class="form-group">
      <label for="basicinput">Country:</label>
<select name="country" class="form-control" required>
<option value="">Select Country</option> 
<?php $query=mysqli_query($con,"select * from country order by name ");
while($row=mysqli_fetch_array($query))
{?>
<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
<?php } ?>
</select>
</div>

    <div class="form-group">
      <label for="basicinput">College Name:</label>
      <input type="text" class="form-control" placeholder="Enter college name" name="name" required> 
    </div>     
<div class="form-group">
<label class="control-label" for="basicinput">College type</label>
<div class="controls">
<select   name="type"  id="type" class="form-control" required>
<option value="">Select</option>
<option value="University">University</option>
<option value="College">College</option>
</select>
</div>
</div>    
   <div class="form-group">
      <center><button type="submit" class="btn btn-primary" name="submit">Create</button></center>
    </div> 
									</form>
							</div>     

<br>
<center><h2><i class="fa fa-clone"></i> Manage Colleges</h2></center>
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

<center><div class="templatemo-content-container">
            <div class="panel panel-default table-responsive"> 	
              <table class="table table-striped table-bordered templatemo-user-table">
                <thead>
                  <tr>
                    <td><a href="" class="white-text templatemo-sort-by"># <span class="caret"></span></a></td>
                  <td><a href="" class="white-text templatemo-sort-by">Country Id<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">College Id<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">College Name<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">College Type<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Created date<span class="caret"></span></a></td>

                    <td><a href="" class="white-text templatemo-sort-by">Action<span class="caret"></span></a></td>                                                             
                  </tr>
                </thead>
                <tbody id="myTable">                       
<?php $query=mysqli_query($con,"select * from college order by name");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>						                
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
<td><?php echo htmlentities($row['couid']);?></td>                                          <td><?php echo htmlentities($row['id']);?></td>
											<td><?php echo htmlentities($row['name']);?></td>
											<td><?php echo htmlentities($row['type']);?></td>
											<td> <?php echo htmlentities($row['creation_date']);?></td>
											<td>
											<a href="edit-college.php?id=<?php echo $row['id']?>" ><i class=" fa fa-pencil "> </i></a>
											<a href="college.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class=" fa fa-trash "> </i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
																				
								</table>
							</div></center>
<br>
<br>
<br>
<br>
</body>
</html>          

   





   
       									


	
