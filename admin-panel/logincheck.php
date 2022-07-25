<?php 
session_start();
include("include/configurationadmin.php");
include_once('../include/classes/config.inc.php'); 
 
$username=$_REQUEST['username'];
$password=md5($_REQUEST['password']);  
$sql  = mysqli_query($conn,"select * from ".$sufix."admin where username='".$username."'  ") ; 
if(mysqli_num_rows($sql) > 0)
{
    $rows = mysqli_fetch_assoc($sql); 
	$_SESSION['id'] = $rows['id'];			               
    $_SESSION['username'] = $rows['username'];	
	$_SESSION['usertype'] = $rows['type'];   
	mysqli_query($conn,"update ".$sufix."admin set lastlogin='".date('Y-m-d')."' where id = '".$rows['id']."' and username='".$rows['username']."'") ;
	$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; 
	setcookie('rrdssrdda', $rows['id'], time()+120, '/', $domain, false);  
?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/dashboard';</script>
<?php } else { 
    $_SESSION['message']="<div class='alert alert-danger' role='alert'>Invalid userid/password!</div>";
?> 
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/';</script> 
<?php } ?>