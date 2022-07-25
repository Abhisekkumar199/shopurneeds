<?php 
session_start();
include("../config.inc.php");
include("../configuration.php"); 

mysqli_query($conn,"delete from `".$sufix."basket` where id='".$_REQUEST['id']."' and bid='".$_SESSION['shopid']."' and productid='".$_REQUEST['pid']."'") ;
 
?>	

	<script>window.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>';</script>