<style> 
    .card-shop p{
        font-size: 14px;
    color: #000;
    line-height: 0.6;
}
    }
</style>
<div id="content"> 
    <div class="container">  
    <div class="col-lg-12 grid-center ot_20 clearfix">
        <div class="row">
            <div class="col-sm-12 shoping-gridLine">
                <div class="step2 shopping_step_col hidden-xs"> <span class="step_num">1</span><span>Sign In / Sign Up</span> </div>
                <div class="step1 shopping_step_col hidden-xs"><a href="<?php $url;?>/basket/cart"><span class="step_num">2</span><span>Shopping Summary</span><a/></div>
                <div class="step3 shopping_step_col active"> <span class="step_num">3</span><span>Shipping</span> </div>
                <div class="step4 shopping_step_col hidden-xs"> <span class="step_num">4</span><span>Payment</span> </div>
                <div class="step5 shopping_step_col hidden-xs"> <span class="step_num">5</span><span>Reciept</span> </div>
   	`       </div>
            <div class="clearfix">
                <?php 
                $sql=mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$_SESSION['emailid']."'");
                $num=mysqli_num_rows($sql);	 
                $rows=mysqli_fetch_assoc($sql); 
                ?>  
                    <div class="card-wrap"> 
                        <div class="col-sm-6 littletags-shippingLeft pd-40"> 
                            <?php 
                            $sql_user_address=mysqli_query($conn,"select * from ".$sufix."customer_address where user_id='".$_SESSION['useridse']."'");
                            $totaladdress = mysqli_num_rows($sql_user_address);
                            while($row_address = mysqli_fetch_assoc($sql_user_address))
                            {
                                ?>
                                
                                <div class="row" style="border: 1px solid #232f3e; border-radius: 7px;margin:10px;">
                                    <div class="card-shop col-sm-8" > 
                                        <h3>Shipping Address :-</h3> 
                                        <h4><?php echo $row_address['fname']." ".$row_address['lname']; ?><br></h4>
                                        <p><?php echo $row_address['address']; ?></p>
                                        <p><?php echo  $row_address['city'].", ".$row_address['zipcode']." ".$row_address['country']; ?> </p>  
                                        <p>Mobile Number: <?php echo $row_address['mobileno']; ?></p>
                                    </div>
                                    
                                    <label class="col-sm-4 pull-right payment-icon1 container-radio col-xs-12" style="margin-top: 20px;" >
                                        <input name="addredd_id"  type="radio" value="<?php echo $row_address['id']; ?>" required="" onchange="selected_address(<?php echo $row_address['id']; ?>);"  />
                                        <span class="checkmark"></span>
                                        <span style="padding-left:7%">Select Address</span>
                                        <p style="margin-top:30px;" class="add_ctrl_btn">
                                            <a href="<?php echo URL; ?>/basket/editaddress&id=<?php echo $row_address['id']; ?>"> <i class="fa fa-edit" style="color:#232f3e;font-size:16px;"></i></a> &nbsp;&nbsp;
                                            
                                            <a href="<?php echo URL; ?>/process/deleteaddress.php?id=<?php echo $row_address['id']; ?>" onclick="return confirm('Are you sure to delete this?')" ><i class="fa fa-trash" style="color:#232f3e;font-size:16px;"></i></a>
                                        </p>
                                    </label> 
                                </div>
                                <div class="clearfix"></div>
                                
                            <?php } ?>
                            <div class="row" style=" border-radius: 7px;margin:10px;">
                                <button onClick="showaddress();" class="btn btn-primary pull-right mobile-mb-20" type="button" style="width:100%"><span><span>Add Shipping Address</span></span> </button>
                            </div> 
                                
                                <div class="row addressshow" style="  margin:10px;<?php if($totaladdress > 0) {  ?>display:none; <?php } ?>">
                                    <form name="frmshipping" id="frmshipping" action="<?php echo URL; ?>/process/add_address.php" method="post" novalidate="novalidate"> 
                                        <input type="hidden" id="is_add_ddress" value="<?php if($totaladdress > 0) {  ?><?php } else { echo "1"; } ?>" />
                                        <div class="col-sm-12">
                                            <label>Address Type</label>
                                            <div id="Shipping_divEmail" class="form-group uplabel">
                                                <input id="home" name="addredd_type" type="radio" value="Home" required="" checked  />
                                                <span class="checkmark"></span>
                                                <span style="padding-right:5%" for="home">Home</span>
                                                
                                                <input id="office" name="addredd_type" type="radio" value="Office" required=""   />
                                                <span class="checkmark"></span>
                                                <span style="padding-right:5%" for="office">Office</span>
                                                
                                                <input id="other" name="addredd_type" type="radio" value="Other" required=""   />
                                                <span class="checkmark"></span>
                                                <span style="padding-right:5%" for="other">Other</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div id="Shipping_divFirstName" class="form-group uplabel">
                                                <input name="fname" id="fname" class="form-control"    type="text" placeholder="First Name">
                                                <div id="Register_divErrorMsg1" class="text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div id="Shipping_divLastName" class="form-group uplabel">
                                                <input name="lname" id="lname" class="form-control"     type="text" placeholder="Last Name">				  
                                            </div>
                                        </div>
                                        <div class="col-sm-12"> 
                                            <div id="Shipping_divMobile" class="form-group uplabel">
                                                <input name="mobile" id="mobile" class="form-control" maxlength="10" type="text"     placeholder="Mobile Number">
                                            </div> 
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div id="Shipping_divAddress" class="form-group uplabel">
                                                <input type="text" name="address" id="address" class="form-control"   type="text" rows="4"   placeholder="Shipping Address">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div id="Shipping_divLastName" class="form-group uplabel">
                                                <input name="city" id="city" class="form-control"  type="text" placeholder="City">				  
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div id="Shipping_divMobile" class="form-group uplabel">
                                                
                                                <select name="pincode" id="pincode" class="form-control" maxlength="6" required="required">
                                                    
                                                    <option>Pincode</option> 
                                                    <option vlaue="110045">110045</option>
                                                    <option vlaue="110058">110058</option>
                                                    <option vlaue="110075">110075</option>
                                                    <option vlaue="110077">110077</option>
                                                    <option vlaue="110078">110078</option>

                                                </select>
                                            </div> 
                                        </div>  
                                        <div class="col-sm-6"> 
                                            <div id="Shipping_divMobile" class="form-group uplabel">
                                                <button onClick="return hideaddress();" class="btn btn-danger pull-left mobile-mb-20" type="button" style="width:30%"><span><span>Cancel</span></span> </button> 
                                            </div> 
                                        </div> 
                                        <div class="col-sm-6"> 
                                            <div id="Shipping_divMobile" class="form-group uplabel">
                                                <button onClick="return addaddress();" class="btn btn-primary pull-right mobile-mb-20" type="submit" style="width:30%"><span><span>Add</span></span> </button> 
                                            </div> 
                                        </div> 
                                    </form>
                                </div>
                                
                                <div class="clearfix"></div>
                                <form name="frmshipping" id="frmshipping" action="<?php echo URL; ?>/process/profileedit_processbasket.php" method="post" novalidate="novalidate"> 
                                <input type="hidden" value="" name="selected_address" id="selected_address" />
                                <div class="row"  style="  margin:10px;"> 
                                    <button onClick="return ValidateShipping();" class="btn btn-primary pull-right mobile-mb-20 checkoutbutton" type="submit" style="width:100%"><span><span>Continue</span></span> </button> 
                                </div> 
                                </form>
                                <div class="clearfix"></div> 
                        </div>       
                        <div class="col-md-6 text-center col-sm-5 " > 
                            <div class="cart_detail_info pd-20-10" >
                            <?php 
                            $grandtotal = '';
                            $subtotal = '';
                            $submrp = '';
                            $sqlcd=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'");
                            while($rowcs=mysqli_fetch_array($sqlcd))
                            { 
                                $subtotal = $subtotal + floor($rowcs['subtotal']*$_SESSION['conratio']); 
                                $submrp = $submrp + floor($rowcs['submrp']*$_SESSION['conratio']); 
                                
                                $totalamount = floor($rowcs['sellingprice']*$_SESSION['conratio']) * $rowcs['quantity'];
                                $grandtotal = $grandtotal + $totalamount; 
                                
                            ?>    
                            <div class="product" >
                                <div class="product-image col-sm-2 col-xs-3">
                                <img src="<?php echo $cdnurl;?>/uploads/productimage/thumb/<?php echo $rowcs['productimage']; ?>" style=" width: 50px;  border-radius: 7px;"> </div>
                                <div class="product-details col-sm-7 text-left col-xs-6"> 
                                    <p class="product-description"><a href="<?php echo URL;?>/<?php echo $rowcs['slug']; ?>"> <?php  echo $rowcs['productname'];   ?> </a></p>
                                    <small>Size <?php echo $rowcs['size']; ?> </small>
                                </div>
                                <div class="product-price col-sm-3 text-right col-xs-3">
                                    <?php if($rowcs['submrp'] > $rowcs['subtotal']){ ?><span style="font-size: 11px;"><del><?php echo Currency; ?> <?php echo round($rowcs['submrp']*$_SESSION['conratio']); ?></del>&nbsp;</span><?php } ?>
                                    <?php echo Currency; ?>&nbsp;<?php echo round($rowcs['subtotal']*$_SESSION['conratio']); ?>
                                </div>
                            </div> 
                            <hr> 
                        <?php  }?>
                         <?php 
                         
                            $totalsaving = $submrp - $subtotal;
                            
                        ?>
                        <?php if($totalsaving > 0){ ?>
                        <div class="clearfix" ></div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                            <p>Total Saving</p> 
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6" style="padding-right:0px;">
                            <p><?php echo Currency.$totalsaving; ?></p> 
                        </div> 
                        <?php } ?>
                        <div class="clearfix" ></div> 
                        <div class="cart_price_detail" >
                            <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                                <H5>Subtotal</H5> 
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6" style="padding-right:0px;">
                                <H5> <p><b> <?php echo Currency.$grandtotal;?></b></p></H5> 
                            </div>
                            <div class="clearfix"></div>
                            <?php if($_SESSION['couponcartvalue'] > 0) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                                <H5>Discount</H5> 
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6" style="padding-right:0px;">
                                <H5> <p><b> <?php echo Currency.$_SESSION['couponcartvalue']; ?></b></p></H5> 
                            </div> 
                            <div class="clearfix"></div>
                            <?php } ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                            <H5>Shipping Charge </H5> 
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6" style="padding-right:0px;">
                                <H5> <p><b> <?php echo Currency.$_SESSION['shipprice']; ?></b></p></H5> 
                            </div> 
                            
                            <?php if($_SESSION['user_wallet_amount'] > 0) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                            <H5>Wallet Amount </H5> 
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6" style="padding-right:0px;">
                                <H5> <p><b> <?php echo Currency.$_SESSION['walletamounttobeuse']; ?></b></p></H5> 
                            </div> 
                            
                            <?php } ?> 
                            
                            <div class="clearfix"></div>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-left col-xs-6">
                            <H4>Total</H4> 
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 text-right col-xs-6" style="padding-right:0px;">
                               
                                <H4> <p><b> <?php echo Currency.$_SESSION['totalpaybleamount'];?></b></p></H4> 
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
     function hideaddress()
    {
        $('.checkoutbutton').show();
        $('#is_add_ddress').val('');
        $('.addressshow'). hide();
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
	        alert('Please select or add new address');
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