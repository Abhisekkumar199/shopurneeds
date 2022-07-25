<?php
if($_SESSION['emailid']!="") {

if($_SESSION['oid']!="") {
if($_REQUEST['statusd']=="completed") {
if($_REQUEST['idssas']!="") {
session_start();
include("includes/configuration.php");	
include("includes/currency_display.php");

include("includes/libraries/mailfunction.php");
date_default_timezone_set('Asia/Calcutta');
$CompanyEmail=CompanyEmail; //
$CompanyName=CompanyName; // 
$URL=URL;
					if($_SESSION['emailid']!='')
				{
					$action="shipping";
				}
				else
				{
					$action="checkout_one"; //
				}
			?>
<td width="748" valign="top"><?php  //mysqli_query($conn,"update ".$sufix."order set `paymentflag`='1', `approve_status`='Processing' where oid ='".$_SESSION['oid']."' and emailid='".$_SESSION['emailid']."'"); 
	$sql=mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$_SESSION['emailid']."'") ;
	$rowuser=mysqli_fetch_assoc($sql);	
	$sql2=mysqli_query($conn,"select * from ".$sufix."order where oid ='".$_SESSION['oid']."' and emailid='".$_SESSION['emailid']."'") ;
	$roworder=mysqli_fetch_assoc($sql2);  // 
//
$sqlupdate123=mysqli_query($conn,"update ".$sufix."order set remarks='Order Approved',  approve_status='Order Approved', onlinemode='online' where oid='".$_SESSION['oid']."'");
?>
  <main class="container">
    <div class="row">
      <div class="col-lg-10 grid-center ot_20 clearfix">
        <div class="row">
          <div class="col-sm-12 shoping-gridLine">
            <div class="step2 shopping_step_col hidden-xs"> <span class="step_num">1</span><span>Sign In / Sign Up</span> </div>
            <div class="step1 shopping_step_col hidden-xs"> <span class="step_num">2</span><span>Shopping Summary</span> </div>
            <div class="step3 shopping_step_col hidden-xs"> <span class="step_num">3</span><span>Shipping</span> </div>
            <div class="step4 shopping_step_col hidden-xs"> <span class="step_num">4</span><span>Payment</span> </div>
            <div class="step5 shopping_step_col active"> <span class="step_num">5</span><span>Reciept</span> </div>
          </div>
          <div class=" card-wrap" style="border:0;">
            <div class="col-md-12 col-sm-2 pd-70 " > <?php echo session_msg(); ?>
              <?php
			  $basketpid=$_SESSION['shopid'];
			  $emailid = $_SESSION['emailid'];
			  $orderid = $_SESSION['oid'];
			  $usersql = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$emailid."'"));
			  $sqlbas=mysqli_query($conn,"select *, subtotal As subtotal1,quantity As quantity1,(shipprice*quantity) As shipprice1,(cod_charges*quantity) As cod_charges1,(tax*quantity) As tax1,totalweight As totalweight1  from ".$sufix."basket where bid='$basketpid'");
	$i=1;
	while($row1=mysqli_fetch_array($sqlbas))
	{
	$idtt=$orderid."-".$i;
	mysqli_query($conn,"insert into ".$sufix."order_seller(`id`,`oid`,`seller_id`,`bid`, `quantity2`, `totalcost`,`cashcoinvalue`, `shipcharge`,`cod_charges`,`tax`, `discountcode`, `vouchervalue`, `oweight`, `userid`, `emailid`, `displayflag`, `orderdate`, `ordertime`, `approve_status`, `confirm_status`, `deliver_status`, `paymentflag`, `dtitle`, `deliver_fname`, `deliver_lname`, `deliver_address`, `deliver_housenumber`, `deliver_city`, `deliver_state`, `deliver_country`, `deliver_zip`, `deliver_phone`, `shippingmethod`, `shipping_cost`,paytype,ipaddress, orderinistatus, ordermode,orderstatus,reference_id) values ('".$idtt."','".$orderid."','".$row1['seller_id']."','".$basketpid."', '".$row1['quantity1']."', '".$row1['subtotal1']."','',  '".$row1['shipprice1']."','".$row1['cod_charges1']."','".$row1['tax1']."', '".$discvalue."', '".$vouchervalue."', '".$row1['totalweight1']."', '".$emailid."', '".$emailid."', '1','".date('Y-m-d')."', '".date("H:i")."', 'Order Approved','0','0','1', '".$rowuser['dtitle']."', '".$rowuser['dfname']."', '".$rowuser['dlname']."', '".$rowuser['deliver_address']."', '".$rowuser['deliver_housenumber']."', '".$rowuser['deliver_city']."', '".$rowuser['deliver_state']."', '".$rowuser['deliver_country']."', '".$rowuser['deliver_zip']."', '".$rowuser['deliver_phone']."', '".$method[0]."', '".$method[1]."','onlinepay','$ipaddress', 'Order Approved', 'onlinepay','".$_REQUEST['statusd']."','".$_REQUEST['idssas']."')") ;	
	$oseller=mysql_insert_id();
	$sqlsellerid = mysqli_query($conn,"select id from ".$sufix."order_seller where sid='".$oseller."'");
	$fisellid = mysqli_fetch_array($sqlsellerid,0);
mysqli_query($conn,"update ".$sufix."basket set oid_seller='$fisellid' where bid='$basketpid' and seller_id='".$row1['seller_id']."' and oid_seller='' limit 1") ;

mysqli_query($conn,"insert into ".$sufix."order_status(`oid`,`remarks`,`adddate`, `addtime`, `displayflag`,`ordermode`) values ('".$fisellid."','Order Approved','".date('Y-m-d')."', '".date("H:m")."', '1','COD')") ;	

$rowpsize=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$row1['productid']."' and product_size='".$row1['size']."'"));
$cartqtyr=$row1['quantity'];
if($rowpsize['qty_stock']>=$cartqtyr)
{
mysqli_query($conn,"update ".$sufix."product_size  set qty=qty-$cartqtyr, qty_stock=qty_stock-$cartqtyr where id='".$rowpsize['id']."'");
mysqli_query($conn,"update ".$sufix."basket  set qtyminusfrom='qty_stock' where bid='".$basketpid."' and productid='".$row1['productid']."'");
}
else if($rowpsize['qty_rto']>=$cartqtyr)
{
mysqli_query($conn,"update ".$sufix."product_size  set qty=qty-$cartqtyr, qty_rto=qty_rto-$cartqtyr where id='".$rowpsize['id']."'");
mysqli_query($conn,"update ".$sufix."basket  set qtyminusfrom='qty_rto' where bid='".$basketpid."' and productid='".$row1['productid']."'");
}
else if($rowpsize['qty_cmnt']>=$cartqtyr)
{
mysqli_query($conn,"update ".$sufix."product_size  set qty=qty-$cartqtyr, qty_cmnt=qty_cmnt-$cartqtyr where id='".$rowpsize['id']."'");
mysqli_query($conn,"update ".$sufix."basket  set qtyminusfrom='qty_cmnt' where bid='".$basketpid."' and productid='".$row1['productid']."'");
}
else
{
mysqli_query($conn,"update ".$sufix."product_size  set qty=qty-$cartqtyr, qty_bo=qty_bo-$cartqtyr where id='".$rowpsize['id']."'");
mysqli_query($conn,"update ".$sufix."basket  set qtyminusfrom='qty_bo' where bid='".$basketpid."' and productid='".$row1['productid']."'");
}	$i++;
	
	$cashback_price = $cashback_price+$row1['cashback_price'];
	}
	
	mysqli_query($conn,"update ".$sufix."user_registration  set cashback='".$cashback_price."' where emailid='".$emailid."'");
	
	mysqli_query($conn,"update ".$sufix."order  set orderstatus='".$_REQUEST['statusd']."',reference_id='".$_REQUEST['idssas']."' where oid='".$orderid."'");
