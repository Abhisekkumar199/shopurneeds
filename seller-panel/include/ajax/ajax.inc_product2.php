<?php
include_once('../classes/config.inc.php');
include_once('../classes/database.inc.php');
include_once('../libraries/function_inc.php');



if($_GET["pid"]!='')
{ //start condition to check the value for sub categroy

//echo "SELECT * FROM baby_category WHERE parent = '".$_GET["subcatid"]."' and cat_type='sub-subcategory'";

mysqli_query($conn,"SELECT productname,subsubcat_id,subcat_id FROM flip_product WHERE id='".$_GET['pid']."'") ;

$rowproduct=mysqli_fetch_assoc();
?>
<?php 
//echo $_REQUEST['pname'];
if($_REQUEST['pname']!='' && $_REQUEST['pid2']!='')
{
	
	$pname2=$rowproduct['productname'];
	
	$pos3 = strpos($pname2, $_REQUEST['pname']);
    if ($pos3 === false) {
     $pname=$rowproduct['productname'].",".$_REQUEST['pname'];
	$pname2=$rowproduct['productname']."~".$_REQUEST['pname'];
    } else {
       $pname=$rowproduct['productname'];
	   $pname2=$rowproduct['productname'];
    }
	
	
	$pid=$_REQUEST['pid'].",".$_REQUEST['pid2'];
	
	$subcat=$rowproduct['subcat_id'];
	
	$pos = strpos($subcat, $_REQUEST['subcatid']);
    if($pos === false) 
	{
       $subcatid=$rowproduct['subcat_id'].",".$_REQUEST['subcatid'];
    } 
	else
	{
       $subcatid=$rowproduct['subcat_id'];
    }
	
	$subsubcat=$rowproduct['subsubcat_id'];
	
	$pos2 = strpos($subsubcat, $_REQUEST['subsubcatid']);
    if ($pos2 === false) {
      $subsubcatid=$rowproduct['subsubcat_id'].",".$_REQUEST['subsubcatid'];
    } else {
       $subsubcatid=$rowproduct['subsubcat_id'];
    }
	
	

	
}
else
{
	$pname=$rowproduct['productname'];	
	$pname2=$rowproduct['productname'];
	$pid=$_REQUEST['pid'];
	$subcatid=$rowproduct['subcat_id'];
	$subsubcatid=$rowproduct['subsubcat_id'];
}	
?>
&nbsp;&nbsp;<input type="text" name="productname" id="productname" class="inputtext" cols="20" rows="5"  value="<?php echo $pname; ?>" />
<input type="hidden" name="tempproductname" id="tempproductname" class="inputtext" cols="20" rows="5"  value="<?php echo $pname2; ?>" />
<input type="hidden" name="pid" id="pid" class="inputtext" cols="20" rows="5"  value="<?php echo $pid; ?>" />
<input type="hidden" name="subcatid2" id="subcatid" class="inputtext" cols="20" rows="5"  value="<?php echo $subcatid; ?>" />
<input type="hidden" name="subsubcatid2" id="subsubcatid" class="inputtext" cols="20" rows="5"  value="<?php echo $subsubcatid; ?>" />
<?php	

} //end condition to check the value for sub categroy	

else
{
?>

				
<?php
}
?>



