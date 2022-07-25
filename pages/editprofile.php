 
<script language="javascript"> 
function showonlyonev2(thechosenone) {
  var newboxes = document.getElementsByTagName("div");
  for(var x=0; x<newboxes.length; x++) {
		name = newboxes[x].getAttribute("name");
		if (name == 'newboxes-2') {
			  if (newboxes[x].id == thechosenone) {
					if (newboxes[x].style.display == 'block') {
						  newboxes[x].style.display = 'none';
					}
					else {
						  newboxes[x].style.display = 'block';
					}
			  }else {
					newboxes[x].style.display = 'none';
			  }
		}
  }
}
function PopupCenter(pageURL2, title2,w2,h2) {
var left = (screen.width/2)-(w2/2);
var top = (screen.height/2)-(h2/2);
var targetWin = window.open (pageURL2, title2, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width='+w2+', height='+h2+', top='+top+', left='+left);
} //
</script>
<script language="javascript">
function baddress2()
{
	if(document.form2.add.checked==true)
	{
		document.form2.dfname.value=document.form2.fname.value;
		document.form2.dlname.value=document.form2.lname.value;
		document.form2.dstreetaddress.value=document.form2.streetaddress.value;		
		document.form2.dphone.value=document.form2.mobile.value;
		document.form2.dcountry.value=document.form2.country.value;
		document.form2.dstate.value=document.form2.state.value;
		document.form2.dcity.value=document.form2.city.value;
		document.form2.dzip.value=document.form2.zip.value;	
	}
}
</script>

<div class="da_body"  style="width:100%; padding:10px;" >
    <div class="da_dashboard"> 
        <!--left dashboard sidebar starts here-->
        <?php include("includes/left_account.php"); ?>
        <!--left dashboard sidebar ends here--> 
        <!--right dashboard starts here-->
        <div class="da_right_board fleft">
            <h1> <img src="images/fav-showroom.png"> Edit Profile </h1>
            <?php
    		    $sql=mysqli_query($conn,"select * from `".$sufix."user_registration` where emailid='".$_SESSION['emailid']."'") or die(mysql_error());
    			$rows = mysqli_fetch_assoc($sql);
    		?>
    		
            <form name="form2" id="form2" action="<?php echo URL; ?>/process/profileedit_process.php" method="post" style="text-align:left; margin:0; border:0;">
            <div class="row"> 
                <div class="col-md-6"> 
                    <?php 
                    $sql_user_address=mysqli_query($conn,"select * from ".$sufix."customer_address where user_id='".$_SESSION['useridse']."'");
                    $totaladdress = mysqli_num_rows($sql_user_address);
                    while($row_address = mysqli_fetch_assoc($sql_user_address))
                    {
                    ?>
                        
                        <div class="row" style="border: 1px solid #232f3e; border-radius: 7px;margin:10px;">
                            <div class="card-shop col-sm-8" > 
                                <h3><?php echo $row_address['addresstype']; ?> Address :-</h3> 
                                <h4><?php echo $row_address['fname']." ".$row_address['lname']; ?><br></h4>
                                <p><?php echo $row_address['address']; ?> 
                                 <?php echo  $row_address['city'].", ".$row_address['zipcode']." ".$row_address['country']; ?>  
                                 Mobile Number: <?php echo $row_address['mobileno']; ?></p>
                            </div> 
                            <label class="col-sm-4 pull-right payment-icon1 container-radio" style="margin-top: 20px;" > 
                                <p style="margin-top:30px;">
                                    <a href="<?php echo URL; ?>/user-address?id=<?php echo $row_address['id']; ?>"> <i class="fa fa-edit" style="color:#232f3e;font-size:16px;"></i></a> &nbsp;&nbsp; 
                                    <a href="<?php echo URL; ?>/process/deleteaddress.php?id=<?php echo $row_address['id']; ?>" onclick="return confirm('Are you sure to delete this?')" ><i class="fa fa-trash" style="color:#232f3e;font-size:16px;"></i></a>
                                </p>
                            </label> 
                        </div>  
                    <?php } ?>
                </div>
                <div class="col-md-6">
                    <?php 
                    $var1 =  $_SERVER['REQUEST_URI'];
                    $var2 = explode('?',$var1); 
                    $var3 =  explode('=',$var2[1]);
                    if($var3[1] > 0) { ?>
                    
                         <?php 
                                $sql_user_address=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."customer_address where id='".$var3[1]."'"));
                            ?>
                                 
                                
                                <div class="row addressshow" style="  margin:10px; "> 
                                        <input type="hidden" name="address_id" value="<?php echo $sql_user_address['id'];  ?>" />
                                        <div class="col-sm-12">
                                            <label>Address Type</label>
                                            <div id="Shipping_divEmail" class="form-group uplabel">
                                                <input name="addredd_type" type="radio" value="Home"   <?php   if($sql_user_address['addresstype'] == 'Home') { echo "checked"; } ?>  />
                                                <span class="checkmark"></span>
                                                <span style="padding-right:5%">Home</span>
                                                
                                                <input name="addredd_type" type="radio" value="Office" <?php   if($sql_user_address['addresstype'] == 'Office') { echo "checked"; } ?>  />
                                                <span class="checkmark"></span>
                                                <span style="padding-right:5%">Office</span>
                                                
                                                <input name="addredd_type" type="radio" value="Other"   <?php   if($sql_user_address['addresstype'] == 'Other') { echo "checked"; } ?>  />
                                                <span class="checkmark"></span>
                                                <span style="padding-right:5%">Other</span>
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
                                                    
                                                    <option value="">Pincode</option>
                                               
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
                                </div>
                                 
                                <div class="clearfix"></div> 
                    
                    <?php } else { ?>
                        <div class="row" style=" border-radius: 7px;margin:10px;">
                            <button onClick="showaddress();" class="btn btn-primary pull-right mobile-mb-20" type="button" style="width:100%"><span><span>Add Delivery Address</span></span> </button>
                        </div>  
                        <div class="row addressshow" style="  margin:10px;<?php if($totaladdress > 0) {  ?>display:none; <?php } ?>"> 
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
                                        <input name="fname" id="fname" class="form-control"    type="text" placeholder="FIRST NAME">
                                        <div id="Register_divErrorMsg1" class="text-danger"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div id="Shipping_divLastName" class="form-group uplabel">
                                        <input name="lname" id="lname" class="form-control"     type="text" placeholder="LAST NAME">				  
                                    </div>
                                </div>
                                <div class="col-sm-12"> 
                                    <div id="Shipping_divMobile" class="form-group uplabel">
                                        <input name="mobile" id="mobile" class="form-control" maxlength="10" type="text"     placeholder="MOBILE NUMBER">
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
                                <div class="col-sm-12"> 
                                    <div id="Shipping_divMobile" class="form-group uplabel">
                                        <button onClick="return addaddress();" class="btn btn-primary pull-right mobile-mb-20" type="submit" style="width:30%"><span><span>Add</span></span> </button> 
                                    </div> 
                                </div>  
                        </div>
                         
                        <div class="clearfix"></div> 
                        <?php } ?>
                </div>                 
            </div> 
            </form>
        </div>
        <!--right dashboard ends here-->
        <div class="clear"></div>
    </div>
