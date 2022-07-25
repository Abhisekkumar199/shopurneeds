<?php
session_start();
include_once('../classes/config.inc.php');
include_once('../classes/database.inc.php');
include_once('../classes/cart.inc.php');
define('Currency', 'Rs. ');
define('URL','http://localhost/favola');



$quantity=$_GET["discvalue"];
if($_GET["discvalue"]!='')
{ //start condition to check the value for sub categroy  
$vvalue="";
//echo "SELECT * FROM baby_category WHERE parent = '".$_GET["subcatid"]."' and cat_type='sub-subcategory'"; 
$sql=mysqli_query($conn,"SELECT discountvalue FROM flip_discountcodes WHERE disc_code='".$_GET['discvalue']."' and `displayflag`='1' and `validto`>'".date("Y-m-d")."'") ;
$numdisc=$basket->num($sql);
if($numdisc>0)
{
	$rows= $basket->fetchAssoc($sql);
	 $vvalue=$rows['discountvalue'];
	 
	 //$totalcost=($_REQUEST['totalvalue'] - $vvalue);
	 mysqli_query($conn,"update `flip_basket` set disccode='".$_GET['discvalue']."', `vouchervalue`='". $vvalue."' where bid='".$_SESSION['shopid']."'");
	 
		$sql=$basket->selectcart('flip_') ;
		$num=$basket->num($sql);
		$pwieght=0; //
		$totalweight=0;
		if($num > 0)
		{
			$totalval=0;
			while($rows = mysqli_fetch_assoc($sql))
			{	
				 
				 $totalval=$totalval + $rows['subtotal'];
			}
	
	}
	
	$totalcost=$totalval - $vvalue;
?>
<div class="cart-collaterals"> 
<!-- BEGIN COL2 SEL COL 1 -->
<div class="totals col-2">

<h3>Shopping Cart Total</h3>
<div class="inner">

    <table id="shopping-cart-totals-table" class="table shopping-cart-table-total">
        <col />
        <col width="1" />
        <tfoot>
            <tr>
    <td style="" class="a-left" colspan="1">
        <strong>Grand Total</strong>
    </td>
    <td style="" class="a-right">
        <strong><span class="price"><?php echo Currency; ?> <?php echo number_format(($totalcost + $shipcharge),2); ?></span></strong>
    </td>
</tr>
        </tfoot>
        <tbody>
            <tr>
    <td style="" class="a-left" colspan="1">
        Subtotal    </td>
    <td style="" class="a-right">
        <span class="price"><?php echo Currency; ?> <?php echo number_format($totalcost,2); ?></span>    </td>
</tr>
        </tbody>
    </table>
  </form>
<ul class="checkout">           
<?php	$_SESSION['shipping']=$shipcharge;
						$_SESSION['productcost']=$totalcost;
						$_SESSION['totalcost']=($totalcost + $shipcharge); //
						$_SESSION['weight']=$totalweight; ?>	       
<li>
    <button type="button" title="Proceed to Checkout" class="button btn-proceed-checkout" onclick="document.getElementById('frmbasketpopup').submit();"><span>Proceed to Checkout</span></button>
</li><br />

</ul>                
</div><!--inner-->

</div> <!--totals col-2-->

<!-- BEGIN TOTALS COL 2 -->
<div class="col2-set col-1">

<div class="discount">
  <h3>Discount Codes</h3>
            <label for="coupon_code">Enter your coupon code if you have one.</label>
            <input name="discvalue2" type="hidden" id="discvalue2" size="31" value="<?php echo  $vvalue; ?> " />                        
                <input  class="input-text fullwidth" type="text" id="discvalue" name="discvalue" value="<?php echo $_GET['discvalue']; ?>" readonly="readonly"/><br />                               <span style="color:#006600;">Congratulation, Voucher Code valid.</span>                       
                  <button type="button" title="Apply Coupon" class="button coupon " onclick="disvalue()" value="Apply Coupon"><span>Apply Coupon</span></button>             
                               
</div> <!--discount--> 

</div>


</div> 

	

<?php
}
else
{
		$sql=$basket->selectcart('flip_');
		$num=$basket->num($sql);
		$pwieght=0; //
		$totalweight=0;
		if($num > 0)
		{
			$totalcost=0;
			while($rows = mysqli_fetch_assoc($sql))
			{	
				 
			  $totalcost=$totalcost + $rows['subtotal'];
			}
	
	}
	
	//$totalcost=($totalcost- $vvalue);

?>
<div class="cart-collaterals"> 
<!-- BEGIN COL2 SEL COL 1 -->
<div class="totals col-2">

<h3>Shopping Cart Total</h3>
<div class="inner">

    <table id="shopping-cart-totals-table" class="table shopping-cart-table-total">
        <col />
        <col width="1" />
        <tfoot>
            <tr>
    <td style="" class="a-left" colspan="1">
        <strong>Grand Total</strong>
    </td>
    <td style="" class="a-right">
        <strong><span class="price"><?php echo Currency; ?> <?php echo number_format(($totalcost + $shipcharge),2); ?></span></strong>
    </td>
</tr>
        </tfoot>
        <tbody>
            <tr>
    <td style="" class="a-left" colspan="1">
        Subtotal    </td>
    <td style="" class="a-right">
        <span class="price"><?php echo Currency; ?> <?php echo number_format($totalcost,2); ?></span>    </td>
</tr>
        </tbody>
    </table>
  </form>
<ul class="checkout">           
<?php	$_SESSION['shipping']=$shipcharge;
						$_SESSION['productcost']=$totalcost;
						$_SESSION['totalcost']=($totalcost + $shipcharge); //
						$_SESSION['weight']=$totalweight; ?>	       
<li>
    <button type="button" title="Proceed to Checkout" class="button btn-proceed-checkout" onclick="document.getElementById('frmbasketpopup').submit();"><span>Proceed to Checkout</span></button>

</ul>                
</div><!--inner-->

</div> <!--totals col-2-->

<!-- BEGIN TOTALS COL 2 -->
<div class="col2-set col-1">

<div class="discount">
  <h3>Discount Codes</h3>
            <label for="coupon_code">Enter your coupon code if you have one.</label>
            <input name="discvalue2" type="hidden" id="discvalue2" size="31" value="<?php echo  $vvalue; ?> " />                        
                <input  class="input-text fullwidth" type="text" id="discvalue" name="discvalue" value="<?php echo $_GET['discvalue']; ?>" />   <br />                      <span style="color:#FF0000;">Invalid Voucher Code! Please try again    </span>                         
                  <button type="button" title="Apply Coupon" class="button coupon " onclick="disvalue()" value="Apply Coupon"><span>Apply Coupon</span></button>                <div id="vcode"></div>
                               

</div> <!--discount--> 
</div></div>


<?php



}	
	

}  else { 


	$sql=$basket->selectcart('flip_');
		$num=$basket->num($sql);
		$pwieght=0; //
		$totalweight=0;
		if($num > 0)
		{
			$totalcost=0;
			while($rows = mysqli_fetch_assoc($sql))
			{					 
			   $totalcost=$totalcost + $rows['subtotal'];
			}
	
	}
?>
<div class="cart-collaterals"> 
<!-- BEGIN COL2 SEL COL 1 -->
<div class="totals col-2">

<h3>Shopping Cart Total</h3>
<div class="inner">

    <table id="shopping-cart-totals-table" class="table shopping-cart-table-total">
        <col />
        <col width="1" />
        <tfoot>
            <tr>
    <td style="" class="a-left" colspan="1">
        <strong>Grand Total</strong>
    </td>
    <td style="" class="a-right">
        <strong><span class="price"><?php echo Currency; ?> <?php echo number_format(($totalcost + $shipcharge),2); ?></span></strong>
    </td>
</tr>
        </tfoot>
        <tbody>
            <tr>
    <td style="" class="a-left" colspan="1">
        Subtotal    </td>
    <td style="" class="a-right">
        <span class="price"><?php echo Currency; ?> <?php echo number_format($totalcost,2); ?></span>    </td>
</tr>
        </tbody>
    </table>
  </form>
<ul class="checkout">           
<?php	$_SESSION['shipping']=$shipcharge;
						$_SESSION['productcost']=$totalcost;
						$_SESSION['totalcost']=($totalcost + $shipcharge); //
						$_SESSION['weight']=$totalweight; ?>	       
<li>
    <button type="button" title="Proceed to Checkout" class="button btn-proceed-checkout" onclick="document.getElementById('frmbasketpopup').submit();"><span>Proceed to Checkout</span></button>
</li><br />

</ul>                
</div><!--inner-->

</div> <!--totals col-2-->

<!-- BEGIN TOTALS COL 2 -->
<div class="col2-set col-1">

<div class="discount">
  <h3>Discount Codes</h3>
            <label for="coupon_code">Enter your coupon code if you have one.</label>
            <input name="discvalue2" type="hidden" id="discvalue2" size="31" value="<?php echo  $vvalue; ?> " />                        
                <input  class="input-text fullwidth" type="text" id="discvalue" name="discvalue" value="<?php echo $_GET['discvalue']; ?>" />     <br />                                         
                  <button type="button" title="Apply Coupon" class="button coupon " onclick="disvalue()" value="Apply Coupon"><span>Apply Coupon</span></button>                <div id="vcode"></div>
                               

</div> <!--discount--> 
</div></div>

<?php } ?>