$api_key = '55AA12057210C1';
$contacts = $usersql['billing_mobile']; 
$from = 'shopurneedsIN';
$sms_text = urlencode("Congratulations! Your https://localhost/project/shopurneeds order :".$orderid." successfully generated, You can use this for further assistant.");
//Submit to server
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, "http://bulksms.preeticonsultancy.com/app/smsapi/index.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=9&type=text&contacts=".$contacts."&senderid=shopurneedsIN&msg=".$sms_text);
$response = curl_exec($ch);
curl_close($ch);
$coupanupdate=mysqli_query($conn,"update ".$sufix."user_coupon set displayflag='1' where coupon_code='".$_SESSION['coupancode']."' and coupon_id='".$_SESSION['coup_id']."' and user_id='".$_SESSION['useridse']."'");
include("order_mail.php");	// 
send_mail($toc, $subjectc, $message, $headers1, $fromc, '');
include("order_mail_admin.php");
send_mail($toc, $subjectc, $message, $headers1, $fromc, '');	
?>
<div class="col-sm-12"><img src="https://localhost/project/shopurneeds/thankyou-img.jpeg"></div>
            <div class="clearfix"></div>
              <h5>Hey <?php echo $usersql['fname'].'&nbsp;'.$usersql['lname'];?>, <span class="pull-right">Order Date:<?php
