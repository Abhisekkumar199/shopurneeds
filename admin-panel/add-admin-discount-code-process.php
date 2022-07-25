<?php  
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");  

$id=$_REQUEST['id'];
$option=$_REQUEST['option']; 
 
$autoapply=$_REQUEST['autoapply'];  
$disc_name=$_REQUEST['disc_name'];  
$disc_code=$_REQUEST['disc_code'];
$discountvalue=$_REQUEST['discountvalue'];
$disc_type=$_REQUEST['disc_type']; 
$validfrom=$_REQUEST['validfrom']; 
$validto=$_REQUEST['validto'];  
$status=$_REQUEST['status'];  
$productname = $_REQUEST['productname']; 
$productname1 = implode(',',$productname);

$sellername = $_REQUEST['sellername'];

$sellername1 = implode(',',$sellername);

if($option=="Edit")
{  
    mysqli_query($conn,"update `".$sufix."discountcodes` set `autoapply`='".$autoapply."',`disc_name`='".$disc_name."',`disc_code`='".$disc_code."',`discountvalue`='".$discountvalue."',disc_type='".$disc_type."', `validfrom`='".$validfrom."',`validto`='".$validto."', `product`='".$productname1."',`seller_id`='".$sellername1."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."'   where codeid='".$id."'") ;
}
else
{  
    mysqli_query($conn,"insert into `".$sufix."discountcodes` set `autoapply`='".$autoapply."',`disc_name`='".$disc_name."',`disc_code`='".$disc_code."',`discountvalue`='".$discountvalue."',disc_type='".$disc_type."', `validfrom`='".$validfrom."',`validto`='".$validto."', `product`='".$productname1."',`seller_id`='".$sellername1."', `displayflag`='".$status."',`add_user`='".$_SESSION['username']."',`add_user_coupon`='Admin Discount', `adddate`='".date("Y-m-d")."'") ;  
} 
 
 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Discount code has been updated</div>";
} 
else 
{  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Discount code has been inserted</div>";
} 
?>	

<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/admin-discount-code-list';</script>  