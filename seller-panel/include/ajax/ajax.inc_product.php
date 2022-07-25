<?php
include_once('../classes/config.inc.php');
include_once('../classes/database.inc.php');
include_once('../libraries/function_inc.php');



if($_GET["subsubcatid"]!='')
{ //start condition to check the value for sub categroy

//echo "SELECT * FROM baby_category WHERE parent = '".$_GET["subcatid"]."' and cat_type='sub-subcategory'";
?>
					
<select name="product" class="inputmenu" required onchange="getproduct2(this.value);">
	<option value="">--Select Product--</option>
	<?php
	mysqli_query($conn,"SELECT id,productname FROM flip_product WHERE subsubcat_id='".$_GET['subsubcatid']."'") ;
	while($row_product= mysqli_fetch_assoc())
	{
	?>
	
	<option value="<?php echo $row_product['id']; ?>"><?php echo $row_product['productname']; ?></option>	
		<?php 
		}
			?>									
</select>
				

<?php
	

} //end condition to check the value for sub categroy	

else
{
?>

					
<select name="product" class="inputmenu" required>
	<option value="">--Select Product--</option>
</select>
				
<?php
}
?>



