<?php
include_once('../classes/config.inc.php');
include_once('../classes/database.inc.php');
include_once('../classes/cart.inc.php');




if($_GET["sval"]!='')
{ //start condition to check the value for sub categroy

//echo "SELECT * FROM baby_category WHERE parent = '".$_GET["subcatid"]."' and cat_type='sub-subcategory'";
$sql=mysqli_query($conn,"SELECT emailid FROM flip_user_registration WHERE emailid='".$_GET['sval']."'") ;
$num=$basket->num($sql);
if($num > 0)
{
?>
<span class="alert">Email ID already listed.</span>

<?php

}
else
{
	$sql=mysqli_query($conn,"insert into `flip_user_registration` (`emailid`, `subscribe`) values ('".$_GET['sval']."', '1')") ;
?>	
	<span class="alert">You are successfully subscribed.</span>
<?php
}	
	
} //end condition to check the value for sub categroy	
?>
