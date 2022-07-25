<?php  
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");  

$id=$_REQUEST['id'];
$option=$_REQUEST['option']; 
 
$showto=$_REQUEST['showto'];  
$name=$_REQUEST['name'];  
$link=$_REQUEST['link'];
$upids=$_REQUEST['upids'];
$colorCodeBackground=$_REQUEST['colorCodeBackground']; 
$colorCodeContent=$_REQUEST['colorCodeContent']; 
$status=$_REQUEST['status'];    

$validfrom=$_REQUEST['validfrom'];  
$validto=$_REQUEST['validto']; 
$codCharge=$_REQUEST['codCharge']; 
$shippingCharge=$_REQUEST['shippingCharge']; 
$single_product=$_REQUEST['single_product'];  

if($_REQUEST['option']=="Edit" && $_REQUEST['id']!='')

{	
     
	mysqli_query($conn,"update `".$sufix."promotion` set `name`='".$name."', `link`='".$link."', `colorCodeBackground`='".$colorCodeBackground."',`single_product`='".$single_product."', `colorCodeContent`='".$colorCodeContent."', `upids`='".$upids."', `codCharge`='".$codCharge."', `shippingCharge`='".$shippingCharge."',`validfrom`='".$validfrom."', `validto`='".$validto."',`showto`='".$showto."',`editdate`='".date("Y-m-d")."',`displayflag`='".$status."' where id='".$_REQUEST['id']."'") ;
	
    mysqli_query($conn,"update  `".$sufix."category` set  `categoryname`='".$name."', `cat_slug`='".$link."' where promotionId='".$id."'");  
}

else

{ 

	mysqli_query($conn,"insert into `".$sufix."promotion` set `name`='".$name."', `single_product`='".$single_product."',`link`='".$link."', `colorCodeBackground`='".$colorCodeBackground."', `colorCodeContent`='".$colorCodeContent."', `upids`='".$upids."', `codCharge`='".$codCharge."', `shippingCharge`='".$shippingCharge."',`validfrom`='".$validfrom."', `validto`='".$validto."',`showto`='".$showto."',`adddate`='".date("Y-m-d")."',`displayflag`='".$status."'");
	$id = mysql_insert_id();
	 
    mysqli_query($conn,"insert into `".$sufix."category` (`promotionId`,`categoryname`,`parent`, `cat_dept`, `adddate`,`displayflag`,`add_user`, `cat_slug`) values ('".$id."','".$name."','0','1','".date("Y-m-d")."', '0', '".$_SESSION['username']."', '".$link."')");   
}
 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Promotion has been updated</div>";
} 
else 
{  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Promotion has been inserted</div>";
} 
?>	

<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/promotion-list';</script>  