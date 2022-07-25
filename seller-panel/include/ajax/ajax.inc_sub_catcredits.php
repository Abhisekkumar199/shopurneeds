<?php
include_once('../classes/config.inc.php');
include_once('../classes/database.inc.php');
include_once('../libraries/function_inc.php');


if($_REQUEST['catid']!='')
{
	$ccc = $_REQUEST["catid"];
	$catiddd = " and parent IN($ccc)";
}

if($_REQUEST["catid"]!='')
{
?>
<select name="subcategoryname[]" class="inputmenu getselectedoptionvalue" style="width:500px; height:300px;" multiple="multiple" onchange="getselectoption();">
  <option value="">--Select Product--</option>
  <?php
	mysqli_query($conn,"SELECT * FROM shopurneeds_category WHERE displayflag='1' {$catiddd}") ;
	while($row_subcat= mysqli_fetch_assoc())
	{
	?>
  <option value="<?php echo $row_subcat['cat_id']; ?>"><?php echo $row_subcat['categoryname']; ?></option>
  <?php 
		}
			?>
</select>
<?php
} //end condition to check the value for sub categroy	
else
{
?>
<select name="subcategoryname[]" class="inputmenu" style="width:500px; height:300px;" multiple="multiple">
  <option value="">--Select Product--</option>
</select>
<?php
}
?>
