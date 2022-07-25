<?php   
session_start();
$sitename = '';
$desc = '';
$keys = '';
include("includes/configuration.php"); 
include("includes/currency_display.php");
include("includes/header.php");
include("pages/index.inc.php");
include("includes/footer.php");
?>