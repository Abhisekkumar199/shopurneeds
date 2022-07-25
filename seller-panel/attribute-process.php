<?php 
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include("include/configurationadmin.php");  
$id=$_REQUEST['id'];
$option=$_REQUEST['option'];

$attributename=$_REQUEST['attributename'];
$attributename_in_hebrew=$_REQUEST['attributename_in_hebrew'];  
$status=$_REQUEST['status']; 

 mysqli_query($conn,"SET NAMES 'utf8'"); 
mysqli_query($conn,'SET CHARACTER SET utf8');
if($option=="Edit")
{	 
    mysqli_query($conn,"update `".$sufix."attributes` set `attributename`='".$attributename."', `attributename_in_hebrew`='".$attributename_in_hebrew."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."' where atr_id='".$id."'") ;
     
}
else
{  
    mysqli_query($conn,"insert into `".$sufix."attributes` set `attributename`='".$attributename."', `attributename_in_hebrew`='".$attributename_in_hebrew."',`add_user`='".$_SESSION['username']."', `displayflag`='".$status."', `adddate`='".date("Y-m-d")."'") ; 
     
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