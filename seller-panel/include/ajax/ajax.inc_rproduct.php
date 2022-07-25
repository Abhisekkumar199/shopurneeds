<?php

include_once('../classes/config.inc.php');

include_once('../classes/database.inc.php');

include_once('../libraries/function_inc.php');







if($_GET["pname"]!='')

{ //start condition to check the value for sub categroy 

//

//echo "SELECT * FROM baby_category WHERE parent = '".$_GET["subcatid"]."' and cat_type='sub-subcategory'";

?>

<div style="overflow-x: hidden; overflow-y: scroll; height:200px; width:500px; border: 1px solid #333333;">

<table width="100%" border="0" cellspacing="3" cellpadding="3" style="border:1px solid #EBEBEB;">

  <?php

	mysqli_query($conn,"SELECT id,productname FROM shopurneeds_master_product WHERE  displayflag='1' and (productname LIKE '%".$_GET["pname"]."%'  || id='".$_GET['pname']."')  limit 0,10") ;

	while($row_product= mysqli_fetch_assoc())

	{

	?>

  

  <tr>

    <td><input type="checkbox" name="rid[]" cols="25" rows="5" value="<?php echo $row_product['id']; ?>" /></td>

	<td class="txt"><?php echo $row_product['productname']; ?></td>

  </tr>

  <?php } ?>

</table>

</div>

<?php

	} //end condition to check the value for sub categroy	



?>