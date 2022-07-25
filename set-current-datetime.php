<?php 
session_start();
include("includes/configuration.php");  
echo $_SESSION["current-date"] = $_REQUEST['current_date']; 
echo $_SESSION["current-time"] = $_REQUEST['current_time']; 
?>
 