$orderdate = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."order where oid='".$_SESSION['oid']."'"));
echo $orderdate['orderdate'];
?></span></h5>
              <div > Your https://localhost/project/shopurneeds <strong>order no. <?php echo $_SESSION['oid'];?></strong> has successfully been booked. You`ll find all the details about your order below, and we`ll send you a shipping confirmation email as soon as your order ships </div>
              <div class="clearfix"></div>
              <div class="delivery-left col-sm-12 " style="padding:0;">
                <div class="billing-add col-sm-4 col-xs-12">
          <p><strong>Customer Information</strong></p>
          <?php echo $usersql['fname'].'&nbsp;'.$usersql['lname'];?><br>
          <?php echo $usersql['emailid'];?><br>
          <?php echo $usersql['deliver_phone'];?><br>
        </div>
        <div class="shipping-add col-sm-4 pull-right col-xs-12">
          <p><strong>Shipping Address</strong></p>
          <?php echo $usersql['deliver_address'];?><br>
          <?php echo $usersql['deliver_city'];?><br>
          <?php echo $usersql['deliver_state'];?> - <?php echo $usersql['deliver_zip'];?><br>
          <?php
		  $country = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."country where countrycode='".$usersql['deliver_country']."'"));
		  echo  $country['countryname'];
		  ?>        </div>
              </div>
                <div class="clearfix"></div>
              <div class="table-responsive">
        <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border:1px solid #ddd !important; margin-top:5px;" class="table">
          <tbody>    
<tr>
              <th width="25%" style="text-align:center">            <div class="detail-head_col">Product</div>
                        </th>
              <th width="44.5%" style="text-align:center">            <div class="detail-head_col">Product Description</div>
                        </th>
              
             
              <th width="14%" style="text-align:center">            <div class="detail-head_col">Unit</div>
                    
              </th>
               <th width="16.5%" style="text-align:center">             <div class="detail-head_col">Sub Total</div>
                    
              </th>
            </tr>
<?php

mysqli_query($conn,"select * from `".$sufix."basket` where bid='".$basketpid."'") ;		
$totalval=0;
$count=1;
$totalcost=0;
$cod_charges1=0;
$tax1 = 0;
$discount_price1 = 0;
$sellprice1 = 0;
$coupan_discount1= 0;
$totaldiscount = 0;
$shipprice1 = 0;
while($row=mysqli_fetch_assoc())
{	
$pwieght=$pwieght + $row['totalweight'];
$totalweight=$totalweight + $row['totalweight'];
$totalcost=$totalcost + $row['subtotal'];
$quantity = $row['quantity'];
$sellprice = $row['sellprice1']*$row['quantity'];
$discount_price = $row['discount_price']*$row['quantity'];
$coupan_discount = $row['coupan_discount']*$row['quantity'];
$shipprice1 = $row['shipprice1']*$row['quantity'];
$shipprice = $shipprice+$shipprice1;
$tax = $row['tax']*$row['quantity'];
$cod_charges = $row['cod_charges']*$row['quantity'];
$cod_charges1 = $cod_charges1+$cod_charges;
$tax1 = $tax1+$tax;
$sellprice1 = $sellprice1+$sellprice;
$discount_price1 = $discount_price1+$discount_price;
$coupan_discount1 = $coupan_discount1+$coupan_discount;
$coupon_discount = $row['coupan_discount'];
?>
            <tr>
              <td><div class="detail-info_col text-center">
                        <img src="<?php echo $cdnurl;?>/uploads/productimage/thumb/<?php echo $row['productimage']; ?>" style="max-height:100px;" border="0">
                      </div></td>
              <td><div class="detail-info_col">
            <p class="da_product-name"><a href="<?php echo URL;?>/<?php echo $row['slug']; ?>"><?php echo $row['productname']; ?></a></p>
            <small class="da_cart_ref">SKU : <a href="<?php echo URL;?>/<?php echo $row['slug']; ?>"><?php echo $row['sku']; ?></a></small> <br>
            <small> Size : <?php echo $row['size']; ?> </small> </div></td>
              
             
              <td><div class="detail-info_col text-center "><?php echo $row['quantity'];?></div></td>
               <td><div class="detail-info_col text-center">
            <p><?php echo Currency; ?> <?php echo ($row['subtotal']*$_SESSION['conratio']); ?></p>
          </div></td>
            </tr>
			<?php $count++;

}
$totaldiscount = ($discount_price1+$coupan_discount1);
$subtotalnew = ($sellprice1-$totaldiscount);
if($vouchervalue!='')
{
$totalcost=$totalcost-$vouchervalue;
}
else
{
$totalcost=$totalcost;
}
?>
             </tbody>
        </table></div>
              <div class="col-sm-12 basketdeatil-total_col checkout-total-col">
        <div class="col-sm-10 col-xs-8 text-right" style="padding:0">
          <div class="detail-total_col"><strong>Order Subtotal:</strong></div>
        </div>
        <div class="col-sm-2 col-xs-4" style="padding:0">
          <div class="detail-total_col text-center"> <?php echo Currency;?> <?php echo ($sellprice1*$_SESSION['conratio']);?></div>
        </div>
                <div class="col-sm-10 text-right col-xs-8" style="padding:0">
          <div class="detail-total_col"><strong>Shipping Charges:</strong></div>
        </div>
        <div class="col-sm-2 col-xs-4" style="padding:0">
          <div class="detail-total_col text-center"><?php echo Currency;?> <?php echo ($shipprice*$_SESSION['conratio']);?></div>
        </div>
        <div class="col-sm-10 col-xs-8 text-right" style="padding:0">
          <div class="detail-total_col"><strong>Estimated Order Total:</strong></div>
        </div>
        <div class="col-sm-2 col-xs-4" style="padding:0">
          <div class="detail-total_col text-center">
            <?php echo Currency;?> <?php
