<?php
session_start();
setcookie(session_name(),'',100);
// Commented out the below section to show insufficient logoff
//session_unset();
//session_destroy();
//$_SESSION=array();
header("LOCATION: login.php?a=logout");
?>