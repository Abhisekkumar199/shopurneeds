<?php 
session_start();
include("include/configurationadmin.php");
include_once('../include/classes/config.inc.php'); 
 
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];   
$sql  = mysqli_query($conn,"select * from ".$sufix."suppliers where emailid='".$username."' and password='".$password."'") ; 
if(mysqli_num_rows($sql) > 0)
{
    $rows = mysqli_fetch_assoc($sql);  
	$_SESSION['sellerid'] = $rows['id'];		               
    $_SESSION['username'] = $rows['username'];	
	$_SESSION['usertype'] = $rows['type'];   
 
?>
    <script>window.location.href='https://localhost/project/shopurneeds/seller-panel/dashboard';</script>
<?php } else { 
    $_SESSION['message']="<div class='alert alert-danger' role='alert'>Invalid userid/password!</div>";
?> 
    <script>window.location.href='https://localhost/project/shopurneeds/seller-panel/';</script> 
<?php } ?>