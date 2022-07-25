<?php
session_start();
include("includes/configuration.php");
	
include("includes/libraries/mailfunction.php");


if($_REQUEST['categoryname']!='')
{
	$category=implode(",",$_REQUEST['categoryname']);
}

$seller_slug = removespecialcharacter($_REQUEST['suppliername']);

$sql=mysqli_query($conn,"select emailid from `".$sufix."suppliers` where emailid='".$_REQUEST['emailid']."'") ;
$num=mysqli_num_rows($sql);
	if($num !=0)
	
	{
		$emailid = $_REQUEST['emailid'];
		$hash=base64_encode($emailid);
		
		
	$slugcheck1 = mysqli_query($conn,"select * from ".$sufix."slug_master where slugname='".$seller_slug."'");
$slugrows1 = mysqli_fetch_assoc($slugcheck1);
if(mysqli_num_rows($slugcheck1)>0) {
	$i=rand(1,10);
	$seller_slug1 = $seller_slug.$i; 
	$slugins1 = mysqli_query($conn,"insert into ".$sufix."slug_master (`slugname`,`slugtype`,`adddate`) values ('".$seller_slug1."','seller',NOW())");
	
	$slug = $seller_slug1;
	
	} else {
	$slugins1 = mysqli_query($conn,"insert into ".$sufix."slug_master (`slugname`,`slugtype`,`adddate`) values ('".$seller_slug."','seller',NOW())");
	$slug = $seller_slug;
	}
			
		

		$sql_user=mysqli_query($conn,"update `".$sufix."suppliers` set seller_slug='".$slug."', suppliername='".$_REQUEST['suppliername']."', companyname='".$_REQUEST['cname']."',fname='".$_REQUEST['fname']."',lname='".$_REQUEST['lname']."',mobile1='".$_REQUEST['mobileno']."',paddress1='".$_REQUEST['paddress1']."',paddress2='".$_REQUEST['paddress2']."',pcity='".$_REQUEST['pcity']."',pstate='".$_REQUEST['pstate']."',ppincode='".$_REQUEST['ppincode']."',baddress1='".$_REQUEST['baddress1']."',baddress2='".$_REQUEST['baddress2']."',bcity='".$_REQUEST['bcity']."',bstate='".$_REQUEST['bstate']."',bpincode='".$_REQUEST['bpincode']."',panno='".$_REQUEST['panno']."',tinno='".$_REQUEST['tinno']."',tanno='".$_REQUEST['tanno']."',vatno='".$_REQUEST['vatno']."',cstno='".$_REQUEST['cstno']."',beneficiaryname='".$_REQUEST['beneficiaryname']."',accountnumber='".$_REQUEST['accountnumber']."',ifsccode='".$_REQUEST['ifsccode']."',bankname='".$_REQUEST['bankname']."',bankaddress='".$_REQUEST['bankaddress']."',cat_id='".$category."' where emailid='".$_REQUEST['emailid']."'") ;
				
					//$_SESSION['sessionMsg']='Thanks for registering with us, We will get back to you in 2 business days';

if($_REQUEST['brandname']!='') { 
$brandslug2=create_slug($_REQUEST['brandname']);

$bslug=strtolower($brandslug2);

$slugcheck = mysqli_query($conn,"select * from ".$sufix."slug_master where slugname='".$bslug."'");
$slugrows = mysqli_fetch_assoc($slugcheck);
if(mysqli_num_rows($slugcheck)>0) {
	$i=rand(1,10);
	$bslug1 = $bslug.$i; 
	$slugins = mysqli_query($conn,"insert into ".$sufix."slug_master (`slugname`,`slugtype`,`adddate`) values ('".$bslug1."','brand',NOW())");

$selectquery = mysqli_query($conn,"select id from `".$sufix."suppliers` where emailid='".$_REQUEST['emailid']."'");
$biddd = mysqli_fetch_array($selectquery,0);
$ins = mysqli_query($conn,"insert into ".$sufix."brand (`brandname`,`brandslug`,`seller_id`) values ('".$_REQUEST['brandname']."','".$bslug1."','".$biddd."')");

} else { 

$slugins = mysqli_query($conn,"insert into ".$sufix."slug_master (`slugname`,`slugtype`,`adddate`) values ('".$bslug."','brand',NOW())");

$selectquery = mysqli_query($conn,"select id from `".$sufix."suppliers` where emailid='".$_REQUEST['emailid']."'");
$biddd = mysqli_fetch_array($selectquery,0);
$ins = mysqli_query($conn,"insert into ".$sufix."brand (`brandname`,`brandslug`,`seller_id`) values ('".$_REQUEST['brandname']."','".$bslug."','".$biddd."')");

}
}					
header("Location:registration2.php?emailid=".$hash);
?>
<script language="javascript">
//window.location.href="registration2.php";

</script>	
<?php
	}
	else
	{
	
	$_SESSION['sessionMsg']="Email address do not exist"; 	

?>	
<script language="javascript">
window.location.href="registration.php";

</script>
<?php } ?>
