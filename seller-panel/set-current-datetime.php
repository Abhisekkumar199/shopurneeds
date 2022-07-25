<?php 
session_start();
include("includes/configuration.php");  
echo $_SESSION["current-date"] =strtotime($_REQUEST['current_date']); 
echo $_SESSION["current-time"] =strtotime($_REQUEST['current_time']); 
?>
 