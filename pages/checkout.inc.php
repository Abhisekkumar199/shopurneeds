<style> 
table th, .detail-info_col {
    padding: 0 !important;
}
.detail-info_col, .detail-head_col{ border:0 !important}
 .payment-icon1 input[type="radio"], .payment-icon1 input[type="checkbox"] {
    position: relative;
    left: inherit;
    opacity: 1;
    width: auto;
    height: auto;
}
.shipping-add, .billing-add {
    background: #f9f9f9 !important;
    margin-bottom: 20px;
    padding: 10px;    min-height: 146px;
}
.detail-total_col{ line-height:normal !important;}
.detail-info_col *{font-size: 12px;}

.container-radio{  
    padding-left: 7%;
    line-height: 22px; background:#fafafa; padding:15px}

/* Hide the browser's default radio button */
.container-radio input[type="radio"] {
    position: absolute !important;
    opacity: 0 !important;
    cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
    position: absolute;
  top: 15px;
    left: 13px;
    height: 20px;
    width: 20px;
    background-color: #eee;
    border-radius: 50%;
}


/* On mouse-over, add a grey background color */
.container-radio:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container-radio input:checked ~ .checkmark {
    background-color: #5c5c5c;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.container-radio input:checked ~ .checkmark:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.container-radio .checkmark:after {
 top: 7px;
    left: 7px;
    width: 6px;
    height: 6px;
	border-radius: 50%;
	background: white;
}
.border-left0{border-left:0 !important;}
textarea {
    resize: none;
    height: 76px !important;
}
</style>


<?php
if($_SESSION['emailid']!='')
{ 
$action="shipping";
}
else
{
$action="checkout_one"; //
}
 
$sql=mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$_SESSION['emailid']."'"); 
$rows2=mysqli_fetch_assoc($sql); 
$country = mysqli_fetch_assoc(mysqli_query($conn,"select countryname from ".$sufix."country where countrycode='".$rows2['billing_country']."'")); 
$shipcountryss=$country['countryname']; 

$sqlzipcode=mysqli_query($conn,"select * from ".$sufix."pincode where pincode='".$rows2['deliver_zip']."'");
$numzipcode=mysqli_num_rows($sqlzipcode);
?>
<script type="text/javascript">
function paymenttype(val)
{ 
    var speisns = $.trim($('#speciains').val());  
    
    if(val == 'codpay')
    {
    document.payment.action='<?php echo URL; ?>/process/order_process_cod?instur='+speisns;
    // $('.submit2').prop('disabled', true);  

    }
    else if(val == 'ccavenue')
    {
        document.payment.action='<?php echo URL; ?>/process/order_process_ccavenue?instur='+speisns;
    }
    else if(val == 'onlinepay')
    {
        document.payment.action='<?php echo URL; ?>/process/order_process?instur='+speisns;
         
    }
    else if(val == 'paytm')
    {
        document.payment.action='<?php echo URL; ?>/process/order_process_paytm?instur='+speisns;
    }
    else if(val == 'paynet')
    {
        document.payment.action='<?php echo URL; ?>/process/order_process_paynet';
    }
    var estimatetotal = $('#estimatetotal').val();
    var shippingcharge = $('#shippingcharge').val();
    var codcharge = $('#codcharge').val(); 
    var codchargeshow = $('#codchargeshow').val();
    var newestimatetotal = $('#newestimatetotal').val();
    var mobile = $('#mobileforotp').val();
    var emailforotp = $('#emailforotp').val(); 
    jQuery.ajax({
		type: "POST",
		data: { paymentType: val,estimatetotal: estimatetotal,codcharge: codcharge,codchargeshow: codchargeshow, newestimatetotal: newestimatetotal, mobile: mobile, emailforotp: emailforotp},
		url: "<?php echo URL;?>/ajax/ajaxfinalvalue.php",
		success: function(response){  
		    if(val == 'codpay')
            {
                //alert('Please check your email or mobile no. '+ mobile);
                
                //$(".pincodetext").show();
                //$('.submit2').prop('disabled', true);  
                //$('.codpay123').prop('required',true);
                var str1 = response.split("-");
                
                $("#newestimatetotal").html(str1[0]);
                $("#codchargeshow").html(str1[1]); 
                $(".randomotp").val(str1[2].trim());
            }
		    
            else 
            {
		        var str1 = response.split("-");
                $("#newestimatetotal").html(str1[0]);
			    $("#codchargeshow").html(str1[1]); 
                $(".pincodetext").hide(); 
                $('.codpay123').prop('required',false);
        		$('.submit2').prop('disabled', false); 
            }
		}
	}); 
	
}
function get_slot(val)
{ 
    jQuery.ajax({
		type: "POST",
		data: { date: val},
		url: "<?php echo URL;?>/ajax/get_slot.php",
		success: function(response){   
                $("#showslot").html(response);  
		}
	}); 
}
$(document).ready(function(){
$(".codpay123").keyup(function(){

		var randomotp = $(".randomotp").val(); 
		var currentval = $(this).val(); 
		if(randomotp==currentval) 
		{  
    		$(".otperrormatch").text(""); 
    		$('.codpay123').prop('required', false);
    		$('.submit2').prop('disabled', false);  
		} 
		else 
		{    
    		$('.codpay123').prop('required', true); 
    		$('.submit2').prop('disabled', true); 
    	    //	$(".showres").hide(); 
    		$(".otperrormatch").text("Your OTP not match!"); 
		}

    }); 
}); 

