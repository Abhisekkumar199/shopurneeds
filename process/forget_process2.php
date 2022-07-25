<?php
session_start();
include("../configuration.php"); 
include("../mailfunction.php"); 
$emailid=$_REQUEST['emailid'];
$CompanyEmail=CompanyEmail;
$CompanyName=CompanyName;
$URL=URL;
$refer=$_SERVER['HTTP_REFERER'];
$hash=base64_encode($emailid);

	$sql=mysqli_query($conn,"select fname,password from `".$sufix."user_registration` where  emailid='".$emailid."'") ;

		$num=mysqli_num_rows($sql);

		if($num <= 0)

		{

				$_SESSION['sessionMsg']="Email ID does not exist! Please try again";

		

				header("location:".$URL."/basket/checkout_one");

				exit();

		}

		else

		{		

			$pcode=rand(10000, 100000000);
$password = rand(11111111,99999999);
			mysqli_query($conn,"update `".$sufix."user_registration` set `password`='".$password."', `pcode`='".$pcode."', `ptime`='".date("h:i")."' where emailid='".$emailid."'");
			$rowsuser=mysqli_fetch_array($sql);	
			$fname = $rowsuser['fname'];
            include("../mail/forget_mail.php");		
            send_mail($toc, $subjectc, $messagec, $headers1, $fromc, '');
			$_SESSION['sessionMsg']="<font color='green'>Password has been send at your email id!</font>";	
			?>
			<script>window.location.href='https://localhost/project/shopurneeds/basket/checkout_one';</script>
			<?php	
			
			exit();
		}	

?>