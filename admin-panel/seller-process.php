<?php  
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");  

$id=$_REQUEST['id'];
$option=$_REQUEST['option']; 
$suppliername=$_REQUEST['suppliername']; 
$suppliername2=trim($suppliername);  
$slug=strtolower(create_slug($suppliername2)); 

$emailid=$_REQUEST['emailid'];
$phone=$_REQUEST['phone'];
$brandname=$_REQUEST['brandname']; 
$password=$_REQUEST['password']; 
$address1=$_REQUEST['address1']; 
$address2=$_REQUEST['address2']; 
$pcity=$_REQUEST['pcity'];   
$metatitle=$_REQUEST['metatitle'];
$metakeyword = $_REQUEST['metakeyword'];
$metadescription=$_REQUEST['metadescription']; 
$status=$_REQUEST['status'];  


 
define ("MAX_SIZE","3000"); 
   
 $errors=0;
$image=$_FILES['image']['name'];	 	  	 

if($option=="Edit")
{	
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
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-seller.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
 		} 
 		else
 		{
		    $size=filesize($_FILES['image']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-seller.php?id=<?php echo $id; ?>&option=Edit';</script>
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
	 
 
 
    mysqli_query($conn,"update `".$sufix."suppliers` set `suppliername`='".$suppliername."',`seller_slug`='".$slug."',`emailid`='".$emailid."',phone='".$phone."',`password`='".$password."', `brandname`='".$brandname."',`address1`='".$address1."',`address2`='".$address2."',`pcity`='".$pcity."',`metatitle`='".mysqli_real_escape_string($conn,$metatitle)."',`metakeyword`='".mysqli_real_escape_string($conn,$metakeyword)."',`metadescription`='".mysqli_real_escape_string($conn,$metadescription)."',`uploadimage`='".$fieldname."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."'   where id='".$id."'") ;
    
}
else
{  
    mysqli_query($conn,"insert into `".$sufix."suppliers` set  `suppliername`='".$suppliername."',`seller_slug`='".$slug."',`emailid`='".$emailid."',phone='".$phone."',`password`='".$password."',`brandname`='".$brandname."',`address1`='".$address1."',`pcity`='".$pcity."',`metatitle`='".mysqli_real_escape_string($conn,$metatitle)."',`metakeyword`='".mysqli_real_escape_string($conn,$metakeyword)."',`metadescription`='".mysqli_real_escape_string($conn,$metadescription)."',`add_user`='".$_SESSION['username']."', `displayflag`='".$status."', `adddate`='".date("Y-m-d")."'") ; 
    $id=mysqli_insert_id($conn);
    
	
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
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-seller.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
 		} 
 		else
 		{
		    $size=filesize($_FILES['image']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-seller.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
			}
			$image_name=$id."_".$filename;		
			$newname="../uploads/sellerimages/".$image_name;		
			$move=move_uploaded_file($_FILES['image']['tmp_name'],$newname); 
			mysqli_query($conn,"update `".$sufix."suppliers` set `uploadimage`='".$image_name."' where id='".$id."'") ;	 
		} 	
	} 
 
} 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Seller has been updated</div>";
} 
else 
{  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Seller has been inserted</div>";
} 
?>	

<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/seller-list';</script>  