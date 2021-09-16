<?php
session_start();
include("config.php");
$_SESSION['login']=="";
date_default_timezone_set('America/Chicago');
$ldate=date( 'd-m-Y h:i:s A', time () );
session_unset();
$_SESSION['errmsg']="You have successfully logged out.";
?>
<script language="javascript">
document.location="index.php";
</script>