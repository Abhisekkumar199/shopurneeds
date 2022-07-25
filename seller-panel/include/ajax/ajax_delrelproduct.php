<?php
include_once('../classes/config.inc.php');
include_once('../classes/database.inc.php');
include_once('../libraries/function_inc.php');



if($_GET["pid"]!='' && $_REQUEST['ptype']=='Product')
{ 
	//echo "update `baby_product` set relatedproducts='' where id='".$_REQUEST['pid']."'";
	mysqli_query($conn,"update `flip_product` set relatedproducts='' where id='".$_REQUEST['pid']."'") ;	
	
} 

?>