<?php 
if($_SESSION['emailid']!='') { ?>
    <script>window.location.href='<?php echo URL;?>/basket/cart';</script>
<?php } ?>  
<script>
    $(document).ready(function(){
        $(".forget_password").click(function(){
        $(".forgot_password_div").toggleClass("main");
    });
    });
</script>
<main class="container">
    <div class="row">
        <div class="col-lg-12 grid-center ot_20 clearfix">
        <div class="row">
            <div class="col-sm-12 shoping-gridLine">
                <div class="step2 shopping_step_col active"> <span class="step_num">1</span><span>Sign In / Sign Up</span> </div>
                <div class="step1 shopping_step_col hidden-xs"> <span class="step_num">2</span><span>Shopping Summary</span> </div>
                <div class="step3 shopping_step_col hidden-xs"> <span class="step_num">3</span><span>Shipping</span> </div>
                <div class="step4 shopping_step_col hidden-xs"> <span class="step_num">4</span><span>Payment</span> </div>
                <div class="step5 shopping_step_col hidden-xs"> <span class="step_num">5</span><span>Reciept</span> </div>
            </div>
            <div class=" card-wrap littleTagLogin_toRegisterPage">
                <div class="col-md-6 col-sm-6 pd-40 " > 
                     <h3 class="register_btn" >Login</h4>
                     <form  style="margin-top:30px; " name="frmlogin" id="frmlogin" action="<?php echo URL; ?>/process/loginprocessbasket2.php?type=signin" method="post" autocomplete="off">
                         
                        <div class="loginbox"> 
                        
                            <div class="radio">
                                <label class="show_password" style="width:100%;display:inline-block;padding:0">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div  class="form-group uplabel member_login" > 
                                            <input name="emailid_login" id="emailid_login" class="form-control emailid_login" maxlength="50" type="text"   placeholder="EMAIL ID" autocomplete="off" required> 
                                            <div id="Login_divErrorMsg3" class="text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div  class="form-group uplabel member_login" > 
                                        <input name="password"   placeholder="Password" class="form-control password123" maxlength="20" type="password" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <?php echo $_SESSION['sessionMsg']; unset($_SESSION['sessionMsg']); ?>
                                <input type="submit" value="Continue" class="btn btn-primary pull-left" style=" width: 100%; ">
                               <div class="clearfix"></div>
                                <a class="forget_password" href="javascript:void(0);" style="margin-left:10px; border:none;padding: 10px 0px 0 !important;float: left;">Forgotten Password - <b>Reset It</b> </a> 
                          <a class="Registr_pg" href="<?php echo URL;?>/basket/checkout_reg" style=" width: 100%; display: inline-block;  margin-left: 10px; margin-bottom:10px">Don't have an account? <b>Sign up</b></a>
                            </div> 
                        </div>
                    </form>
			        <div class="clearfix"></div>
                    <div style="display:none;" class="forgot_password_div">
                        <hr>
                        <h5>Forgot Password</h5>
                        <form style="margin-top:5px;" method="post" action="<?php echo URL;?>/process/forget_process2.php" id="frmlogin" name="frmlogin" class="row">
                        <div class="control-group col-sm-8">
                          <div class="controls ">
                            <input type="email" required="true" id="emailid11" class="form-control" placeholder="E-Mail :" name="emailid">
                          </div>
                        </div>
                                            
                          <input type="submit" class="btn btn-primary pull-left col-sm-4" value="Reset Password">
                        </form> 
                    </div>  
                </div>
                <div class="col-md-6 text-center col-sm-6 " > 
                    <div class="cart_detail_info pd-20-10" >
                        <?php 
                        $subtotal = '';
                        $submrp = '';
                        $sqlcd=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."' order by id desc");
                        while($rowcs=mysqli_fetch_array($sqlcd))
                        { 
                            $totalamount = floor($rowcs['subtotal']*$_SESSION['conratio']);
                            $subtotal = $subtotal + $totalamount; 
                            $submrp = $submrp + floor($rowcs['submrp']*$_SESSION['conratio']); 
                            
                        ?>    
                            <div class="product" >
                            <div class="product-image col-sm-2 col-xs-3">
                            <img src="<?php echo $cdnurl;?>/uploads/productimage/thumb/<?php echo $rowcs['productimage']; ?>" style=" width: 50px;  border-radius: 7px;"> </div>
                            <div class="product-details col-sm-7 text-left col-xs-6">
                            
                            <p class="product-description"><a href="<?php echo URL;?>/<?php echo $rowcs['slug']; ?>"><?php echo $rowcs['productname']; ?></a></p>
                            <small>Size : <?php echo $rowcs['size']; ?> </small>
                            <small>Quantity : <?php echo $rowcs['quantity']; ?> </small>
                            </div>
                            <div class="product-price col-sm-3 text-right col-xs-3">
                                <?php if($rowcs['submrp'] > $rowcs['subtotal']){ ?><span style="font-size: 11px;"><del><?php echo Currency; ?> <?php echo round($rowcs['submrp']*$_SESSION['conratio']); ?></del>&nbsp;</span><?php } ?>
                                <?php echo Currency; ?> <?php echo round($rowcs['subtotal']*$_SESSION['conratio']); ?></div>
                            </div> 
                            <hr>
                        <?php }   
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
                        
                        $grandtotal = $subtotal + $shippingcharge;
                        
                        $_SESSION['shipprice']=$shippingcharge; 
                        
                        ?>
                        <?php if($totalsaving > 0){ ?>
                        <div class="clearfix" ></div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                            <p><b>Total Saving</b></p> 
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6" style="padding-right:0px;">
                            <p><b> <?php echo Currency.$totalsaving; ?></b></p> 
                        </div> 
                        <?php } ?>
                        <div class="clearfix" ></div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                            <p><b>Subtotal</b></p> 
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6" style="padding-right:0px;">
                            <p><b> <?php echo Currency.$subtotal; ?></b></p> 
                        </div> 
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                            <p><b>Shipping Charges</b></p> 
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6" style="padding-right:0px;">
                            <p><b> <?php echo Currency.$shippingcharge; ?></b></p> 
                        </div> 
                    </div> 
                    <div class="cart_price_detail" >
                        <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                            <H4>Total</H4> 
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6">
                            <H4> <p><b> <?php echo Currency.$grandtotal; ?></b></p></H4> 
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        </div>
    </div>
    <script>
    $('.optradio').change(function () 
    { 
        var getValue = $(this).val();
        if(getValue==1) 
        { 
            if($(this).is(':checked')) 
            {
                $('.emailid_login').prop('required', true);
                $('.password123').prop('required', true);
                $('#emailid').prop('required', false);
            } 
            else 
            {
                
                $('.emailid_login').prop('required', false);
                $('.password123').prop('required', false);
                $('#emailid').prop('required', true);
            }
        }
        else
        {
            $('.emailid_login').prop('required', false);
            $('.password123').prop('required', false);
            $('#emailid').prop('required', true);
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
        </body></html>