<?php
session_start();
include("includes/configuration.php");
include("includes/libraries/mailfunction.php");
	
	
$CompanyEmail=CompanyEmail;
$CompanyName=CompanyName;
$hash=$_REQUEST['hash'];

$emailid=base64_decode($hash);

	$sql=mysqli_query($conn,"select * from `".$sufix."suppliers` where emailid='".$emailid."'") ;
	if($rows=mysqli_fetch_array($sql))
	{
		//if($rows['emailid']==$emailid)
		//{
			$sql=mysqli_query($conn,"update `".$sufix."suppliers` set `approveflag`='1' where emailid='".$rows['emailid']."'") ;
			
			
				header("Location:registration1.php?hash=".$hash."&msg=Email Verification Successful. Please fill Details below.");
			//}		
			//$_SESSION['emailid']=$rows['emailid'];
			exit();
		//}
	}

?>	