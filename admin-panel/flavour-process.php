<?php 
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");  
$id=$_REQUEST['id'];
$option=$_REQUEST['option'];
  
$name= $_REQUEST['name'];  
$status=$_REQUEST['status']; 

if($option=="Edit")
{	 
    mysqli_query($conn,"update `".$sufix."flavour` set `name`='".$name."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."' where id='".$id."'") ;
}
else
{   
      
    mysqli_query($conn,"insert into `".$sufix."flavour` set `name`='".$name."',`displayflag`='".$status."', `adddate`='".date("Y-m-d")."'") ;  
      
}  
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Flavour has been updated</div>";
} 
else 
{  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Flavour has been inserted</div>";
} 
?>
<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/flavour-list';</script> 