<?php
include_once('../classes/config.inc.php');
include_once('../classes/database.inc.php');
include_once('../libraries/function_inc.php');



if($_GET["pid"]!='')
{ //start condition to check the value for sub categroy

//echo "SELECT * FROM baby_category WHERE parent = '".$_GET["subcatid"]."' and cat_type='sub-subcategory'";

mysqli_query($conn,"SELECT costprice FROM flip_product WHERE id='".$_GET['pid']."'") ;

$rowproduct=mysqli_fetch_assoc();
?>
<?php 
//echo $_REQUEST['pname'];
if($_REQUEST['pcost']!='')
{
	$pcost=$_REQUEST['pcost'] + $rowproduct['costprice'];
}
else
{	
	$pcost=$rowproduct['costprice'];
}	
?>
<input type="text" name="sellingprice" id="sellingprice" class="inputtext" cols="20" rows="5"  value="<?php echo $pcost; ?>" />
<?php
	

} //end condition to check the value for sub categroy	

else
{
?>

				
<?php
}
?>



