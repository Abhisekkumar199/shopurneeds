<?php 
session_start();
header("Access-Control-Allow-Origin: *");
include("../configuration.php");  

$exit = mysqli_query($conn,"select * from ".$sufix."newsletter_email where email = '".$_REQUEST['strEmail']."'");
$row = mysqli_num_rows($exit);
if($row>0)
{ 
    echo "<font color='red' style='float: left;'>Email Id already exist!</font>";
} 
else 
{
    $insert = mysqli_query($conn,"INSERT INTO ".$sufix."newsletter_email (`email`) values ('".$_REQUEST['strEmail']."')");
    if($insert) 
    { 
        echo "<font color='green' style='float: left;'>You are subscribed successfully</font>";
    } 
    else { echo "Error!"; } 
}
?>