<?php
date_default_timezone_set('Asia/Calcutta');
include("../configuration.php");
include("../mailfunction.php");  
 
$CompanyEmail=CompanyEmail; 
$CompanyName=CompanyName; 
$URL=URL;
 
?>
<td width="748" valign="top">
<?php  //mysqli_query($conn,"update ".$sufix."order set `paymentflag`='1', `approve_status`='Processing' where oid ='".$_SESSION['oid']."' and emailid='".$_SESSION['emailid']."'"); 

	$sql=mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$_SESSION['emailid']."' and displayflag='1' and approveflag='1'") ;
	$rowuser=mysqli_fetch_assoc($sql);
	
	
	$sql2=mysqli_query($conn,"select * from ".$sufix."order where oid ='".$_SESSION['oid']."' and emailid='".$_SESSION['emailid']."'") ;
	$roworder=mysqli_fetch_assoc($sql2);  //  

//
?>
    
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
                <div class="col-md-12 col-sm-2 pd-70 " style="border-right: 1px solid #DDD; ">
    			    <?php echo session_msg(); ?>
                    <h5>Payment Failed/Rejected </h5>
                    <div class="loginbox">
                        Something went wrong and the order couldn’t process, please contact our customer care at care@https://localhost/project/shopurneeds for assistance.
                    </div>
    			    <div class="clearfix"></div>
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
        
    <?php
  	unset($_SESSION['shopid']);	
	unset($_SESSION['shipping']);
	unset($_SESSION['productcost']);
	unset($_SESSION['totalcost']);
	unset($_SESSION['weight']);	
	unset($_SESSION['selected_address']);
	unset($_SESSION['couponcartvalue']);
	unset($_SESSION['couponcartdiscode']);
  ?>