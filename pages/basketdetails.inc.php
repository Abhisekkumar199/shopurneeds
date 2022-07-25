<style>
@media (max-width:400px)
{
    .btn{ font-size:13px !important}
}
</style> 
<?php if($_SESSION['emailid']=='') { ?>
	<script>window.location.href='https://localhost/project/shopurneeds/basket/checkout_one';</script>
<?php } ?>
<script>
     $(document).ready(function(){
        $(".apply_wallet").click(function(){
            var is_checked = $('input[name="is_wallet_use"]:checked').val(); 
            if(is_checked == 1)
            {
                var is_apply_wallet = 1 ;
            }
            else
            {
                var is_apply_wallet = 0 ;
            } 
    	 	var total_order_amount = $("#total_order_amount").val();
            $(".ajax_loader1").css("display","block");
                $.ajax({
                    type: "POST",
                    data: "total_order_amount="+total_order_amount+"&is_apply_wallet="+is_apply_wallet,
                    url: "<?php echo URL;?>/ajax/ajax_apply_wallet.php",
                    success: function(data){  
                        location.reload(); 
                    } 
                });
        });
            
        $(".apply_coupan").click(function(){
    	 	var coupan_code = $("#coupan_code").val();
    		var shipping_charge = $("#shipping_charge").val();
    		var total_value_pro = $("#total_value_pro").val();
    		var productidd = $("#productidd").val();
    		if(coupan_code=='')
    		{ 
    			$(".coupan_errore").css("display","block");
    			$(".coupan_errore").html("Please Enter coupon Code");
    			$(".coupan_error").hide();
    		    $("#coupan_code").focus();
    		} 
    		else 
    		{ 
                $(".ajax_loader").css("display","block");
                $.ajax({
                    type: "POST",
                    data: "promocode="+coupan_code+"&shipping_charge="+shipping_charge+"&total_value_pro="+total_value_pro+"&productidd="+productidd,
                    url: "<?php echo URL;?>/ajax/ajax_inc_coupancode.php",
                    success: function(data){ 
                        if(data=='Coupon invalid' || data=='Coupon already used' || data=='Coupon not applicable on this product' || data=='Please add more product to use this coupon')
                        {
                            $(".coupan_error").css("display","block");
                            $(".coupan_errore").css("display","none");
                            $(".coupan_error").html(data);
                            $(".ajax_loader").css("display","none");
                        } 
                        else
                        { 
                            $(".coupan_error").css("display","none");
                            $(".show_copuan").html(data);
                            $(".ajax_loader").css("display","none");
                            location.reload(); 
                        }
                    },
                    error: function(request,status,errorThrown) {
                        alert("Error");
                    }
                });
    		}
    	 });
     });
</script>  
            
