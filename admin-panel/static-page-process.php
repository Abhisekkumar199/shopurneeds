<?php 
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php"); 



$id=$_REQUEST['id'];
$option=$_REQUEST['option'];

$heading2=$_REQUEST['heading'];
$heading=trim($heading2);  
$slug=strtolower(create_slug($heading2));  
$description=$_REQUEST['description']; 
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
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-static-page.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
 		} 
 		else
 		{
		    $size=filesize($_FILES['image']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-static-page.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
			}
	
			$image_name=$id."_".$filename;		
			$newname="../uploads/staticpageimages/".$image_name;		
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
 
	
    mysqli_query($conn,"update `".$sufix."static_pages` set `heading`='".$heading."',`link_name`='".$slug."', `imageupload`='".$fieldname."',`add_user`='".$_SESSION['username']."',`description`='".mysqli_real_escape_string($conn,$description)."',`metatitle`='".mysqli_real_escape_string($conn,$metatitle)."',`metakeyword`='".mysqli_real_escape_string($conn,$metakeyword)."',`metadescription`='".mysqli_real_escape_string($conn,$metadescription)."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."'   where id='".$id."'") ; 
}
else
{  
    mysqli_query($conn,"insert into `".$sufix."static_pages` set `heading`='".$heading."',`link_name`='".$slug."', `imageupload`='".$fieldname."',`add_user`='".$_SESSION['username']."',`description`='".mysqli_real_escape_string($conn,$description)."',`metatitle`='".mysqli_real_escape_string($conn,$metatitle)."',`metakeyword`='".mysqli_real_escape_string($conn,$metakeyword)."',`metadescription`='".mysqli_real_escape_string($conn,$metadescription)."', `displayflag`='".$status."', `adddate`='".date("Y-m-d")."'") ; 
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
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-static-page.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
 		} 
 		else
 		{
		    $size=filesize($_FILES['image']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-static-page.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
			}
			$image_name=$id."_".$filename;		
			$newname="../uploads/staticpageimages/".$image_name;		
			$move=move_uploaded_file($_FILES['image']['tmp_name'],$newname); 
			mysqli_query($conn,"update `".$sufix."static_pages` set `imageupload`='".$image_name."' where id='".$id."'") ;	 
		} 	
	}
	
 
} 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Category has been updated</div>";
    ?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/static-pages';</script>  
<?php } else {  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Category has been inserted</div>";
?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/static-pages';</script>  
<?php } ?>	