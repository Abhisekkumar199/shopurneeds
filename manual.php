<?php  
session_start();
include("includes/configuration.php"); 
include("includes/currency_display.php"); 
include("includes/header-cart.php"); 
?>
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
<main class="container">
<div class="row"> 
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
            
            <h4 style="margin-bottom:30px">Payment</h4>  
              
                <div class="col-xs-12">
                    <div class="row">
                        <button id="rzp-button1" class="btn btn-primary submit2 mobile-mb-20 ">Pay with Razorpay</button> 
                    </div> 
                </div>  
            
            </div> 
              
        </div>
         
        <div class="col-md-6 text-center col-sm-6 col-xs-12" style="border-left: 1px solid #DDD; "> 
            <div class="cart_detail_info pd-20-10" >
                <?php	
                $sqlcd=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'");
                $subtotal2 = 0; 
                $subtotal = '';
                $submrp = '';
                while($rowcs=mysqli_fetch_array($sqlcd))
                { 
                    $subtotal = $subtotal + floor($rowcs['subtotal']*$_SESSION['conratio']); 
                    $submrp = $submrp + floor($rowcs['submrp']*$_SESSION['conratio']); 
                    $subtotal2 = $subtotal2+round(($rowcs['sellingprice']*$rowcs['quantity'])*$_SESSION['conratio']);
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
                        
                        <?php echo Currency; ?> <?php echo round($rowcs['sellingprice']*$_SESSION['conratio']); ?></div>
                    </div> <hr>
                <?php } $totalsaving = $submrp - $subtotal; ?>
                
                
                <div class="clearfix" ></div> 
            </div>  
            
            <?php if($totalsaving > 0){ ?>
            <div class="cart_price_detail" >
                <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                    <p>Total Saving</p> 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6" >
                    <p><?php echo Currency.$totalsaving; ?></p> 
                </div> 
                </div>
            <?php } ?>

            <div class="cart_price_detail" >
                <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                    <H5>Order Subtotal:</H5> 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6">
                    <H5> <p> <?php echo Currency; ?> <?php echo $subtotal; ?></p></H5> 
                </div>
            </div>
            <?php if(($coupandiscount!='0') ||($_SESSION['couponcartvalue']!="")) { ?>
                <div class="cart_price_detail" >
                    <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                        <H5>Coupon Discount:</H5> 
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6">
                    <H5> <p> <?php  echo Currency; ?> <?php echo round(($coupandiscount+$_SESSION['couponcartvalue'])*$_SESSION['conratio']);?>&nbsp; 
                    <?php if($coupon_code!="") { ?>( <?php echo $coupon_code; ?>) <?php } ?></p></H5> 
                    </div>
                </div>
            <?php } ?> 
            <div class="cart_price_detail" >
                <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                    <H5>Shipping Charges:</H5> 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6">
                    <H5> <p> <?php echo Currency; ?><span id="shippingcharge" > <?php echo round($_SESSION['shipprice']); ?></span></p></H5> 
                </div>
            </div>  
             
             
            <?php if($_SESSION['user_wallet_amount'] > 0) { ?>
            <div class="cart_price_detail" >
                <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                    <H5> Wallet:</H5> 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6" >
                    <H5> <p><?php echo Currency; ?> <?php echo $_SESSION['walletamounttobeuse'];?></p></H5> 
                </div>
            </div>
            <?php } ?> 
            
            
            <div class="clearfix"></div> 
            <div class="cart_price_detail" style="passing-top:10px;">
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
</div>
 






















<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form name='razorpayform' action="https://localhost/project/shopurneeds/verify.php" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
</form>
<script>
var options = <?php echo $json?>;
options.handler = function (response){
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.razorpayform.submit();
};
options.theme.image_padding = false;
options.modal = {
    ondismiss: function() {
        console.log("This code runs when the popup is closed");
    },
    escape: true,
    backdropclose: false
};
var rzp = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>