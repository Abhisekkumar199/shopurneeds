<?php  
include("includes/chklogin.php");
include("include/configurationadmin.php"); 
$id=$_REQUEST['ids'];

$sortid=$_REQUEST['sortid'];
for($i=0; $i<sizeof($id); $i++)
{
	if($id[$i])
	{ 
		mysqli_query($conn,"update `".$sufix."category` set `sortid` = '$sortid[$i]' where `cat_id` ='$id[$i]'");
	}	
}
	$_SESSION['sessionMsg']="Sort Id has been updated"; 
?>
<script>window.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>';</script> 

 