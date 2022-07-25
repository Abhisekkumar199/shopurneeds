<?php
include_once('../classes/config.inc.php');
include_once('../classes/database.inc.php');
include_once('../libraries/function_inc.php');

//

$vatval=$_REQUEST['vatval'];
$mrp=$_GET['mrp'];
$selling=$_GET['selling'];

if($vatval!='0.00')
	{
		$vat2=($vatval + 100)/100;
		//alert (vat2);
		$n4=$selling/$vat2;
		$n3= ($selling - $n4);
		//n3.toFixed(2);
		
		//document.getElementById('sellingvat').value=vat2;  
		//alert (n3.toFixed(2)); 
	
	}
else
{
	$n3="0.00";

}	
	//echo round($vat2, 2);;
	//echo number_format($vat2,2);
	
if($_GET["offername"]!='')
{ 
//start condition to check the value for offer selling price
	//echo "select * from offers where displayflag='1' and offername='".$_GET['offername']."' order by offername ASC","<br>";
	//echo $_GET['offername'],"<br>";    
	//echo $_GET['mrp'];
	//echo "select * from baby_offers where displayflag='1' and id='".$_GET['offername']."' order by offername ASC";
	$sqloff=mysqli_query($conn,"select * from flip_offers where displayflag='1' and id='".$_GET['offername']."' order by offername ASC") ;
	$row_off= mysqli_fetch_array($sqloff);
	
	
	
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
	
	//
	
?>
<input type="text" name="sellingprice" id="selling" class="inputtext" value="<?php echo $sellingprice;?>" />
<input id="sellingvat" type="hidden" name="sellingpricevat" class="inputtext" value="<?php echo number_format($n3,2); ?>"/>

<?php
} //end condition to check the value for offer selling price

else
{
?>
<input type="text" name="sellingprice" id="selling" class="inputtext" value=""/>
<input id="sellingvat" type="hidden" name="sellingpricevat" class="inputtext" value="<?php echo number_format($n3,2); ?>"/>
<?php
}
?>