</script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
  $( function() {
    $( "#datepicker" ).datepicker({ minDate: 1, maxDate: "+15D" });
  } );
  </script>
<main class="container">

        <div class="row">
          <div class="col-sm-12 shoping-gridLine">
            <div class="step2 shopping_step_col "> <span class="step_num">1</span><span>Sign In / Sign Up</span> </div>
            <div class="step1 shopping_step_col hidden-xs"> <span class="step_num">2</span><span>Shopping Summary</span> </div>
            <div class="step3 shopping_step_col hidden-xs"> <span class="step_num">3</span><span>Shipping</span> </div>
            <div class="step4 shopping_step_col hidden-xs active"> <span class="step_num">4</span><span>Payment</span> </div>
            <div class="step5 shopping_step_col hidden-xs"> <span class="step_num">5</span><span>Reciept</span> </div>
          </div>
     <div class="card-wrap">
        <div class="col-sm-6 littletags-shippingLeft pd-70 col-xs-12">
            
            <form name="payment" method="post" action="<?php echo URL; ?>/process/order_process_cod.php" >
            <div class="main" >  
                <h4>Delivery Date</h4> 
                <label class="col-sm-12 col-xs-12 pull-left payment-icon1 container-radio"> 
                    <input type="text" id="datepicker" name="delivery_date" onchange="get_slot(this.value);" autocomplete="off" placeholder="Select Date" required> 
                </label> 
                <span id="showslot">
                    
                </span>
                    <div class="clearfix"></div>
                <h4 style="margin-top:30px">Payment Options</h4> 
                <label class="col-sm-12 col-xs-12 pull-left payment-icon1 container-radio">
                    <input name="paytype" type="radio" value="codpay"  onclick="paymenttype(this.value);" <?php if($_SESSION['totalpaybleamount'] >1999 or $_SESSION['totalpaybleamount'] == 0) { echo "disabled";  } else { ?> required <?php } ?> >
                    <span class="checkmark"></span>
                    <span style="padding-left:7%">Pay on Delivery</span>
                </label>
                <label class="col-sm-12 col-xs-12 pull-left payment-icon1 container-radio">
                    <input name="paytype" type="radio" value="onlinepay"   onclick="paymenttype(this.value);" <?php if($_SESSION['totalpaybleamount'] < 1) { echo "disabled"; } else { ?> required <?php } ?> >
                    <span class="checkmark"></span>
                    <span style="padding-left:7%"><img src="https://localhost/project/shopurneeds/assets/images/online-payment.jpg"></span>
                </label>
                
                <?php if($_SESSION['user_wallet_amount'] > 0 and $_SESSION['totalpaybleamount'] < 1) { ?>
                    <label class="col-sm-12 col-xs-12 pull-left payment-icon1 container-radio">
                        <input name="paytype" type="radio" value="wallet"   checked >
                        <span class="checkmark"></span>
                        <span style="padding-left:7%">Pay From Wallet</span>
                    </label>
                <?php } ?>
                
                
                <span class="pincodetext" style="display: none;">
                    <p style="color:">Please note, all the COD orders will only be confirmed after OTP Verification.</p>
                    <input type="text" name="pincode"id="otpcheck" class="codpay123" placeholder="Please Enter OTP" maxlength="6" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" style="padding: 10px;
                        width: 155px;
                        border-radius: 5px;
                        border: 1px solid #ddd;">
                    <br>
                    <span style="color: rgb(0, 153, 51); display: none;" class="showres" > </span> <br>
                    <span class="otperrormatch" style="color:#F00;"></span>
                    <input type="hidden" name="randomotp" class="randomotp" value="" />
                </span>  
            </div> 
            <br>
            <br>
              
                <div class="col-xs-12">
                    <div class="row">
                        <button  onclick="checkForm();" class="btn btn-primary pull-right submit2 mobile-mb-20 " type="submit" style="width:100%"><span><span>Place Order</span></span> </button>
                    </div> 
                </div> 
            </form> 
            </div> 
              
        </div>
         
        <div class="col-md-6 text-center col-sm-6 col-xs-12" > 
            <div class="cart_detail_info pd-20-10" style="border:0">
                <?php	
                $sqlcd=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'");
                 
                $subtotal = '';
                $submrp = '';
                while($rowcs=mysqli_fetch_array($sqlcd))
                { 
                    $subtotal = $subtotal + floor($rowcs['subtotal']*$_SESSION['conratio']); 
                    $submrp = $submrp + floor($rowcs['submrp']*$_SESSION['conratio']);  
                ?>
                    <div class="product" >
                    <div class="product-image col-sm-2 col-xs-3">
                    <img src="<?php echo $cdnurl;?>/uploads/productimage/thumb/<?php echo $rowcs['productimage']; ?>" style=" width: 50px;  border-radius: 7px;"> </div>
                    <div class="product-details col-sm-7 text-left col-xs-6">
                    
                    <p class="product-description"><a href="<?php echo URL;?>/<?php echo $rowcs['slug']; ?>"><?php echo $rowcs['productname']; ?></a></p>
                    <small>Size : <?php echo $rowcs['size']; ?> </small><br>
                    <small>Quantity : <?php echo $rowcs['quantity']; ?> </small>
                    </div>
                    <div class="product-price col-sm-3 text-right col-xs-3">
                        <?php if($rowcs['submrp'] > $rowcs['subtotal']){ ?><span style="font-size: 11px;"><del><?php echo Currency; ?> <?php echo round($rowcs['submrp']*$_SESSION['conratio']); ?></del>&nbsp;</span><?php } ?>
                        <?php echo Currency; ?> <?php echo round($rowcs['subtotal']*$_SESSION['conratio']); ?>
                    </div>
                    </div> <hr>
                <?php } $totalsaving = $submrp - $subtotal; ?>
                <div class="clearfix" ></div> 
           </div>  
            
            <?php if($totalsaving > 0){ ?>
            <div class="cart_price_detail" style="margin-bottom:0" >
                <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                    <p>Total Saving</p> 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6" >
                    <p><?php echo Currency.$totalsaving; ?></p> 
                </div> 
                </div>
            <?php } ?>

           <div class="cart_price_detail" style="margin-bottom:0" >
                <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                    <H5>Order Subtotal:</H5> 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6">
                    <H5> <p> <?php echo Currency; ?> <?php echo $subtotal; ?></p></H5> 
                </div>
            </div>
            <?php if(($coupandiscount!='0') ||($_SESSION['couponcartvalue']!="")) { ?>
                <div class="cart_price_detail" style="margin-bottom:0" >
                    <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                        <H5>Coupon Discount:</H5> 
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6">
                    <H5> <p> <?php  echo Currency; ?> <?php echo round(($coupandiscount+$_SESSION['couponcartvalue'])*$_SESSION['conratio']);?>&nbsp; 
                    <?php if($coupon_code!="") { ?>( <?php echo $coupon_code; ?>) <?php } ?></p></H5> 
                    </div>
                </div>
            <?php } ?> 
            <div class="cart_price_detail" style="margin-bottom:0" >
                <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                    <H5>Shipping Charges:</H5> 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6">
                    <H5> <p> <?php echo Currency; ?><span id="shippingcharge" > <?php echo round($_SESSION['shipprice']); ?></span></p></H5> 
                </div>
            </div>  
             
             
            <?php if($_SESSION['user_wallet_amount'] > 0) { ?>
          <div class="cart_price_detail" style="margin-bottom:0" >
                <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                    <H5> Wallet:</H5> 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6" >
                    <H5> <p><?php echo Currency; ?> <?php echo $_SESSION['walletamounttobeuse'];?></p></H5> 
                </div>
            </div>
            <?php } ?> 
            
            
            <div class="clearfix"></div> 
            <div class="cart_price_detail" style="passing-top:10px;margin-bottom:0">
                <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                    <H5>Estimated Order Total:</H5> 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6">
                <H5> <p><b>   <?php echo Currency; ?> <span id="newestimatetotal"><?php echo $_SESSION['totalpaybleamount']; ?></span></b></p></H5> 
                </div>
            </div> 
            <?php
            $sql_user=mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$_SESSION['emailid']."'");  
			$rows2=mysqli_fetch_assoc($sql_user);
            ?>
            <input id="estimatetotal" type="hidden" value="<?php echo $_SESSION['totalpaybleamount']; ?>" />  
            <input id="mobileforotp" type="hidden" value="<?php echo $rows2['billing_mobile']; ?>" /> 
            <input id="emailforotp" type="hidden" value="<?php echo $rows2['emailid']; ?>" /> 
        </div> 
    </div>

<?php   
            $_SESSION['price']=$_SESSION['totalpaybleamount'];    
            $_SESSION['coupon_discount'] = $coupandiscount;
            $_SESSION['pwieght'] = $pwieght;
            $_SESSION['pwieght'] = $pwieght;
             ?>  
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
<br>
<br>
<br>