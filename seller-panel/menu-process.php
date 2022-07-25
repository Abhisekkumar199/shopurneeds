<?php 
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include("include/configurationadmin.php");    
$id=$_REQUEST['id']; 
$menuid = $_REQUEST['menuid'];
$parent = $_REQUEST['parent'];
$status=$_REQUEST['status']; 
$menu = $_REQUEST['menu']; 
$menu_name_in_hebrew = $_REQUEST['menu_name_in_hebrew']; 
$link = $_REQUEST['link']; 
$option = $_REQUEST['option']; 
$icon = $_REQUEST['icon']; 

 mysqli_query($conn,"SET NAMES 'utf8'"); 
mysqli_query($conn,'SET CHARACTER SET utf8');
 
if($option=="Edit")
{		
    mysqli_query($conn,"update `".$sufix."menu_permission` set `menu`='".$menu."', `menu_name_in_hebrew`='".$menu_name_in_hebrew."', `link`='".$link."', `icon`='".$icon."', `displayflag`='".$status."' where id='".$id."'") ; 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Menu has been updated</div>";
    ?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/menu-list.php?menuid=<?php echo $menuid; ?>';</script>  
<?php
}
else
{ 
    mysqli_query($conn,"insert into `".$sufix."menu_permission` (`menu`, `menu_name_in_hebrew`, `link`,`parent`,`icon`,`adddate`) values ('".$menu."', '".$menu_name_in_hebrew."', '".$link."','".$menuid."', '".$icon."',NOW())") ;
    $id=mysql_insert_id(); 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Menu has been inserted</div>";
?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/menu-list.php?menuid=<?php echo $menuid; ?>';</script> 

<?php } ?>	 