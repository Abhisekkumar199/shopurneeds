<?php  
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");  

$id=$_REQUEST['id'];
$option=$_REQUEST['option']; 
$username=$_REQUEST['username'];   
$password=md5($_REQUEST['password']);
$name=$_REQUEST['name'];
$email=$_REQUEST['email']; 
$phone=$_REQUEST['phone']; 
$type=$_REQUEST['type']; 
$permission=implode(',',$_REQUEST['permission']);  
$status=$_REQUEST['status'];  
 
if($option=="Edit")
{	 
    mysqli_query($conn,"update `".$sufix."admin` set `type`='".$type."',`name`='".$name."',`email`='".$email."',phone='".$phone."', `username`='".$username."',`permission`='".$permission."', `displayflag`='".$status."' where id='".$id."'") ;
}
else
{   
    mysqli_query($conn,"insert into `".$sufix."admin` set  `type`='".$type."',`name`='".$name."',`email`='".$email."',phone='".$phone."',`username`='".$username."',`password`='".$password."',`permission`='".$permission."', `displayflag`='".$status."'") ; 
}  
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>User has been updated</div>";
} 
else 
{  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>User has been inserted</div>";
} 
?>	

<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/admin-user-list';</script>  