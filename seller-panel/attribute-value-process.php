<?php  
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include("include/configurationadmin.php");  
$id=$_REQUEST['id'];
$option=$_REQUEST['option'];
 
$attributevaluename=explode(',',$_REQUEST['attributevaluename']); 
$attributevaluename1= $_REQUEST['attributevaluename'];
$attributevaluename_in_hebrew= $_REQUEST['attributevaluename_in_hebrew'];
$attribute = $_REQUEST['attribute'];
$status=$_REQUEST['status']; 


 mysqli_query($conn,"SET NAMES 'utf8'"); 
mysqli_query($conn,'SET CHARACTER SET utf8');
if($option=="Edit")
{	 
    mysqli_query($conn,"update `".$sufix."attributevalue` set `attributevaluename`='".$attributevaluename1."',`attributevaluename_in_hebrew`='".$attributevaluename_in_hebrew."',`atr_id`='".$attribute."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."' where atr_val_id='".$id."'") ;
}
else
{  
    for($i=0;$i<count($attributevaluename);$i++)
    {
        mysqli_query($conn,"insert into `".$sufix."attributevalue` set `attributevaluename`='".$attributevaluename[$i]."',`atr_id`='".$attribute."',`add_user`='".$_SESSION['username']."', `displayflag`='".$status."', `adddate`='".date("Y-m-d")."'") ; 
    }
    
} 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Attribute Value has been updated</div>";
} 
else 
{  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Attribute Value has been inserted</div>";
} 
?>
<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/attributevalue-list';</script> 