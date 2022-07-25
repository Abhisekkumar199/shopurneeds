<?php 
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include("include/configurationadmin.php");  
$id=$_REQUEST['id'];
$option=$_REQUEST['option'];

$cityname=$_REQUEST['cityname']; 
$cityname_in_arabic=$_REQUEST['cityname_in_arabic']; 
$status=$_REQUEST['status']; 

 mysqli_query($conn,"SET NAMES 'utf8'"); 
mysqli_query($conn,'SET CHARACTER SET utf8');
if($option=="Edit")
{	 
    mysqli_query($conn,"update `".$sufix."city` set `cityname`='".$cityname."',`cityname_in_arabic`='".$cityname_in_arabic."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."' where cityid='".$id."'") ;
}
else
{  
    mysqli_query($conn,"insert into `".$sufix."city` set `cityname`='".$cityname."',`cityname_in_arabic`='".$cityname_in_arabic."', `displayflag`='".$status."', `adddate`='".date("Y-m-d")."'") ; 
} 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>City has been updated</div>";
} 
else 
{  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>City has been inserted</div>";
} 
?>
<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/city-list';</script> 