<?php
session_start();
include("includes/session.php");
include("../configuration.php"); 
$emailid=$_REQUEST['emailid']; 
   
    $_SESSION['selected_address']=$_REQUEST['selected_address']; 
	mysqli_query($conn,"update ".$sufix."basket set emailid='".$_SESSION['emailid']."' where bid='".$_SESSION['shopid']."'");
		   
  
 
?>	
 <script>window.location.href='<?php echo URL;?>/checkout/order';</script>