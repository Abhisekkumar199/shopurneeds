<style>
    .card-shop p{
        font-size: 14px;
    color: #000;
    line-height: 0.6;
}
     @media (max-width: 767px) {
    .card-shop h3 {
    margin: 0;
    font-size: 18px;
}

.card-shop {
    border: 1px solid #eee;
    padding: 10px;
    display: inline-block;
    width: 100%;
    margin-bottom: 10px;
}}
</style>
<div id="content"> 
    <div class="container"> 
        
        <div class="col-lg-12 grid-center ot_20 clearfix">
        <div class="row">
            <div class="col-sm-12 shoping-gridLine">
                <div class="step2 shopping_step_col hidden-xs"> <span class="step_num">1</span><span><?php if($_SESSION['current_language'] == 'AR') { echo "تسجيل الدخول / الاشتراك"; }  else { echo "Sign In / Sign Up"; } ?></span> </div>
                <div class="step1 shopping_step_col hidden-xs"> <span class="step_num">2</span><span><?php if($_SESSION['current_language'] == 'AR') { echo "ملخص التسوق"; }  else { echo "Shopping Summary"; } ?></span> </div>
                <div class="step3 shopping_step_col active"> <span class="step_num">3</span><span><?php if($_SESSION['current_language'] == 'AR') { echo "الشحن"; }  else { echo "Shipping"; } ?></span> </div>
                <div class="step4 shopping_step_col hidden-xs"> <span class="step_num">4</span><span><?php if($_SESSION['current_language'] == 'AR') { echo "دفع"; }  else { echo "Payment"; } ?></span> </div>
                <div class="step5 shopping_step_col hidden-xs"> <span class="step_num">5</span><span><?php if($_SESSION['current_language'] == 'AR') { echo "استلم"; }  else { echo "Reciept"; } ?></span> </div>
            </div>
            <div class="clearfix">
                <?php 
                $sql=mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$_SESSION['emailid']."'");
                $num=$basket->num($sql);	
                if($num<=0)
                {
                    $_SESSION['sessionMsg']="Either Session has been expired or you are not valid user! ";
                    header("location:".$URL."/basket/checkout_one");
                }
                	 
                    $rows=mysqli_fetch_assoc($sql);
                    
                    $billing_city = mysqli_fetch_assoc(mysqli_query($conn,"select cityname,cityname_in_arabic from ".$sufix."city where cityid='".$rows['billing_city']."'"));
                    $deliver_city = mysqli_fetch_assoc(mysqli_query($conn,"select cityname,cityname_in_arabic from ".$sufix."city where cityid='".$rows['deliver_city']."'"));
                ?>
                <div class="card-wrap"> 
                        
                        <br>
                    <div class="card-wrap">
                                  
                         <div class="col-sm-6 littletags-shippingLeft pd-40"> 
                            <?php 
                                $sql_user_address=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."customer_address where user_id='".$_SESSION['useridse']."' and id='".$_REQUEST['id']."'"));
                            ?>
                                 
                                
                                <div class="row addressshow" style="  margin:10px; ">
                                    <form name="frmshipping" id="frmshipping" action="<?php echo URL; ?>/process/edit-address-process.php" method="post" novalidate="novalidate"> 
                                        <input type="hidden" name="address_id" value="<?php echo $sql_user_address['id'];  ?>" />
                                        <div class="col-sm-12">
                                            <label>Address Type</label>
                                            <div id="Shipping_divEmail" class="form-group uplabel">
                                                <input name="addredd_type" type="radio" value="Home"   <?php   if($sql_user_address['addresstype'] == 'Home') { echo "checked"; } ?>  />
                                                <span class="checkmark"></span>
                                                <span style="padding-left:7%">Home</span>
                                                
                                                <input name="addredd_type" type="radio" value="Office" <?php   if($sql_user_address['addresstype'] == 'Office') { echo "checked"; } ?>  />
                                                <span class="checkmark"></span>
                                                <span style="padding-left:7%">Office</span>
                                                
                                                <input name="addredd_type" type="radio" value="Other"   <?php   if($sql_user_address['addresstype'] == 'Other') { echo "checked"; } ?>  />
                                                <span class="checkmark"></span>
                                                <span style="padding-left:7%">Other</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div id="Shipping_divFirstName" class="form-group uplabel">
                                                <input name="fname" id="fname" class="form-control" value="<?php echo $sql_user_address['fname']; ?>"   type="text" placeholder="FIRST NAME">
                                                <div id="Register_divErrorMsg1" class="text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div id="Shipping_divLastName" class="form-group uplabel">
                                                <input name="lname" id="lname" class="form-control" value="<?php echo $sql_user_address['lname']; ?>"    type="text" placeholder="LAST NAME">				  
                                            </div>
                                        </div>
                                        <div class="col-sm-12"> 
                                            <div id="Shipping_divMobile" class="form-group uplabel">
                                                <input name="mobile" id="mobile" class="form-control" maxlength="10" type="text" value="<?php echo $sql_user_address['mobileno']; ?>"    placeholder="MOBILE NUMBER">
                                            </div> 
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div id="Shipping_divAddress" class="form-group uplabel">
                                                <input type="text" name="address" id="address" class="form-control"   type="text" rows="4" value="<?php echo $sql_user_address['address']; ?>"  placeholder="Shipping Address">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div id="Shipping_divLastName" class="form-group uplabel">
                                                <input name="city" id="city" class="form-control"  type="text" placeholder="City" value="<?php echo $sql_user_address['city']; ?>">				  
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div id="Shipping_divMobile" class="form-group uplabel">
                                                
                                                
                                                <select name="pincode" id="pincode" class="form-control" maxlength="6" required>
                                                    
                                                    <option>Pincode</option>
                                               
                                                    <option vlaue="110045"<?php  if($sql_user_address['zipcode']=="110045") { ?> selected="selected" <?php } ?>>110045</option>
                                                    <option vlaue="110058"<?php  if($sql_user_address['zipcode']=="110058") {?> selected="selected" <?php } ?>>110058</option>
                                                    <option vlaue="110075" <?php  if($sql_user_address['zipcode']=="110075"){ ?> selected="selected" <?php } ?>>110075</option>
                                                    <option vlaue="110077"<?php  if($sql_user_address['zipcode']=="110077") { ?> selected="selected" <?php } ?>>110077</option>
                                                    <option vlaue="110078"<?php  if($sql_user_address['zipcode']=="110078") {?> selected="selected" <?php } ?>>110078</option>

                                                </select>

                                            </div> 
                                        </div>  
                                        <div class="col-sm-12"> 
                                            <div id="Shipping_divMobile" class="form-group uplabel">
                                                <button onClick="return addaddress();" class="btn btn-primary pull-right mobile-mb-20" type="submit" style="width:30%"><span><span>Update</span></span> </button> 
                                            </div> 
                                        </div> 
                                    </form>
                                </div>
                                 
                                <div class="clearfix"></div> 
                        </div>        
                        </form>
                        
                        <div class="col-md-6 text-center col-sm-5 " style="border-left: 1px solid #DDD; "> 
                            <div class="cart_detail_info pd-20-10" >
                            <?php 
                            $grandtotal = '';
                            $sqlcd=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'");
                            while($rowcs=mysqli_fetch_array($sqlcd))
                            { 
                                $totalamount = floor($rowcs['sellingprice']*$_SESSION['conratio']) * $rowcs['quantity'];
                                $grandtotal = $grandtotal + $totalamount; 
                                
                            ?>    
                            <div class="product" >
                                <div class="product-image col-sm-2 col-xs-3">
                                <img src="<?php echo $cdnurl;?>/uploads/productimage/thumb/<?php echo $rowcs['productimage']; ?>" style=" width: 50px;  border-radius: 7px;"> </div>
                                <div class="product-details col-sm-7 text-left col-xs-6">
                                
                                <p class="product-description"><a href="<?php echo URL;?>/<?php echo $rowcs['slug']; ?>">
                                    <?php if($_SESSION['current_language'] == 'AR') { echo $rowcs['productname_in_arabic']; }  else { echo $rowcs['productname']; } ?>
                                    </a></p>
                                    <small><?php if($_SESSION['current_language'] == 'AR') { echo "بحجم:"; }  else { echo "Size:"; } ?> <?php echo $rowcs['size']; ?> </small>
                                </div>
                                <div class="product-price col-sm-3 text-right col-xs-3"><?php echo Currency; ?>&nbsp;<?php echo round($rowcs['sellprice1']*$_SESSION['conratio']); ?></div>
                            </div> 
                            <hr> 
                        <?php  }?>
                         <?php 
                         $user_city = $rows['deliver_city']; 
                        $sql_shipping=mysqli_fetch_assoc(mysqli_query($conn,"select charge from ".$sufix."city_shipping_charges where city='".$user_city."' and amount_from <= '".$grandtotal."' and amount_upto >= '".$grandtotal."'"));
                        
                        $charge = $sql_shipping['charge'];
                        
                        $sqlpcheck=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."' and promotionId = 0");
                        $numpcheck=mysqli_num_rows($sqlpcheck);
                        if($numpcheck > 0)
                        {
                            if($subtotal2 < 500) { $total_shipping_price = $charge;} else { $total_shipping_price = $charge;}
                        
                        }
                        else
                        {
                            $sqlpcheckrr=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."' order by id asc limit 1"));
                            $sqlpromotion=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."promotion where  id ='".$sqlpcheckrr['promotionId']."'"));
                            $totalcodchargecheck = $sqlpromotion['codCharge'];
                            $total_shipping_price= $sqlpromotion['shippingCharge'];
                            $_SESSION['totalcodchargecheck']=$totalcodchargecheck;
                        
                        }    
                        ?>
                        <div class="clearfix" ></div> 
                        <div class="cart_price_detail" >
                            <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                                <H5><?php if($_SESSION['current_language'] == 'AR') { echo "المجموع الفرعي"; }  else { echo "Subtotal"; } ?></H5> 
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6">
                                <H5> <p><b> <?php echo $grandtotal;?></b></p></H5> 
                            </div>
                            <div class="clearfix"></div>
                            <?php if($_SESSION['couponcartvalue'] > 0) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                                <H5><?php if($_SESSION['current_language'] == 'AR') { echo "خصم"; }  else { echo "Discount"; } ?></H5> 
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6">
                                <H5> <p><b> <?php echo $_SESSION['couponcartvalue']; ?></b></p></H5> 
                            </div> 
                            <div class="clearfix"></div>
                            <?php } ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                            <H5><?php if($_SESSION['current_language'] == 'AR') { echo "رسوم الشحن"; }  else { echo "Shipping Charge"; } ?></H5> 
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6">
                                <H5> <p><b> <?php echo $total_shipping_price; ?></b></p></H5> 
                            </div> 
                            <div class="clearfix"></div>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                            <H4><?php if($_SESSION['current_language'] == 'AR') { echo "مجموع"; }  else { echo "Total"; } ?></H4> 
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6">
                               
                                <H4> <p><b> <?php echo Currency." ".floor((($grandtotal + $total_shipping_price)-($_SESSION['couponcartvalue']))*$_SESSION['conratio']);?></b></p></H4> 
                            </div>
                        </div>
                        </div>
                        </div>
                    </div> 
            </div>
        </div> 
        </div>
    </div>