$gtotal=($totalcost + $shipprice+$tax1+$cod_charges1);
echo $gtotal1 = ($gtotal*$_SESSION['conratio']);

?></div>
        </div>
      </div>
            </div>
          </div>
        </div>
       
      </div>
    </div>
    <script>
    $('.optradio').change(function () {
alert("asdf");
		var getValue = $(this).val();
		if(getValue==1) { 
        if($(this).is(':checked')) {
            $('.password123').prop('required', true);
        } else {
            $('.password123').prop('required', false);
        }
		}
    });
</script> 
    <script>
$(document).ready(function(){
	$( ".forget_password" ).click(function() {
  		$("#forgot_password_div").slideToggle(1000);
			});
	$( ".show_password" ).click(function() {
  		$(".member_login").css("display", "block");
	});
	$( ".hide_password" ).click(function() {
  		$(".member_login").css("display", "none");
	});
	});
</script> 
    <script>
    $('#frmCheckandApply').validate({
        rules: {
            CouponCode: {
                required: true
            },
        },
        messages: {
            CouponCode: "Apply coupon code!"
        }
    });
</script> 
    <script type="text/javascript">
    $('#formUpdateCart').validate({
       rules: {
            ProductSizeId:
            {
                required: true,
            },
            //ProductColorId: {
            //    required: true
            //},
            quantity: {
                greaterThanZero: true,
           },
        },
        messages: {
            //ProductColorId: "Choose Color",
            quantity: "Invalid quantity",
           ProductSizeId: "Please select size"
        }
    });
    jQuery.validator.addMethod("greaterThanZero", function (value, element) {
        return (parseFloat(value) > 0);
    }, "* Invalid quantity");
  </script> 
  </main>
  <?php $totalValue=$roworder['totalcost']*$_SESSION['conratio']; ?>
  <script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 805336370;
var google_conversion_label = "99BhCK7C04IBELLqgYAD";
if (<? echo $totalValue ?>) {
		var google_conversion_value = <? echo floor($totalValue); ?>;
		var google_conversion_currency = <? echo CurrencyCode; ?>;
	}
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/805336370/?value=<? echo floor($totalValue); ?>&amp;currency_code=<? echo CurrencyCode; ?>&amp;label=99BhCK7C04IBELLqgYAD&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
  <?php
  	unset($_SESSION['shopid']);	
	unset($_SESSION['shipping']);
	unset($_SESSION['productcost']);
	unset($_SESSION['totalcost']);
	unset($_SESSION['weight']);
  ?>
  <style>.detail-head_col, .detail-info_col{ border:0 !important} table{ border-color:#ddd !important; margin-bottom:0 !important;} table th, .detail-info_col{ padding:0 !important}</style>
  <!-- Google Code for Order Placed Conversion Page -->
  <?php } } } }?>
