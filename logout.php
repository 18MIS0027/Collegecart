<?php
session_start();
include("includes/config.php");
mysqli_query($con,"UPDATE userlog  SET logout = current_timestamp WHERE userEmail = '".$_SESSION['email']."' ORDER BY id DESC LIMIT 1");
$_SESSION["id"] = "";
$_SESSION["login"] = "";
$_SESSION['phoneno']="";
$_SESSION['email']="";
$_SESSION['name']="";
$_SESSION['college']="";
unset($_SESSION['login']);

$_SESSION['errmsg']="You have successfully logout";
?>
<script language="javascript">
document.location="index.php";
</script>
