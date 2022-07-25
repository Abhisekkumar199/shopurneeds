<?php
include_once('../classes/config.inc.php');
include_once('../classes/database.inc.php');
include_once('../libraries/function_inc.php');

if($_REQUEST['sellerid']!='')
{
	$sss = $_GET["sellerid"];
	$selleriddd = " and seller_id IN($sss)";
}
if($_REQUEST['catid']!='')
{
	$ccc = $_GET["catid"];
	$catiddd = " and cat_id IN($ccc)";
}

if($_GET["catid"]!='' || $_REQUEST['sellerid']!='')
{
?>
<select name="productname[]" class="inputmenu getselectedoptionvalue" style="width:713px; height:300px;" multiple="multiple" onchange="getselectoption();">
  <option value="">--Select Product--</option>
  <?php
	mysqli_query($conn,"SELECT * FROM shopurneeds_product WHERE displayflag='1' {$catiddd}{$selleriddd}") ;
	while($row_subcat= mysqli_fetch_assoc())
	{
	?>
  <option value="<?php echo $row_subcat['id']; ?>"><?php echo $row_subcat['productname']; ?>&nbsp;(<?php echo $row_subcat['sku'];?>)</option>
  <?php 
		}
			?>
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
