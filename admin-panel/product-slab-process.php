<?php 
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");  

$id=$_REQUEST['id'];
$option=$_REQUEST['option']; 
$externallink=$_REQUEST['externallink']; 
$title=$_REQUEST['title']; 
$sku_ids=mysqli_real_escape_string($conn,$_REQUEST['sku_ids']); 
$description=$_REQUEST['description'] ;
$status = $_REQUEST['status'];  
    
$image=$_FILES['image']['name']; 
if($option=="Edit")
{	 
    // uploading banner
	if($image) 
 	{ 
 		$filename = $_FILES['image']['name'];   
		$image_name=$id."_".$filename;		
		$newname="../uploads/stripbannerimages/".$image_name;		
		$move=move_uploaded_file($_FILES['image']['tmp_name'],$newname); 
	    mysqli_query($conn,"update `".$sufix."product_slab` set `bannerimage`='".$image_name."'   where id='".$id."'") ; 
	} 
    
    mysqli_query($conn,"update `".$sufix."product_slab` set `title`='".$title."',`url`='".$externallink."',`sku_ids`='".$sku_ids."',`description`='".$description."', `displayflag`='".$status."'   where id='".$id."'") ;
    
     
}
else
{    
    mysqli_query($conn,"insert into `".$sufix."product_slab` set `title`='".$title."',`url`='".$externallink."',`sku_ids`='".$sku_ids."',`description`='".$description."',`displayflag`='".$status."'") ;  
    $id = mysqli_insert_id($conn);
    // uploading banner
	if($image) 
 	{ 
 		$filename = $_FILES['image']['name'];  	 
		$image_name=$id."_".$filename;		
		$newname="../uploads/stripbannerimages/".$image_name;		
		$move=move_uploaded_file($_FILES['image']['tmp_name'],$newname); 
		mysqli_query($conn,"update `".$sufix."product_slab` set `bannerimage`='".$image_name."'   where id='".$id."'") ;
		 	
	}
    
} 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Slab has been updated</div>";
    ?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/product-slab-list';</script>  
<?php } else {  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Slab has been inserted</div>";
?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/product-slab-list';</script>  
<?php } ?>	