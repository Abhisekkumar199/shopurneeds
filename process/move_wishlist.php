<?php 
session_start(); 
include("../configuration.php");  


$sele = mysqli_query($conn,"select id from `".$sufix."favorite_product` where `user_id`='".$_SESSION['useridse']."' and `product_id`='".$_REQUEST['pid']."'");
if(mysqli_num_rows($sele)>0) 
{ 
} 
else 
{ 
	mysqli_query($conn,"insert into `".$sufix."favorite_product` (`user_id`,`product_id`,`adddate`) values ('".$_SESSION['useridse']."','".$_REQUEST['pid']."',NOW())");
}
mysqli_query($conn,"delete from `".$sufix."basket` where id='".$_REQUEST['id']."' and bid='".$_SESSION['shopid']."' and productid='".$_REQUEST['pid']."'");
 
?>	

        <script>window.location.href='<?php echo $_SERVER['HTTP_REFERER'];?>';</script>