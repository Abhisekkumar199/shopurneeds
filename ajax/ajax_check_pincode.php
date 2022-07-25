<?php
session_start();
include("includes/configuration.php");

header('Access-Control-Allow-Origin: *');
$checkpincodesql = mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."pincode where pincode='".$_REQUEST['pincode']."'"));
if($checkpincodesql>0) { 
echo "<span style='color:#060'>Allowed</span>";
} else {
echo "<span style='color:#F00'>Not allowed</span>";	
}
?>