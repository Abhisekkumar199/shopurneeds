<?php 
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");  
$id=$_REQUEST['id'];
$option=$_REQUEST['option'];

$attributename=$_REQUEST['attributename'];
$attributevarname=$_REQUEST['attributevarname'];  
$status=$_REQUEST['status']; 

if($option=="Edit")
{	 
    mysqli_query($conn,"update `".$sufix."attributes` set `attributename`='".$attributename."', `attributevarname`='".$attributevarname."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."' where atr_id='".$id."'") ;
     
}
else
{  
    mysqli_query($conn,"insert into `".$sufix."attributes` set `attributename`='".$attributename."', `attributevarname`='".$attributevarname."',`add_user`='".$_SESSION['username']."', `displayflag`='".$status."', `adddate`='".date("Y-m-d")."'") ; 
     
} 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Attribute has been updated</div>";
} 
else 
{  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Attribute has been inserted</div>";
} 
?>
<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/attribute-list';</script> 