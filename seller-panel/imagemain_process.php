<?php
/* CREATED BY     : Pavan Kumar
CREATED ON        : 29-03-2013 
DESCRIPTION       : Image process Page				
ORGANIZATION NAME : Exi Solutions Pvt. Ltd..
*/ 
include("../includes/configurationadmin.php");
 
$id=$_REQUEST['ids'];
$mainimage=$_REQUEST['mainimage'];
$productcode=$_REQUEST['productcode'];
 
for($i=0; $i<sizeof($id); $i++)
{
	if($id[$i]==$mainimage)
	{
	
		mysqli_query($conn,"update `".$sufix."imageupload` set `mainimage` = '1' where `id` ='$mainimage'");
	}
	elseif($id[$i]!=$mainimage)
	{
		mysqli_query($conn,"update `".$sufix."imageupload` set `mainimage` = '0' where `id` ='$id[$i]'");
	}
}
$_SESSION['sessionMsg']="Main Image has been Set";
 
?>
 
<script>window.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>';</script> 	