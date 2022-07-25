<?php
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");  
if($_REQUEST['sellerid']!='')
{
	$sss = implode(',',$_REQUEST["sellerid"]);
	$selleriddd = " and seller_id IN($sss)";
}
 

if($_REQUEST['sellerid']!='')
{ 
?>
<select name="productname[]" class="custom-select  getselectedoptionvalue"    multiple="multiple" onchange="getselectoption();"> 
  <?php 
  
	$sql_product = mysqli_query($conn,"SELECT * FROM shopurneeds_product WHERE displayflag='1' {$selleriddd}");
	while($row_subcat= mysqli_fetch_assoc($sql_product))
	{
	?>
    <option value="<?php echo $row_subcat['id']; ?>"><?php echo $row_subcat['productname']; ?>&nbsp;(<?php echo $row_subcat['sku'];?>)</option>
  <?php } ?>
</select>
<?php
} //end condition to check the value for sub categroy	
else
{
?>
<select name="productname[]" class="inputmenu" style="width:500px; height:300px;" multiple="multiple">
  <option value="">--Select Product--</option>
</select>
<?php
}
?>
