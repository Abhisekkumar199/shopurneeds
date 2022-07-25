<?php
session_start();
include("../configuration.php");
// filter by brand
 
$user_id = $_REQUEST['user_id'];
 
$product_id = $_REQUEST['product_id'];
$name = $_SESSION['fnamenew'];
$email_id = $_SESSION['emailid'];
$message = $_REQUEST['message'];
$rating = $_REQUEST['rating'];   
 $sqlcarmodel = mysqli_query($conn,"insert  into ".$sufix."reviews set user_id='".$user_id."',product_id='".$product_id."',rating='".$rating."',fullname='".$name."',email_id='".$email_id."',comments='".$message."',adddate='".date("Y-m-d")."'");

?>
<div class='alert alert-success'>Review submitted successfully.</div>