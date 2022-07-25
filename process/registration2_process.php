<?php



session_start();



include("includes/configuration.php");



	



include("includes/libraries/mailfunction.php");











$emailid=$_REQUEST['emailid']; 



if($_REQUEST['categoryname']!='')



{



	$category=implode(",",$_REQUEST['categoryname']);







}



$sql=mysqli_query($conn,"select * from `".$sufix."suppliers` where emailid='".$emailid."'") ;

$srows = mysqli_fetch_assoc($sql);

$num=mysqli_num_rows($sql);

	if($num !=0)


	{
$panno_image=$_FILES['panno_image']['name'];
$tincst_image=$_FILES['tincst_image']['name'];
$chequeimage=$_FILES['cheque_image']['name'];

if($panno_image!='') 
{ 
	$filename = $_FILES['panno_image']['name'];  			
	$image_name=time()."_".$filename;		
	$newname="showroomimages/".$image_name;		
	$move=move_uploaded_file($_FILES['panno_image']['tmp_name'],$newname);
	
	$sql_user=mysqli_query($conn,"update `".$sufix."suppliers` set panno_image='".$image_name."' where emailid='".$emailid."'");
		
								
}

/*****************************************************************/
if($tincst_image!='') 
{ 
	$tinfilename = $_FILES['tincst_image']['name'];  			
	$tinimage_name=time()."_".$tinfilename;		
	$tinnewname="showroomimages/".$tinimage_name;		
	$move=move_uploaded_file($_FILES['tincst_image']['tmp_name'],$tinnewname);
	$sql_user=mysqli_query($conn,"update `".$sufix."suppliers` set tincst_image='".$tinimage_name."' where emailid='".$emailid."'");
									
}

if($chequeimage!='') 
{ 
	$chequeimage = $_FILES['cheque_image']['name'];  			
	$cheque_image=time()."_".$chequeimage;		
	$chequenewname="showroomimages/".$cheque_image;		
	$move=move_uploaded_file($_FILES['cheque_image']['tmp_name'],$chequenewname);
	$sql_user=mysqli_query($conn,"update `".$sufix."suppliers` set otherdoc_image='".$cheque_image."' where emailid='".$emailid."'");
									
}
/*****************************************************************/


		$sql_user=mysqli_query($conn,"update `".$sufix."suppliers` set panno='".$_REQUEST['panno']."',tinno='".$_REQUEST['tinno']."',tanno='".$_REQUEST['tanno']."',vatno='".$_REQUEST['vatno']."',cstno='".$_REQUEST['cstno']."',beneficiaryname='".$_REQUEST['beneficiaryname']."',accountnumber='".$_REQUEST['accountnumber']."',ifsccode='".$_REQUEST['ifsccode']."',bankname='".$_REQUEST['bankname']."',bankaddress='".$_REQUEST['bankaddress']."' where emailid='".$emailid."'") ;//insert data to table




					$_SESSION['sessionMsg']='Thanks for registering with us, We will get back to you in 2 business days';



					



					 $_SESSION['cname'] = $srows['companyname'];



					 $_SESSION['sellerid'] = $srows['id'];



header("Location:https://localhost/project/shopurneeds/seller/home.php");







	}



	else



	{



	



	$_SESSION['sessionMsg']="Email address do not exist"; 	







?>	



<script language="javascript">



window.location.href="registration.php";







</script>



<?php } ?>



