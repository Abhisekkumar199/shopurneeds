<?php
include_once('../classes/config.inc.php');
include_once('../classes/database.inc.php');
include_once('../libraries/function_inc.php');



if($_GET["subcatid"]!='')
{ //start condition to check the value for sub categroy

//echo "SELECT * FROM baby_category WHERE parent = '".$_GET["subcatid"]."' and cat_type='sub-subcategory'";
?>
					
<select name="subsubcatid" class="inputmenu" onchange="getproduct(this.value);">
	<option value="">--Select Sub-Category--</option>
	<?php
	mysqli_query($conn,"SELECT * FROM flip_category WHERE parent = '".$_GET["subcatid"]."' and cat_type='sub-subcategory'") ;
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

					
<select name="subsubcatid" class="inputmenu">
	<option value="">--Select Sub-SubCategory--</option>
</select>
				
<?php
}
?>



