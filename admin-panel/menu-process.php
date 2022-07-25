<?php 
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");    
$id=$_REQUEST['id']; 
$menuid = $_REQUEST['menuid'];
$parent = $_REQUEST['parent'];
$status=$_REQUEST['status']; 
$menu = $_REQUEST['menu']; 
$link = $_REQUEST['link']; 
$option = $_REQUEST['option']; 
$icon = $_REQUEST['icon']; 
if($option=="Edit")
{		
    mysqli_query($conn,"update `".$sufix."menu_permission` set `menu`='".$menu."', `link`='".$link."', `icon`='".$icon."', `displayflag`='".$status."' where id='".$id."'") ; 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Menu has been updated</div>";
    ?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/menu-list.php?menuid=<?php echo $menuid; ?>';</script>  
<?php
}
else
{ 
    mysqli_query($conn,"insert into `".$sufix."menu_permission` (`menu`, `link`,`parent`,`icon`,`adddate`) values ('".$menu."', '".$link."','".$menuid."', '".$icon."',NOW())") ;
    $id=mysql_insert_id(); 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Menu has been inserted</div>";
?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/menu-list.php?menuid=<?php echo $menuid; ?>';</script> 

<?php } ?>	 