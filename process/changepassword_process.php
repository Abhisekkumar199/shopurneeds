<?php
session_start();
include("../config.inc.php");
include("../configuration.php"); 
include("../process/currency_display.php");  
 

$oldpassword=$_REQUEST['oldpassword'];
$newpassword=$_REQUEST['password'];
$confirmpassword=$_REQUEST['cpassword'];
$emailid=$_SESSION['emailid'];

if($newpassword!='') 
{ 
	mysqli_query($conn,"update `".$sufix."user_registration` set `password`='".$newpassword."' where emailid='".$emailid."'") ;
	$_SESSION['sessionMsg']="<font color='green'>Password has been changed</font>";	 
}
?>	

<script>window.location.href='https://localhost/project/shopurneeds/changepassword';</script>