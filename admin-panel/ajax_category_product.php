<?php
session_start(); 
include("include/configurationadmin.php");  
if($_REQUEST['cat_ids']!='')
{
	$sss = implode(',',$_REQUEST["cat_ids"]);
	$cat_ids = " and cat_id IN($sss)";
}
 

if($_REQUEST['cat_ids']!='')
{ 
?>
<select name="prod_ids[]" class="custom-select  getselectedoptionvalue"    multiple="multiple"  style="height:300px;"> 
  <?php  
	$sql_product = mysqli_query($conn,"SELECT * FROM shopurneeds_product WHERE displayflag='1' {$cat_ids}");
	while($row_subcat= mysqli_fetch_assoc($sql_product))
	{
	?>
    <option value="<?php echo $row_subcat['id']; ?>"><?php echo $row_subcat['productname']; ?>&nbsp;(<?php echo $row_subcat['sku'];?>)</option>
  <?php } ?>
</select>
<?php
}  	
else
{
?>
<select name="prod_ids[]" class="inputmenu" style="width:500px; height:300px;" multiple="multiple" style="height:300px;">
  <option value="">--Select Product--</option>
</select>
<?php
}
?>
