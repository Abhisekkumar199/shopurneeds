<?php 
session_start(); 
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
 
    
mysqli_query($conn,"delete from ".$tb." where ".$option."=".$tableid);

$_SESSION['sessionMsg']="Record has been disabled";
 
?>   
    <script>window.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>';</script> 
 <?php ?>	