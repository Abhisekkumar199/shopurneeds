<?php  
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");  
$rows = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."admin where id='".$_SESSION['id']."'")); 
$password = $rows['password']; 
$old_password=md5($_REQUEST['old_password']);      
$new_password=md5($_REQUEST['new_password']);  

  
    mysqli_query($conn,"update `".$sufix."admin` set `password`='".$new_password."'  where id='".$_SESSION['id']."'") ; 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Password has been changed succussfully </div>";
    
?>
<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/admin-user-list';</script>  
 
