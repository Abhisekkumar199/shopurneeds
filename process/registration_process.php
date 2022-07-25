<?php
session_start();
include("includes/configuration.php");
	
include("includes/libraries/mailfunction.php");

$cityname= cityname($sufix, $_REQUEST['cityname']);

$emailid=$_REQUEST['emailid'];
$CompanyEmail=CompanyEmail;
$CompanyName=CompanyName;
$URL=URL;
$fname12=$_REQUEST['cname'];
$refer=$_SERVER['HTTP_REFERER'];
$hash=base64_encode($emailid);
if($_REQUEST['categoryname']!='')
{
	$category=implode(",",$_REQUEST['categoryname']);

}

date_default_timezone_set('Asia/Kolkata');



$sql=mysqli_query($conn,"select emailid from `".$sufix."suppliers` where emailid='".$emailid."'") ;
$num=mysqli_num_rows($sql);
	if($num ==0)
	
	{

	
	
		$randpass = rand(11111,999999);	
		$sql_user=mysqli_query($conn,"insert into `".$sufix."suppliers` (`fname`,`password`,`emailid`,`mobile1`, `ppincode`,`othermarket`,`sellertype`,`noofsku`,`perinventory`,`cat_id`,`displayflag`,`approveflag`,`adddate`,`ptime`) values ('".$_REQUEST['cname']."','".$randpass."', '".$_REQUEST['emailid']."','".$_REQUEST['mobileno']."','".$_REQUEST['pincode']."','".$_REQUEST['othermarket']."','".$_REQUEST['sellertype']."','".$_REQUEST['noofsku']."','".$_REQUEST['perinventory']."','".$category."', '0','0', '".date("Y-m-d")."', '".date("H:i:s")."')") ;//insert data to table
		
			
		include("signup_mail2.php");//send email file				
	    send_mail($toc, $subjectc, $message, $headers1, $fromc, '');

			$_SESSION['sessionMsg11']='<div class="alert alert-success">We have sent you the "Account Verification Email". Use it to verify it. Please check your email: '.$_REQUEST['emailid'].'</div>';
header("location:".$refer);
	}
	else
	{
	
	$_SESSION['sessionMsg11']='<div class="alert alert-danger">
  <strong>Error!</strong> Email already registered
</div>'; 	
header("location:".$refer); } ?>
