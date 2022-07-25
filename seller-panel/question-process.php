<?php 
session_start(); 
include("include/configurationadmin.php"); 



$id=$_REQUEST['id'];
$option=$_REQUEST['option']; 
$question=$_REQUEST['question'];
$option1 = $_REQUEST['option1'];
$option2 = $_REQUEST['option2']; 
$status=$_REQUEST['status'];   
   
if($option=="Edit")
{	 
    mysqli_query($conn,"update `".$sufix."questions` set `question`='".$question."',`option1`='".$option1."',`option2`='".$option2."',`displayflag`='".$status."'   where id='".$id."'") ; 
}
else
{  
    mysqli_query($conn,"insert into `".$sufix."questions` set `question`='".$question."',`option1`='".$option1."',`option2`='".$option2."',`displayflag`='".$status."'") ; 
    $id=mysqli_insert_id($conn);  
} 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Record has been updated</div>";
    ?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/question-list';</script>  
<?php } else {  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Record has been inserted</div>";
?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/question-list';</script>  
<?php } ?>	