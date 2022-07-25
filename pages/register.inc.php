<main class="container">
    <div class="row">
      <div class="col-lg-10 grid-center ot_20 clearfix">
        <div class="row">
          <div class="col-sm-12 shoping-gridLine">
            <div class="step2 shopping_step_col active"> <span class="step_num">1</span><span>Sign In / Sign Up</span> </div>
            <div class="step1 shopping_step_col"> <span class="step_num">2</span><span>Shopping Summary</span> </div>
            <div class="step3 shopping_step_col"> <span class="step_num">3</span><span>Shipping</span> </div>
            <div class="step4 shopping_step_col"> <span class="step_num">4</span><span>Payment</span> </div>
            <div class="step5 shopping_step_col"> <span class="step_num">5</span><span>Reciept</span> </div>
          </div>
          <div class=" card-wrap">
            
            <div class="col-md-6 col-sm-6 pd-70 " style="border-right: 1px solid #DDD; ">
              <h5>REGISTER </h5>
              <div class="loginbox">
                <form name="frmlogin" id="frmlogin" action="" method="post">              
                    <div id="Register_divEmail" class="form-group uplabel">
                <label class="label-txt" for="Register_txtEmail">EMAIL ID</label>
                <input name="Register_txtEmail" id="Register_txtEmail" class="form-control valid" maxlength="50" type="email">
              </div>
                    <div id="Register_divMobile" class="form-group uplabel">
                            <label class="label-txt" for="Register_txtMobile">MOBILE NUMBER</label>
                            <input name="Register_txtMobile" id="Register_txtMobile" class="form-control" maxlength="10" type="text">
                        </div>
                    <div id="Register_divTC" class="checkbox">
                            <input value="agreeconditions" id="agreeconditions" type="checkbox" class="ui-checkbox">
                            <label for="agreeconditions" class="active">
                                By registering your details you agree to our
                                <a onclick="return newWinPopup('policy.html#termsconditions')" href="policy.html#termsconditions">Terms and Conditions</a> and
                                <a onclick="return newWinPopup('policy.html#privacypolicy')" href="policy.html#privacypolicy">privacy and cookie policy</a>                                
                            </label>
                            
                        </div>                   
                    
                    <div class="control-group">
                     <button type="submit" id="Register_btnSubmit" class="btn btn-primary btn-block">REGISTER NOW</button>
                     </div>
                  
                </form>
              </div>
              
            </div>
            
            <div class="col-md-6 col-sm-6 pd-70" >
              <div class="reward_card text-center" style=" margin-bottom:20px;"> <img src="<?php echo URL; ?>/039_HOME PAGE-07_files/logo-00a19fb10a.png"> </div>
              <div class="reward_card_info ">
            <ul>
              <li>Receive Reward Points On each Purchase</li>
              <li>Buy Anything From earned Rewards Points</li>
              <li>Go For Cardless Shopping On shopurneeds
              </li>
              <li>Check Real Time Reward Point Status</li>
            </ul>
            <div class="controls">
              <p style="font-size: 13px;line-height: 23px; ">By Clicking Complete sign up you are agreeing to the following <br><a href="" style="color:#4C9ED9; text-decoration:underline">Term &amp; Conditions</a> </p>
              <div class="text-left "> <a href="login" class="btn btn-primary" style="cursor:pointer; margin-top:10px">Login</a> </div>
            </div>
          </div>
            </div>
            
          </div>
        </div>
        <!-- <h3 class="pagetitle"> Shopping Bag <span>0</span> <i> item </i> </h3>-->
        <!--<div class="addtocart row">
          <div class="col-sm-12 ">
            <h4 class="emptycart">Your Shopping Cart is Empty</h4>
          </div>
          <div class="text-center hidden-xs"> <a class="btn btn-primary" href="index.html" )'>SHOP MORE</a> </div>
        </div>-->
      </div>
    </div>
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