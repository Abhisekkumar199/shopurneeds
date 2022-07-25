<?php
include_once('../classes/config.inc.php');
include_once('../classes/database.inc.php');
include_once('../classes/cart.inc.php');



$quantity=$_GET["q"];
if($_GET["q"]!='')
{ //start condition to check the value for sub categroy 

//echo "SELECT * FROM baby_category WHERE parent = '".$_GET["subcatid"]."' and cat_type='sub-subcategory'";
$sql=$basket->qty("SELECT sellingprice FROM flip_product WHERE id='".$_GET['pid']."'") ;
	if($rows= $basket->fetchAssoc($sql))
	{
	
		 $qty=$quantity * $rows['sellingprice'];
	
	}

} //end condition to check the value for sub categroy	
?>
<input name="fprice" id="fprice" type="hidden"  value="<?php echo $qty; ?>" size="5"/> 
<font color="#000000"><?php echo $qty; ?></font>