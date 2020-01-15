<?php
session_start();
error_reporting(0);
include('include/dbconnection.php');
session_start();
$_SESSION['ulogin']=="";
session_unset();
$_SESSION['msg']="You have logged out successfully..!";
?>
<script language="javascript">
document.location="index.php";
</script>