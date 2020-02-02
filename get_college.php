<?php
include('includes/config.php');
if(!empty($_POST["cou_id"])) 
{
 $id=intval($_POST['cou_id']);
$query=mysqli_query($con,"SELECT * FROM college WHERE couid=$id order by name");
?>
<option value="">Select College</option>
<?php
 while($row=mysqli_fetch_array($query))
 {
  ?>
  <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['name']); ?></option>
  <?php
 }
}
?>
