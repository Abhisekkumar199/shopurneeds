<?php  
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");  

$id=$_REQUEST['id'];
$option=$_REQUEST['option']; 
   
$deal_name=$_REQUEST['deal_name'];  
$deal_percentage=$_REQUEST['deal_percentage']; 
$start_date=$_REQUEST['start_date']; 
$start_time=$_REQUEST['start_time']; 
$end_date=$_REQUEST['end_date'];  
$end_time=$_REQUEST['end_time'];  
 $status = $_REQUEST['status'];  
$prod_ids = $_REQUEST['prod_ids'];  

if($option=="Edit")
{  
    mysqli_query($conn,"update `".$sufix."deal` set `name`='".$deal_name."',`percentage`='".$deal_percentage."',`start_date`='".$start_date."',`start_time`='".$start_time."',`end_date`='".$end_date."',end_time='".$end_time."', `products`='".$prod_ids."',`cat_id`='".$cat_ids."', `display_flag`='".$status."'    where id='".$id."'") ;
}
else
{    
    mysqli_query($conn,"insert into `".$sufix."deal` set `name`='".$deal_name."',`percentage`='".$deal_percentage."',`start_date`='".$start_date."',`start_time`='".$start_time."',`end_date`='".$end_date."',end_time='".$end_time."', `products`='".$prod_ids."',`cat_id`='".$cat_ids."', `display_flag`='".$status."',`add_user`='".$_SESSION['username']."', `add_date`='".date("Y-m-d")."'") ;  
} 
  
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Deal has been updated</div>";
} 
else 
{  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Deal has been inserted</div>";
} 
?>	

<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/deal-list';</script>  