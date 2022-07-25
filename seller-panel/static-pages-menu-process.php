<?php 
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include("include/configurationadmin.php"); 



$id=$_REQUEST['id'];
$option=$_REQUEST['option']; 
$parent=$_REQUEST['parent']; 
$menuposition=implode(',',$_REQUEST['menuposition']); 
$pageid=$_REQUEST['pageid'];
$itemname = $_REQUEST['itemname'];
$targetlink=$_REQUEST['targetlink'];
$description=$_REQUEST['description']; 
$itemname_in_arabic= $_REQUEST['itemname_in_arabic'];
$description_in_arabic= $_REQUEST['description_in_arabic'];
$status=$_REQUEST['status']; 
 
   

 mysqli_query($conn,"SET NAMES 'utf8'"); 
mysqli_query($conn,'SET CHARACTER SET utf8');
if($option=="Edit")
{ 
    mysqli_query($conn,"update `".$sufix."top_navigation` set `pageid`='".$pageid."',`menuposition`='".$menuposition."', `itemname`='".$itemname."',`description`='".$description."',`itemname_in_arabic`='".$itemname_in_arabic."',`description_in_arabic`='".$description_in_arabic."',`targetlink`='".$targetlink."',`add_user`='".$_SESSION['username']."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."'   where id='".$id."'") ;
}
else
{  
    mysqli_query($conn,"insert into `".$sufix."top_navigation` set `pageid`='".$pageid."',`parent`='".$parent."',`menuposition`='".$menuposition."',`itemname`='".$itemname."', `description`='".$description."',`itemname_in_arabic`='".$itemname_in_arabic."',`description_in_arabic`='".$description_in_arabic."',`targetlink`='".$targetlink."',`add_user`='".$_SESSION['username']."', `displayflag`='".$status."', `adddate`='".date("Y-m-d")."'") ; 
} 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Menu has been updated</div>";
    ?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/static-pages-menu.php?catid=<?php echo $parent; ?>';</script>  
<?php } else {  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Menu has been inserted</div>";
?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/static-pages-menu.php?parentid=<?php echo $parent; ?>';</script>  
<?php } ?>	