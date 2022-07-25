<?php
include_once('../classes/config.inc.php');
include_once('../classes/database.inc.php');
include_once('../libraries/function_inc.php');




if($_GET["offername"]!='')
{ 
//start condition to check the value for offer selling price
	//echo "select * from offers where displayflag='1' and offername='".$_GET['offername']."' order by offername ASC","<br>";
	//echo $_GET['offername'],"<br>";
	//echo $_GET['mrp'];
	//echo "select * from baby_offers where displayflag='1' and id='".$_GET['offername']."' order by offername ASC";
	$sqloff=mysqli_query($conn,"select * from flip_offers where displayflag='1' and id='".$_GET['offername']."' order by offername ASC") ;
	$row_off= mysqli_fetch_array($sqloff);
	
	
	$mrp=$_GET['mrp'];
	if($row_off['offervalue']=='0')
	{
		$percentdisc=$row_off['discount'];
		$discountvalue=($percentdisc*$mrp)/100;
		
		$sellingprice=$mrp-$discountvalue;
	}
	elseif($row_off['offervalue']!='0')
	{
		$discountvalue=$row_off['offervalue'];
	
		$sellingprice=$mrp-$discountvalue;						
	}
?>


<input type="text" name="sellingprice" class="inputtext" value="<?php echo $sellingprice;?>" readonly="True" />

<?php
} //end condition to check the value for offer selling price

else
{
?>
<input type="text" name="sellingprice" class="inputtext" value="" readonly="True" />
<?php
}
?>