</div>
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
	    if(pincode == '')
	    {
	        alert('Please enter pincode!');
	        return false;
	    }
	}
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
	    if(pincode == '')
	    {
	        alert('Please enter pincode!');
	        return false;
	    }
	} 
function valueChanged()
{
    if($('.showotherdeliveryaddress').is(":checked"))   
        $(".otherdeli").show();
    else
        $(".otherdeli").hide();
}
</script>
<style>
.uplabel .form-control{ padding-top:10px !important}
.table-left-sec {
    width: 48%;
    float: left;
}
@media (max-width: 640px) {
	.da_dashboard{ width:100%; padding:0; margin-top:10px;}
	.da_left_dash {
    border-right: 0 none;
    padding-right: 0;
    width: 100%;
}
.da_left_dash ul li a{ text-align:center;}
.da_right_board {
    padding: 0 15px;
    width: 100%;
}
.da_dashboard_cont {
    float: left;
    width: 100%;
}	
	.da_right_board h1 p {
    float: left;
    margin-top: 20px;
    width: 100%;
}
.da_more_info_container .da_onehalf.fleft {
    float: left;
    width: 100%;
}

.table-left-sec{ width:100%; float:left;}
.table-responsive{ border:0 !important;}
.button.btn-proceed-checkout {
    margin-top: 50px;
}
	}
</style>
