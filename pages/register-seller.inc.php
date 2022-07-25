<style>
    .pb-60 {
    padding-bottom: 49px;
}
.pt-60 {
    padding-top: 31px;
}
</style>
<div class="breadcrumb section pt-60 pb-60 mb-30" style="margin-bottom:0px;">
    <div class="container">
        <h1 class="uppercase">Register</h1>
        <ul>
            <li><a href="<?php echo URL; ?>"><i class="fa fa-home"></i></a></li>
            <li class="active">Seller Registration</li>
        </ul>
    </div>
</div>
    <!-- =====  BREADCRUMB END===== -->
    <div class="page-login section">
    <!-- =====  CONTAINER START  ===== -->
    <div class="container">
      <div class="row ">
        <div class="col-12 my-4">
          <div class="row">
            
            <!-- Login -->
            <div class="col-md-6 col-12 d-flex">

                <div class="register">
                    
                    <h3>Registration of seller account</h3> 

                    <!-- Login Form -->
                    <form method="post" action="<?php echo URL; ?>/process/seller-register-process.php" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <span id="register_message" > </span> 
                                <?php echo $_SESSION['sessionregmsg']; unset($_SESSION['sessionregmsg']); ?>
                            </div>
                            <div class="form-group">
                            <input class="  form-control" name="brand_name" id="brand_name" type="text" placeholder="Shop Name/Brand Name" autocomplete="off"> 
                            </div>
                            <div class="form-group">
                            <input class="  form-control" name="seller_emailid" id="seller_emailid" type="text" placeholder="Email" autocomplete="off"> 
                            </div>
                            <div class="form-group">
                            <input class="  form-control" name="seller_phone" id="seller_phone" type="text" placeholder="Phone Number" autocomplete="off">
                            </div>
                            <div class="form-group">
                            <input class="  form-control" name="seller_password" id="seller_password" type="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                            <input class="input form-control" name="seller_cpassword" id="seller_cpassword" type="password" placeholder="Repeat Password">
                            </div>
                            <button type="submit" class="btn mt-10 " id="register1" style="background-color:#84c225;">register</button>
                    </form>

                    <h4>You have account? please  <a href="<?php echo URL; ?>/seller-login" style="color:#84c225;">click here for login</a></h4>
                    
                </div>
            </div>

            
            <!-- Login With Social -->
            <div class="col-md-6 col-12 d-flex">  
                <img src="../assets/images/seller2.jpg" alt="Account Image Placeholder" class="image-placeholder"> 
            </div>
            
        </div>

        </div>
      </div>
    </div>
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#register1').click(function(){  
        	var brand_name = $('#brand_name').val();   
        	var seller_emailid = $('#seller_emailid').val();   
        	var seller_phone = $('#seller_phone').val(); 
        	var seller_password = $('#seller_password').val(); 
        	var seller_cpassword = $('#seller_cpassword').val(); 
        	var is_emailid = parseInt($('input[name="verify_emailid"]:checked').length);  
        	var verification_code = $('#verification_code').val(); 
        	var verification_otp = $('#verification_otp').val(); 
        	var argeement_check = $('#argeement_check').val(); 
        	
        	if(brand_name == '')
        	{  
        		$('#brand_name').css("border","1px solid red");
        		$('#brand_name').focus();
        		$('#register_message').html("<div class='alert alert-danger' role='alert'>Please enter shop name/brand name</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#brand_name').css("border","1px solid #bdb9b9"); 
        	} 
            
            
            if(seller_emailid == '')
        	{  
        		$('#seller_emailid').css("border","1px solid red");
        		$('#seller_emailid').focus(); 
        		$('#register_message').html("<div class='alert alert-danger' role='alert'>Please enter email id</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#seller_emailid').css("border","1px solid #bdb9b9"); 
                $('#register_message').html("");
        	}  
        	
        	if(seller_emailid != '')
            {
        	    var regexEmail = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!regexEmail.test(seller_emailid)) 
                {
                    $('#seller_emailid').css("border","1px solid red");
            		$('#seller_emailid').focus(); 
            		$('#register_message').html("<div class='alert alert-danger' role='alert'>Email Id is invalid.</div>");
            		return false;
                }
                else
                {
                   $('#seller_emailid').css("border","1px solid #bdb9b9"); 
                   $('#register_message').html("");
                }
            }
        	
        	if(seller_phone == '')
        	{  
        		$('#seller_phone').css("border","1px solid red");
        		$('#seller_phone').focus(); 
        		$('#register_message').html("<div class='alert alert-danger' role='alert'>Please enter phone number</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#seller_phone').css("border","1px solid #bdb9b9"); 
                $('#register_message').html("");
        	} 
        	
        	if(seller_password == '')
        	{  
        		$('#seller_password').css("border","1px solid red");
        		$('#seller_password').focus(); 
        		$('#register_message').html("<div class='alert alert-danger' role='alert'>Please enter password</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#seller_password').css("border","1px solid #bdb9b9"); 
                $('#register_message').html("");
        	} 
        	
        	if(seller_cpassword == '')
        	{  
        		$('#seller_cpassword').css("border","1px solid red");
        		$('#seller_cpassword').focus(); 
        		$('#register_message').html("<div class='alert alert-danger' role='alert'>Please enter confirm password</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#seller_cpassword').css("border","1px solid #bdb9b9"); 
                $('#register_message').html("");
        	} 
        	
        	if(seller_password != seller_cpassword)
        	{  
        		$('#seller_cpassword').css("border","1px solid red");
        		$('#seller_cpassword').focus(); 
        		$('#register_message').html("<div class='alert alert-danger' role='alert'>Please enter confirm password same as password</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#seller_cpassword').css("border","1px solid #bdb9b9"); 
                $('#register_message').html("");
        	} 
        	
        	if(seller_phone == '')
        	{  
        		$('#seller_phone').css("border","1px solid red");
        		$('#seller_phone').focus(); 
        		$('#register_message').html("<div class='alert alert-danger' role='alert'>Please enter Phone Number</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#seller_phone').css("border","1px solid #bdb9b9"); 
                $('#register_message').html("");
        	} 
        	 
        	if(is_emailid > 0)
            {
                if(verification_code == '')
            	{  
            		$('#verification_code').css("border","1px solid red");
            		$('#verification_code').focus(); 
            		$('#register_message').html("<div class='alert alert-danger' role='alert'>Please enter verification code</div>");
            		return false;
            	}
            	else
            	{ 
            		$('#verification_code').css("border","1px solid #bdb9b9"); 
                    $('#register_message').html("");
            	} 
            	
            	if(verification_code != verification_otp)
            	{  
            		$('#verification_code').css("border","1px solid red");
            		$('#verification_code').focus(); 
            		$('#verification_msg').html("<font color='red'>Invalid validation code </font>");
            		return false;
            	}
            	else
            	{ 
            		$('#verification_code').css("border","1px solid #bdb9b9"); 
                    $('#verification_msg').html("");
            	}
            }
            
        	
        	if(argeement_check == '')
        	{  
        		$('#argeement_check').css("border","1px solid red");
        		$('#argeement_check').focus(); 
        		$('#register_message').html("<div class='alert alert-danger' role='alert'>Please check membership agrement</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#argeement_check').css("border","1px solid #bdb9b9"); 
                $('#register_message').html("");
        	} 
        });   
        }); 
    </script>