<div id="content"> 
    <div class="container">  
        <div class="col-lg-12 grid-center ot_20 clearfix">
            <div class="row">
                <div class="col-sm-12 shoping-gridLine">
                    <div class="step2 shopping_step_col hidden-xs"> <span class="step_num">1</span><span>Sign In / Sign Up</span> </div>
                    <div class="step1 shopping_step_col active"> <span class="step_num">2</span><span>Shopping Summary</span> </div>
                    <div class="step3 shopping_step_col hidden-xs"> <span class="step_num">3</span><span>Shipping</span> </div>
                    <div class="step4 shopping_step_col hidden-xs"> <span class="step_num">4</span><span>Payment</span> </div>
                    <div class="step5 shopping_step_col hidden-xs"> <span class="step_num">5</span><span>Reciept</span> </div>
                </div>
                <div class="clearfix"></div>
                <div class="threadSutraBasketPage col-sm-12 mt20" style=" padding:0;">
                    <div class="table-responsive">
                        <div class="clearfix"></div>
                        <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border:1px solid #ddd !important; margin-top:5px; margin-bottom:0;    font-size: 14px;" class="table">
                            <tbody> 
                                <?php 
                                
    	                        $sql_user=mysqli_fetch_assoc(mysqli_query($conn,"select wallet from `".$sufix."user_registration` where id='".$_SESSION['useridse']."'"));
    	                        $_SESSION['user_wallet_amount'] = $sql_user['wallet'];
    	                        
                                $i=1; 
                                $submrp = '';
                                $subtotal = 0;
                                $sql = mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."' order by id desc");  
                                $num=mysqli_num_rows($sql);  
                                $totalweight=0;
                                if($num > 0)
                                {
                                    $totalcost=0;
                                    $count2=1;
                                    while($rows = mysqli_fetch_assoc($sql))
                                    {	 
                                        $subtotal = $subtotal + floor($rows['subtotal']*$_SESSION['conratio']);
                                        $submrp = $submrp + floor($rows['submrp']*$_SESSION['conratio']); 
                                        $coupandiscount = $coupandiscount+($rows['coupan_discount']*$rows['quantity']); 
                                        if($rows['coupon_code']!='') 
                                        { 
                                            $coupon_code = $rows['coupon_code'];
                                        } 
                                        $totalweight=$totalweight + $rows['totalweight'];   
                                ?> 
                                    <tr>
                                        <th width="20%" style="text-align:center"><?php if($count2==1) { ?>
                                        <div class="detail-head_col" >Product</div>
                                        <?php } ?></th>
                                        <th width="30%" style="text-align:center"><?php if($count2==1) { ?>
                                        <div class="detail-head_col">Product Description</div>
                                        <?php } ?></th>
                                        <th width="17%" style="text-align:center"><?php if($count2==1) { ?>
                                        <div class="detail-head_col">Unit Price</div>
                                        <?php } ?></th>
                                        <th width="16.4%" style="text-align:center"><?php if($count2==1) { ?>
                                        <div class="detail-head_col">Qty</div>
                                        <?php } ?></th>
                                        <th width="16.6%" style="text-align:center"><?php if($count2==1) { ?>
                                        <div class="detail-head_col">Total</div>
                                        <?php } ?></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="detail-info_col text-center" >
                                            <?php if($rows['productimage']) { ?>
                                                <img src="<?php echo $cdnurl;?>/uploads/productimage/thumb/<?php echo $rows['productimage']; ?>" width="55" border="0" />
                                            <?php } else { ?>
                                                <img src="<?php echo $cdnurl;?>/uploads/productimage/default.jpg" width="55" height="55" />
                                            <?php } ?> 
                                            </div>
                                        </td>
                                        <td>
                                            <div class="detail-info_col" >
                                                <p class="da_product-name"><a href="<?php echo URL;?>/<?php echo $rows['slug']; ?>"><?php echo $rows['productname']; ?></a></p> 
                                                
                                                <small>Size : <?php echo $rows['size']; ?> </small>
                                                <br> 
                                                
                                                <small class="da_cart_ref"> 
                                                <a href="<?php echo URL; ?>/process/delete_basket.php?id=<?php echo $rows['id']; ?>&pid=<?php echo $rows['productid']; ?>" onclick="return confirm('Are you sure delete product?')" class="shopropayRemoveBtn">Remove</a> 
                                                <!--a href="<?php echo URL; ?>/process/move_wishlist.php?id=<?php echo $rows['id']; ?>&pid=<?php echo $rows['productid']; ?>" onclick="return confirm('Are you sure move to wishlist?')" class="shopropayWishBtn">Move to Wishlist</a-->
                                                </small>       
                                                <br><br><?php if($rows['cashback_price']!='0') { ?><p style="color:#002b4f; font-weight:bold;">(<?php echo Currency; ?>&nbsp;<?php echo floor($rows['cashback_price']*$_SESSION['conratio']); ?> instant Cash Back will be credited to your shopropay account.)</p><?php } ?>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="detail-info_col text-center shopropayrow-middle">
                                                <p> <?php echo Currency; ?> <?php echo floor($rows['sellingprice']*$_SESSION['conratio']); ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="detail-info_col text-center da_qty shopropayrow-middle">
                                            <div class="center">
                                            <input type="text" size="1" value="<?php echo $rows['quantity']; ?>" name="quantity[40]" class="shopropay-qty-input" style="text-align:center">
                                            <div class="clearfix shopropayInput_clearfix" style="display:none;"></div>
                                            <a href="<?php echo URL; ?>/process/update_basket.php?id=<?php echo $rows['id']; ?>&pid=<?php echo $rows['productid']; ?>&option=minus"> -</a> 
                                            <a href="<?php echo URL; ?>/process/update_basket.php?id=<?php echo $rows['id']; ?>&pid=<?php echo $rows['productid']; ?>&option=add"> + </a> 
                                            </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="detail-info_col  text-center shopropayrow-middle">
                                                <?php if($rows['submrp'] > $rows['subtotal']){ ?><span style="font-size: 11px;"><del><?php echo Currency; ?> <?php echo round($rows['submrp']*$_SESSION['conratio']); ?></del>&nbsp;</span><?php } ?>
                                                
                                            <p><?php echo Currency; ?>&nbsp;<?php echo floor($rows['subtotal']*$_SESSION['conratio']);   ?></p>
                                            </div>
                                        </td>
                                    </tr> 
                                    <div class="clearfix"></div>
                                <?php $count2++;  }  } else {?><script>window.location.href='<?php echo URL;?>';</script><?php }  ?> 
                    
                            </tbody>
                        </table>
                        <?php  
                        $totalsaving = $submrp - $subtotal;
                        if($subtotal < 600)
                        {
                            $shippingcharge = 49;
                        }
                        else if($subtotal >= 600 and $subtotal < 1100)
                        {
                            $shippingcharge = 40;
                        }
                        else
                        {
                            $shippingcharge = 0 ;
                        } 
                        
                        $_SESSION['shipprice']=$shippingcharge;  
                        
                        
                        $totalamt = floor((($subtotal + $_SESSION['shipprice'])-($_SESSION['couponcartvalue']))*$_SESSION['conratio']);
                        
                        if($_SESSION['is_wallet_applied'] == 1)
                        {
                            $_SESSION['totalpaybleamount'] = $_SESSION['totalpaybleamount'];
                            $_SESSION['remainingwalletamount'] =  $_SESSION['remainingwalletamount'];
                            $_SESSION['walletamounttobeuse'] = $_SESSION['walletamounttobeuse'];
                        }
                        else
                        {
                            $_SESSION['totalpaybleamount'] = $totalamt;
                            $_SESSION['remainingwalletamount'] =  $_SESSION['user_wallet_amount'];
                            $_SESSION['walletamounttobeuse'] = 0;
                        }
                        
                         
                        $_SESSION['productcost']=$subtotal; 
                        $_SESSION['ordervalue']=$totalamt; 
                        $_SESSION['totalcost']=floor(($subtotal-$_SESSION['couponcartvalue'])*$_SESSION['conratio']);  		
                        $_SESSION['totalcartvalue']=($subtotal + $_SESSION['shipprice']); 
                        $_SESSION['weight']=$totalweight; 
                        $needamount = 250 - $subtotal;
                        ?>
                    </div> 
                    
                    <div class="clearfix"></div> 
                    <div class="col-sm-12 basketdeatil-total_col">
                        <div class="col-sm-6" style="padding:0"></div>
                        <div class="col-sm-4 col-xs-8" style="padding:0">
                            <div class="detail-total_col"><strong>Sub Total :</strong></div>
                        </div>
                        <div class="col-sm-2 col-xs-4" style="padding:0">
                            <div class="detail-total_col text-center"><?php echo Currency; ?> <?php echo $subtotal; $_SESSION['cartvalues']= $subtotal; ?></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xs-12 pull-right basketdeatil-subtotal_col">
                        <?php if($totalsaving > 0){ ?> 
                        <div class="col-sm-8 col-xs-8" style="padding:0">
                            <div class="detail-total_col" style="border: none;"><b>Total Saving :</b></div>
                        </div>
                        <div class="col-sm-4 col-xs-4" style="padding:0">
                            <div class="detail-total_col  text-center" style="font-size: 18px;font-weight: 900;border: none;"> 
                            <?php  echo Currency." ".$totalsaving; ?></div> 
                        </div>
                        <?php } ?>
                        
                        
                        <div class="col-sm-3 col-xs-12" style="padding:0">
                            <div class="detail-total_col">Coupon Code <a href="javascript:void(0);" data-toggle="tooltip" title="" style=" border: 1px solid #DDDDDD; padding: 0 3px;" data-original-title="You have other Coupon then apply!">?</a></div>
                        </div>
                        <div class="col-sm-5 col-xs-8" style="padding:0">
                            <div class="detail-total_col">
                    			<div class="row">
                                    <div class="col-sm-8 col-xs-6"> <span class="ajax_loader" style="display:none;"> <img src="<?php echo IMGURL;?>/loader.gif" style="width:10%;"/></span>
                                        <input type="text" class="form-control" id="coupan_code" style="margin-bottom:0px; background:#fff; width:100%;">
                                        <input type="hidden" name="shipping_charge" id="shipping_charge" value="<?php echo floor($total_shipping_price*$_SESSION['conratio']);?>">
                                        <input type="hidden" name="total_value_pro" id="total_value_pro" value="<?php echo $subtotal;?>">
                                        <input type="hidden" name="productidd" id="productidd" value="6">
                                        <input type="hidden" name="total_order_amount" id="total_order_amount" value="<?php echo $totalamt;?>">
                                    </div>
                                    <div class="col-sm-4 pull-left col-xs-4 apply_coupan" style=" padding: 0;float:left !important;"> <a href="javascript:void(0);" class="btn btn-primary " style=" padding: 8px 0; width:  auto; min-width: 80%;line-height:normal">Apply</a> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4  col-xs-4" style="padding:0">
                            <div class="detail-total_col show_copuan">
                                <span class="coupan_errore" style="color:#FF0000;"></span> <span class="coupan_error" style="color:#FF0000;"> </span>
                                <?php 
                                if(($coupandiscount!='0')||($_SESSION['couponcartvalue']!="")) 
                                { 
                                    echo Currency." ".floor(($coupandiscount+$_SESSION['couponcartvalue'])*$_SESSION['conratio']); 
                                    if( $coupon_code!='') 
                                    { ?>
                                    &nbsp;(<?php echo $coupon_code;?>)
                                    <?php } ?>
                                    <?php if( $_SESSION['couponcartdiscode']!='') { ?>&nbsp;(<?php echo $_SESSION['couponcartdiscode'];?>)<?php } ?>
                              <?php } ?> 
                            </div>
                        </div> 
                        <div class="clearfix"></div>
                        
                        <div class="col-sm-8 col-xs-8" style="padding:0">
                            <div class="detail-total_col" style="border: none;"><b>Shipping Charges :</b></div>
                        </div>
                        <div class="col-sm-4 col-xs-4" style="padding:0">
                            <div class="detail-total_col  text-center" style="font-size: 18px;font-weight: 900;border: none;"> 
                            <?php  echo Currency." ".$_SESSION['shipprice']; ?></div> 
                        </div>
                        <?php if($_SESSION['user_wallet_amount'] > 0) { ?>
                        <div class="col-sm-8 col-xs-8" style="padding:0">
                            <div class="detail-total_col" style="border: none;"><input type="checkbox" name="is_wallet_use" id="is_wallet_use" value="1" <?php if($_SESSION['is_wallet_applied'] == 1) { echo "checked"; } ?> class="apply_wallet" style="margin-top:9px;" />&nbsp;&nbsp;<b>Use Wallet Amount (Balance - <?php echo Currency." ".$_SESSION['user_wallet_amount']; ?>) :</b></div>
                        </div>
                        <div class="col-sm-4 col-xs-4" style="padding:0">
                            <span class="ajax_loader1" style="display:none;"> <img src="<?php echo IMGURL;?>/loader.gif" style="width:10%;"/></span>
                            <div class="detail-total_col  text-center" style="font-size: 18px;font-weight: 900;border: none;"> 
                            <?php  echo Currency." ".$_SESSION['walletamounttobeuse']; ?></div> 
                        </div>
                        <?php } ?> 
                        
                        <div class="col-sm-8 col-xs-8" style="padding:0">
                            <div class="detail-total_col" style="border: none;"><b>Total Payable Amount :</b></div>
                        </div>
                        <div class="col-sm-4 col-xs-4" style="padding:0">
                            <div class="detail-total_col  text-center" style="font-size: 18px;font-weight: 900;border: none;"> 
                            <?php echo Currency." ".($_SESSION['totalpaybleamount']);?></div>
                            
                        </div>
                    </div>
                </div>
                <input type="hidden" id="neededamount" value="<?php echo $needamount; ?>" />
            <div class="clearfix"></div>
            <div class="col-sm-4 col-md-6 col-xs-12 pull-right" style="padding:0; margin-top:10px;  margin-bottom:10px;">
            <form name="frmbasketpopup" id="frmbasketpopup" action="" method="post" style="text-align:left; background: margin:0; border:0;">
            <a class="default-btn pull-left btn btn-primary "   href="<?php echo URL; ?>" style="cursor:pointer;">Continue Shopping</a>
            <?php if($subtotal >= 250) { ?>
                <a class="default-btn pull-right btn btn-primary " href="<?php echo URL; ?>/basket/shipping" style="cursor:pointer;">Proceed to checkout</a>
            <?php } else { ?> 
                <a class="default-btn pull-right btn btn-primary " href="javascript:void(0);" onclick="amountcheck()" style="cursor:pointer;">Proceed to checkout</a>
            <?php } ?>
            </form>
            </div>
            <div class="clearfix"></div>
            </div>
            
            </div>
            </div>
            
            
            </div> 
           
            
            
            
 
<div class="clearfix"></div> 
<script>
    function amountcheck()
    {
      var val1 = $("#neededamount").val();
      alert("Add rs "+val1+" more to place an order");
    }

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
<style>.detail-head_col, .detail-info_col{ border:0 !important} table{ border-color:#ddd !important; margin-bottom:0 !important;} table th, .detail-info_col{ padding:0 !important}</style>
