<?php
session_start(); 
include("include/configurationadmin.php"); 
include("include/mailfunction.php");  
 
if($_REQUEST['credit']!=0)
{	
$totalwallet=$_REQUEST['credit']+$_REQUEST['wallet'];

	$query = mysqli_query($conn,"update `".$sufix."user_registration` set `wallet`='".$totalwallet."' where id='".$_REQUEST['userid']."'");

	mysqli_query($conn,"insert into `".$sufix."user_wallet` (user_id,orderid,type,credit,adddate) values('".$_REQUEST['userid']."','".$_REQUEST['orderid']."','".$_REQUEST['reason']."','".$_REQUEST['credit']."',NOW())");

	$_SESSION['sessionMsg']="Record Updated Successfully";
?>
 <script>window.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>';</script>

<?php

//	header("Location:https://www.shopropay.com/admin-panel/manage_user_wallet.php?id=".$_REQUEST['userid']);

	exit();

}
if($_REQUEST['debit']!=0)
{	
$totalwallet=$_REQUEST['wallet']-$_REQUEST['debit'];

	$query = mysqli_query($conn,"update `".$sufix."user_registration` set `wallet`='".$totalwallet."' where id='".$_REQUEST['userid']."'");
	
	mysqli_query($conn,"insert into `".$sufix."user_wallet` (user_id,orderid,type,debit,adddate) values('".$_REQUEST['userid']."','".$_REQUEST['orderid']."','".$_REQUEST['reason']."','".$_REQUEST['debit']."',NOW())");

 
	$_SESSION['sessionMsg']="Record Updated Successfully";
?>

 <script>window.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>';</script>

<?php  
	//	header("Location:https://www.shopropay.com/admin-panel/manage_user_wallet.php?id=".$_REQUEST['userid']);

	exit();

}

?>	