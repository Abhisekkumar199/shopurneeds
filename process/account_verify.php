<?php
session_start();
include("includes/configuration.php");

//include("includes/libraries/mailfunction.php");

	

$CompanyEmail=CompanyEmail;

$CompanyName=CompanyName;

$hash=$_REQUEST['hash'];



$emailid=base64_decode($hash);



	$sql=mysqli_query($conn,"select * from `".$sufix."user_registration` where displayflag='1' and emailid='".$emailid."'") ;

	if($rows=mysqli_fetch_array($sql))

	{

		//if($rows['emailid']==$emailid)

		//{

			$sql=mysqli_query($conn,"update `".$sufix."user_registration` set `approveflag`='1' where emailid='".$rows['emailid']."'") ;

			

			$_SESSION['emailid']=$rows['emailid'];

			$_SESSION['fnamenew']=$rows['fname'];

			$_SESSION['useridse']=$rows['id'];

			sleep(5);



			header("Location:approvedlogin.php");

			exit();

		//}

	}



?>	