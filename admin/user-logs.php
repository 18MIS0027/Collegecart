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
		          mysqli_query($con,"delete from userlog where id = '".$_GET['id']."'");      
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
<center><h2><i class="fa fa-users"></i> Manage Userlog</h2></center>
<br>
<div class="container">
    <div class="form-group">
      <label for="basicinput">Search table</label>
<input id="myInput" class="form-control" type="text" placeholder="Search..">
    </div> 
</div>    
<br>

									
<div class="templatemo-content-container">
            <div class="panel panel-default table-responsive"> 	
              <table class="table table-striped table-bordered templatemo-user-table">
                <thead>
                  <tr>
                    <td><a href="" class="white-text templatemo-sort-by"># <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Log Id<span class="caret"></span></a></td>                
                   <td><a href="" class="white-text templatemo-sort-by">User Email <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">User IP adrress<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Login time<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Logout time<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Status<span class="caret"></span></a></td> 
                    <td><a href="" class="white-text templatemo-sort-by">Delete<span class="caret"></span></a></td>                                                                                  
                  </tr>
                </thead>
                <tbody id="myTable">                       
<?php $query=mysqli_query($con,"select * from userlog order by id desc");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>						                
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['id']);?></td>
											<td><?php echo htmlentities($row['userEmail']);?></td>
											<td><?php echo htmlentities($row['userip']);?></td>
											<td> <?php echo htmlentities($row['loginTime']);?></td>
											<td><?php echo htmlentities($row['logout']); ?></td>
										<td><?php $st=$row['status'];

if($st==1)
{
	echo "Successful";
}
else
{
	echo "Failed";
}
										 ?></td>
											<td>
											<a href="user-logs.php?id=<?php echo $row['id']?>&del=delete"><i class=" fa fa-trash "> </i></a></td>											 
											
											
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
