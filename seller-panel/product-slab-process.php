<?php 
session_start(); 
include("include/configurationadmin.php");  

$id=$_REQUEST['id'];
$option=$_REQUEST['option'];

$title=$_REQUEST['title']; 
$title_in_hebrew=$_REQUEST['title_in_hebrew']; 
$sku_ids=mysqli_real_escape_string($conn,$_REQUEST['sku_ids']); 
$description=$_REQUEST['description'] ;
$status = $_REQUEST['status'];  
$column = $_REQUEST['column'];  
    
    
    
mysqli_query($conn,"SET NAMES 'utf8'"); 
mysqli_query($conn,'SET CHARACTER SET utf8');
if($option=="Edit")
{	
	 
	
    mysqli_query($conn,"update `".$sufix."product_slab` set `title`='".$title."',`title_in_hebrew`='".$title_in_hebrew."',`rows`='".$column."',`sku_ids`='".$sku_ids."',`description`='".$description."', `displayflag`='".$status."'   where id='".$id."'") ;
    
     
}
else
{   
    mysqli_query($conn,"insert into `".$sufix."product_slab` set `title`='".$title."',`title_in_hebrew`='".$title_in_hebrew."',`rows`='".$column."',`sku_ids`='".$sku_ids."',`description`='".$description."',`displayflag`='".$status."'") ;  
} 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Slab has been updated</div>";
    ?>
    <script>window.location.href='https://localhost/project/shopurneeds/seller-panel/product-slab-list';</script>  
<?php } else {  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Slab has been inserted</div>";
?>
    <script>window.location.href='https://localhost/project/shopurneeds/seller-panel/product-slab-list';</script>  
<?php } ?>	