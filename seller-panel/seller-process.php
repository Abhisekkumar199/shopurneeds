<?php  
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include("include/configurationadmin.php");  

$id=$_REQUEST['id'];
$option=$_REQUEST['option']; 
$suppliername=$_REQUEST['suppliername']; 
$suppliername2=trim($suppliername);  
$slug=strtolower(create_slug($suppliername2)); 

$emailid=$_REQUEST['emailid'];
$phone=$_REQUEST['phone'];
$brandname=$_REQUEST['brandname']; 
$address1=$_REQUEST['address1']; 
$address2=$_REQUEST['address2']; 
$pcity=$_REQUEST['pcity']; 
$brandname=$_REQUEST['brandname']; 
$metatitle=$_REQUEST['metatitle'];
$metakeyword = $_REQUEST['metakeyword'];
$metadescription=$_REQUEST['metadescription']; 
$status=$_REQUEST['status']; 
$password =$_REQUEST['password'];
 
define ("MAX_SIZE","3000"); 
   
 $errors=0;
$image=$_FILES['image']['name'];	 	  	 

 mysqli_query($conn,"SET NAMES 'utf8'"); 
mysqli_query($conn,'SET CHARACTER SET utf8');
 	
	// uploading banner
	if($image) 
 	{ 
 		$filename = $_FILES['image']['name'];  		
		$extension = getExtension($filename);		
 		$extension = strtolower($extension); 	
 		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{ 
		    $_SESSION['message']="<div class='alert alert-danger' role='alert'>Invalid File Extension!</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/seller-panel/add-seller.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
 		} 
 		else
 		{
		    $size=filesize($_FILES['image']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/seller-panel/add-seller.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
			}
	
			$image_name=$id."_".$filename;		
			$newname="../uploads/sellerimages/".$image_name;		
			$move=move_uploaded_file($_FILES['image']['tmp_name'],$newname); 
		} 	
	}
	
 
	 
	if($image!="")
	{
	    $fieldname=$image_name;
	}
	else
	{
	    $fieldname=$_REQUEST['blankimage'];
	}	
	 
 
 
    mysqli_query($conn,"update `".$sufix."suppliers` set `suppliername`='".$suppliername."',`seller_slug`='".$slug."',`password`='".$password."',`emailid`='".$emailid."',phone='".$phone."', `brandname`='".$brandname."',`address1`='".$address1."',`address2`='".$address2."',`pcity`='".$pcity."',`metatitle`='".mysqli_real_escape_string($conn,$metatitle)."',`metakeyword`='".mysqli_real_escape_string($conn,$metakeyword)."',`metadescription`='".mysqli_real_escape_string($conn,$metadescription)."',`uploadimage`='".$fieldname."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."'   where id='".$id."'") ;
    
 
 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Seller has been updated</div>";
  
 
?>	

<script>window.location.href='https://localhost/project/shopurneeds/seller-panel/seller-profile';</script>  