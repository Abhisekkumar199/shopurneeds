<?php 
session_start();
include("include/configurationadmin.php");  
$id=$_REQUEST['id'];
$option=$_REQUEST['option'];
  
$city= $_REQUEST['city']; 
$amount_from= $_REQUEST['amount_from'];
$amount_upto = $_REQUEST['amount_upto'];
$charge = $_REQUEST['charge']; 

if($option=="Edit")
{	 
    mysqli_query($conn,"update `".$sufix."city_shipping_charges` set `city`='".$city."', `amount_from`='".$amount_from."', `amount_upto`='".$amount_upto."', `charge`='".$charge."' where id='".$id."'") ;
}
else
{  
    mysqli_query($conn,"insert into  `".$sufix."city_shipping_charges` set `city`='".$city."', `amount_from`='".$amount_from."', `amount_upto`='".$amount_upto."', `charge`='".$charge."', `adddate`='".date("Y-m-d")."'") ;
} 

if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Record has been updated</div>";
} 
else 
{  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Record been inserted</div>";
} 
?>
<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/city-shipping-list';</script> 