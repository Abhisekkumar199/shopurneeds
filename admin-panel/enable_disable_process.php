<?php 
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");  

$option=$_REQUEST['option'];
$status=$_REQUEST['status'];
$tableid=$_REQUEST['id'];
$id_showroom=$tableid;
$tb=$_REQUEST['tb'];
$productname=$_REQUEST['productname'];
$productcode=$_REQUEST['productcode'];
$page=$_REQUEST['page'];
$menuid = $_REQUEST['menuid'];
$catid = $_REQUEST['catid'];
$chkstatus=$_REQUEST['chkstatus'];
 
if($tb=='baby_imageupload')
{
	$link=$_REQUEST['link']."?id=".$_REQUEST['pid']."&page=".$page; 
}
else if($tb=='shopurneeds_category')
{
	$link=$_REQUEST['link']."?cat_id=".$catid; 
} 
else
{ 
    $link=$_REQUEST['link']."?&page=".$page."&menuid=".$menuid; 
}   


 	if($tb=='shopurneeds_product')
	{ 
		mysqli_query($conn,"update ".$tb." set `displayflag`='".$status."' where ".$option."=".$tableid);
		mysqli_query($conn,"update ".$sufix."baby_product_variant set `displayflag`='".$status."' where pid=".$tableid); 
	}
	else
	{   
	    if($tb=='shopurneeds_brand')
    	{ 
    		mysqli_query($conn,"update shopurneeds_product set `displayflag`='".$status."' where bid=".$tableid); 
    	}
    	
    	if($tb=='shopurneeds_suppliers')
    	{ 
    		mysqli_query($conn,"update shopurneeds_product set `displayflag`='".$status."' where seller_id=".$tableid); 
    	}
	    
		mysqli_query($conn,"update ".$tb." set `displayflag`='".$status."' where ".$option."=".$tableid);
	} 
	if($status==0)
	{
	    $_SESSION['sessionMsg']="Record has been disabled";
	    
	}
	else
	{	$_SESSION['sessionMsg']="Record has been enabled";
	     
	}  
?>
         
    <script>window.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>';</script> 
 <?php ?>	