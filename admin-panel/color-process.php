<?php 
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");  
$id=$_REQUEST['id'];
$option=$_REQUEST['option'];
  
$color_name= $_REQUEST['color_name'];
$color_code = $_REQUEST['color_code'];
$category = $_REQUEST['category']; 
 
$status=$_REQUEST['status']; 

if($option=="Edit")
{	 
    mysqli_query($conn,"update `".$sufix."color_code` set `name`='".$color_name."',`code`='".$color_code."',`cat_id`='".$category."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."' where id='".$id."'") ;
}
else
{   
    for($i=0;$i<count($category);$i++)
    {
         mysqli_query($conn,"insert into `".$sufix."color_code` set `name`='".$color_name."',`code`='".$color_code."',`cat_id`='".$category[$i]."', `displayflag`='".$status."', `adddate`='".date("Y-m-d")."'") ;  
    } 
} 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Attribute Value has been updated</div>";
} 
else 
{  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Attribute Value has been inserted</div>";
} 
?>
<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/color-list';</script> 