<?php 
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php"); 



$id=$_REQUEST['id'];
$option=$_REQUEST['option'];

$brand_category=$_REQUEST['brand_category'];
$brandname2=$_REQUEST['brandname'];
$short_description=$_REQUEST['short_description'];
$long_description=$_REQUEST['long_description']; 
$metatitle=$_REQUEST['metatitle'];
$metakeyword = $_REQUEST['metakeyword'];
$metadescription=$_REQUEST['metadescription'];
$website=$_REQUEST['website'];
$status=$_REQUEST['status'];  

$brandname=trim($brandname2);  
$brandslug=strtolower(create_slug($brandname2)); 
 
  
define ("MAX_SIZE","3000");  
 $errors=0;
$image=$_FILES['image']['name'];	
$image1=$_FILES['image1']['name'];	 
$certificate=$_FILES['certificate']['name'];	 

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
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-brand.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
 		} 
 		else
 		{
		    $size=filesize($_FILES['image']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-brand.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
			}
	
			$image_name=$id."_".$filename;		
			$newname="../uploads/brandimages/".$image_name;		
			$move=move_uploaded_file($_FILES['image']['tmp_name'],$newname); 
		} 	
	}
	
	// uploading thumb
	if($image1) 
 	{ 
 		$filename1 = $_FILES['image1']['name'];  		
		$extension1 = getExtension($filename1);		
 		$extension1 = strtolower($extension1); 	
 		if (($extension1 != "jpg") && ($extension1 != "jpeg") && ($extension1 != "png") && ($extension1 != "gif")) 
 		{ 
		    $_SESSION['message']="<div class='alert alert-danger' role='alert'>Invalid File Extension!</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-brand.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
 		} 
 		else
 		{
		    $size=filesize($_FILES['image1']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-brand.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
			}
			$image_name1=$id."_".$filename1;		
			$newname1="../uploads/brandimages/".$image_name1;		
			$move=move_uploaded_file($_FILES['image1']['tmp_name'],$newname1);								
		} 	
	}
	
	// uploading certificate
	if($certificate) 
 	{ 
 		$filename1 = $_FILES['certificate']['name'];  		
		$extension1 = getExtension($filename1);		
 		$extension1 = strtolower($extension1); 	
 		if (($extension1 != "jpg") && ($extension1 != "jpeg") && ($extension1 != "png") && ($extension1 != "gif")) 
 		{ 
 		    $_SESSION['message']="<div class='alert alert-danger' role='alert'>Invalid File Extension!</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-brand.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php  
 		} 
 		else
 		{
		    $size=filesize($_FILES['certificate']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-brand.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
			}
	
			$brandcertificate=$id."_".$filename1;		
			$newname1="../uploads/brandcertificate/".$brandcertificate;		
			$move=move_uploaded_file($_FILES['certificate']['tmp_name'],$newname1);	  
			mysqli_query($conn,"update `".$sufix."brand` set `certificate`='".$brandcertificate."' where bid='".$id."'") ; 
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
	if($image1!="")
	{
	    $fieldname1=$image_name1;
	}
	else
	{
	    $fieldname1=$_REQUEST['blankimage1'];
	}
 
 
    mysqli_query($conn,"update `".$sufix."brand` set `brand_category`='".$brand_category."',`brandname`='".$brandname."',`brandslug`='".$brandslug."',website='".$website."', `uploadimage`='".$fieldname."',`uploadimage1`='".$fieldname1."',`add_user`='".$_SESSION['username']."',`short_description`='".mysqli_real_escape_string($conn,$short_description)."',`long_description`='".mysqli_real_escape_string($conn,$long_description)."',`metatitle`='".mysqli_real_escape_string($conn,$metatitle)."',`metakeyword`='".mysqli_real_escape_string($conn,$metakeyword)."',`metadescription`='".mysqli_real_escape_string($conn,$metadescription)."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."'   where bid='".$id."'") ;
    
}
else
{  
    mysqli_query($conn,"insert into `".$sufix."brand` set  `brand_category`='".$brand_category."',`brandname`='".$brandname."',`brandslug`='".$brandslug."',website='".$website."',`add_user`='".$_SESSION['username']."',`short_description`='".mysqli_real_escape_string($conn,$short_description)."',`long_description`='".mysqli_real_escape_string($conn,$long_description)."',`metatitle`='".mysqli_real_escape_string($conn,$metatitle)."',`metakeyword`='".mysqli_real_escape_string($conn,$metakeyword)."',`metadescription`='".mysqli_real_escape_string($conn,$metadescription)."', `displayflag`='".$status."', `adddate`='".date("Y-m-d")."'") ; 
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
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-brand.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
 		} 
 		else
 		{
		    $size=filesize($_FILES['image']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-brand.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
			}
			$image_name=$id."_".$filename;		
			$newname="../uploads/brandimages/".$image_name;		
			$move=move_uploaded_file($_FILES['image']['tmp_name'],$newname); 
			mysqli_query($conn,"update `".$sufix."brand` set `uploadimage`='".$image_name."' where bid='".$id."'") ;	 
		} 	
	}
	
	// uploading thumb
	if($image1) 
 	{ 
 		$filename1 = $_FILES['image1']['name'];  		
		$extension1 = getExtension($filename1);		
 		$extension1 = strtolower($extension1); 	
 		if (($extension1 != "jpg") && ($extension1 != "jpeg") && ($extension1 != "png") && ($extension1 != "gif")) 
 		{ 
 		    $_SESSION['message']="<div class='alert alert-danger' role='alert'>Invalid File Extension!</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-brand.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php  
 		} 
 		else
 		{
		    $size=filesize($_FILES['image1']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-brand.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
			}
	
			$image_name1=$id."_".$filename1;		
			$newname1="../uploads/brandimages/".$image_name1;		
			$move=move_uploaded_file($_FILES['image1']['tmp_name'],$newname1);	  
			mysqli_query($conn,"update `".$sufix."brand` set `uploadimage1`='".$image_name1."' where bid='".$id."'") ; 
		} 	
	} 
	
	// uploading certificate
	if($certificate) 
 	{ 
 		$filename1 = $_FILES['certificate']['name'];  		
		$extension1 = getExtension($filename1);		
 		$extension1 = strtolower($extension1); 	
 		if (($extension1 != "jpg") && ($extension1 != "jpeg") && ($extension1 != "png") && ($extension1 != "gif")) 
 		{ 
 		    $_SESSION['message']="<div class='alert alert-danger' role='alert'>Invalid File Extension!</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-brand.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php  
 		} 
 		else
 		{
		    $size=filesize($_FILES['certificate']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-brand.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
			}
	
			$brandcertificate=$id."_".$filename1;		
			$newname1="../uploads/brandcertificate/".$brandcertificate;		
			$move=move_uploaded_file($_FILES['certificate']['tmp_name'],$newname1);	  
			mysqli_query($conn,"update `".$sufix."brand` set `certificate`='".$brandcertificate."' where bid='".$id."'") ; 
		} 	
	} 
} 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Brand has been updated</div>";
} 
else 
{  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Brand has been inserted</div>";
} 
?>	

<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/brand-list';</script>  