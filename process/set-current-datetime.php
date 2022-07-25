<?php 
session_start();
include("includes/configuration.php");  
echo $_SESSION["current-date"] =date("Y-m-d",strtotime($_REQUEST['current_date'])); 
echo $_SESSION["current-time"] =date("H:i",strtotime($_REQUEST['current_time'])); 
?>
 