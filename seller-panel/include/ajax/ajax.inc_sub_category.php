<?php
include_once('../classes/config.inc.php');
include_once('../classes/database.inc.php');
include_once('../libraries/function_inc.php');



if($_GET["catid"]!='')
{ //start condition to check the value for sub categroy

//echo "SELECT * FROM baby_category WHERE parent = '".$_GET["catid"]."' and cat_type='subcategory'";
?>
					
<select name="subcatid" class="inputmenu">
	<option value="">--Select Sub-Category--</option>
	<?php
	mysqli_query($conn,"SELECT * FROM flip_category WHERE parent = '".$_GET["catid"]."' and cat_type='subcategory'") ;
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

					
<select name="subcatid" class="inputmenu">
	<option value="">--Select Sub-Category--</option>
</select>
				
<?php
}
?>