</div>
<br>
<br>
<script language="javascript"> 
    function selected_address(val1)
    {
        $("#selected_address").val(val1);
    }
    function showaddress()
    {
        $('.addressshow').show();
        $('#is_add_ddress').val(1);
        $('.checkoutbutton'). hide();
    }
     

	function allclick() 
	{ 
	    $(".label-txt").addClass("active"); 
	} 
	function addaddress()
	{
	    var fname = $('#fname').val();
	    if(fname == '')
	    {
	        alert('Please enter first name!');
	        return false;
	    }
	    
	    var lname = $('#lname').val();
	    if(lname == '')
	    {
	        alert('Please enter last name!');
	        return false;
	    }
	    
	    var mobile = $('#mobile').val();
	    if(mobile == '')
	    {
	        alert('Please enter mobile number!');
	        return false;
	    }
	    
	    var address = $('#address').val();
	    if(address == '')
	    {
	        alert('Please enter address!');
	        return false;
	    }
	    
	    var city = $('#city').val();
	    if(city == '')
	    {
	        alert('Please enter city!');
	        return false;
	    }
	    
	    var pincode = $('#pincode').val();
	    if(pincode == 'Pincode')
	    {
	        alert('Please enter pincode!');
	        return false;
	    }
	}
	function ValidateShipping()
	{
	    var addredd_id = parseInt($('input[name="addredd_id"]:checked').length); 
	    if(addredd_id == '')
	    {
	        alert('Please select address ');
	        return false;
	    } 
	}

</script>
 <script>
$(document).ready(function(){
    $(".check_billingAdd").click(function(){
        $(".billing_add").toggleClass("show");
    });
});
</script>
      <script>
$("#billingAdd").click(function () {
      
    $("#billing_add").css("display", "block");
    
   
});

</script>

</main>