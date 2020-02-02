<?php
session_start();
$_SESSION['loggedin-admin']="";
unset($_SESSION['loggedin-admin']);

$_SESSION['errmsg']="You have successfully logout";
?>
<script language="javascript">
document.location="index.php";
</script>
