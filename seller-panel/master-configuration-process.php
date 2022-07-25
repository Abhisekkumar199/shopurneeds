<?php 
session_start(); 
include("include/configurationadmin.php"); 



$id=$_REQUEST['id'];
$option=$_REQUEST['option']; 
$metatitle=$_REQUEST['metatitle'];
$metakeyword = $_REQUEST['metakeyword'];
$cod_charge = $_REQUEST['cod_charge'];
$metadescription=$_REQUEST['metadescription'];
$status=$_REQUEST['status'];   
  
define ("MAX_SIZE","3000");  
 $errors=0;
$image=$_FILES['image']['name'];	  

if($option=="Edit")
{	
	// uploading banner
	if($_FILES['image']['name'] != '') 
 	{ 
 		$filename = $_FILES['image']['name'];  		
		$extension = getExtension($filename);		
 		$extension = strtolower($extension); 	
 		  
		 
			$image_name=$id."_".$filename;		
			$newname="../uploads/masterimages/".$image_name;		
			$move=move_uploaded_file($_FILES['image']['tmp_name'],$newname); 
			
			mysqli_query($conn,"update `".$sufix."master_configuration` set `logo`='".$image_name."' where id='".$id."'") ;	
		  	
	}
 
 
 
	
    mysqli_query($conn,"update `".$sufix."master_configuration` set `cod_charge`='".$cod_charge."',`add_user`='".$_SESSION['username']."',`metatitle`='".mysqli_real_escape_string($conn,$metatitle)."',`metakeyword`='".mysqli_real_escape_string($conn,$metakeyword)."',`metadescription`='".mysqli_real_escape_string($conn,$metadescription)."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."'   where id='".$id."'") ; 
}
else
{  
    mysqli_query($conn,"insert into `".$sufix."master_configuration` set   `add_user`='".$_SESSION['username']."',`cod_charge`='".$cod_charge."',`metatitle`='".mysqli_real_escape_string($conn,$metatitle)."',`metakeyword`='".mysqli_real_escape_string($conn,$metakeyword)."',`metadescription`='".mysqli_real_escape_string($conn,$metadescription)."', `displayflag`='".$status."', `adddate`='".date("Y-m-d")."'") ; 
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
			$newname="../uploads/masterimages/".$image_name;		
			$move=move_uploaded_file($_FILES['image']['tmp_name'],$newname); 
			mysqli_query($conn,"update `".$sufix."master_configuration` set `logo`='".$image_name."' where id='".$id."'") ;	 
		} 	
	}
	
 
} 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Record has been updated</div>";
    ?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/master-configuration';</script>  
<?php } else {  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Record has been inserted</div>";
?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/master-configuration';</script>  
<?php } ?>	