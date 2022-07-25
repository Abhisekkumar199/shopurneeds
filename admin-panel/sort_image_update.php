<?php 
session_start(); 
include("include/configurationadmin.php"); 
 
$id=$_REQUEST['ids1']; 
$sortid=$_REQUEST['sortid']; 
   
for($i=0; $i<sizeof($id); $i++)
{ 
    if($id[$i])  
    { 
    	mysqli_query($conn,"update `".$sufix."imageupload` set `sortid` = '$sortid[$i]' where `id` ='$id[$i]'"); 
    }	 
}

$_SESSION['message']="Sort Id has been updated"; 

?>	

<script>window.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>';</script>  