    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">   
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/market-place-1.css">
    <style>
    .ps-my-account-2 .ps-form--account .ps-tab-list li a 
    {
        font-size: 20px; 
    }
    .ps-my-account-2 .ps-form--account .ps-tab-list li 
    { 
        padding: 10px 7px;
    }
    @media (min-width: 1200px)
    {
        .ps-my-account-2 
        {
        padding-top: 38px!important;
        padding-bottom: 90px;
        }
    } 
    </style>
    <div class="ps-page--my-account">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="<?php echo URL; ?>">Home</a></li>
                    <li>My account</li>
                </ul>
            </div>
        </div>
        <div class="ps-my-account-2">
            <div class="container">
                <div class="ps-section__wrapper">
                    <div class="ps-section__left"> 
                        
                        <form class="ps-form--account ps-tab-root" >
                            <ul class="ps-tab-list">
                                <li class="  active"><a href="#sign-in">login</a></li>
                                <li class=" "><a href="#register">Register</a></li>
                                <li class=" "><a href="#forgotpassword">Forget Password</a></li>
                            </ul>
                            <div class="ps-tabs">
                                <div class="ps-tab   active" id="sign-in">
                                    <div class="ps-form__content">
                                        <h5>Log In Your Account</h5>
                                        <span id="login_fail1"></span>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="login_emailid1" placeholder="Username or email address">
                                        </div>
                                        <div class="form-group form-forgot">
                                            <input class="form-control" type="password" id="login_password1" placeholder="Password"><a href="">Forgot?</a>
                                        </div> 
                                        <div class="form-group submit">
                                            <button class="ps-btn ps-btn--fullwidth" type="button"  id="login_btn1">Login</button>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="ps-tab " id="register">
                                    <div class="ps-form__content">
                                        <h5>Register An Account</h5>
                                        
                                        <span id="registration_fail"></span>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="register_fname" name="register_fname"  placeholder="Name" >
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="email" id="register_emailid" name="register_emailid"  placeholder="Email Id" >
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="register_mobile" name="register_mobile"  placeholder="Mobile No" >
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="register_password" name="register_password" placeholder="Password">
                                        </div>
                                       
                                        <div class="form-group submit">
                                            <button type="button" class="ps-btn ps-btn--fullwidth" id="register_btn"  >Register</button>
                                        </div>
                                    </div>    
                                </div>
                                <div class="ps-tab    " id="forgotpassword">
                                    <div class="ps-form__content">
                                        <h5>Log In Your Account</h5>
                                        <span id="forgot_msg"></span>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="forgotemailid" placeholder="Enter Email Id">
                                        </div>  
                                        <div class="form-group submit">
                                            <button class="ps-btn ps-btn--fullwidth" type="button"  id="forgotpassword">Login</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div> 
                        </form>    
                    </div>
                    <div class="ps-section__right">
                        <figure class="ps-section__desc">
                            <figcaption>Sign up today and you will be able to:</figcaption>
                            <p>MartFury Buyer Protection has you covered from click to delivery. Sign up or sign in and you will be able to:</p>
                            <ul class="ps-list">
                                <li><i class="icon-credit-card"></i><span>SPEED YOUR WAY THROUGH CHECKOUT</span></li>
                                <li><i class="icon-clipboard-check"></i><span>TRACK YOUR ORDERS EASILY</span></li>
                                <li><i class="icon-bag2"></i><span>KEEP A RECORD OF ALL YOUR PURCHASES</span></li>
                            </ul>
                        </figure>
                        
                    </div>
                </div>
            </div>
        </div>
    </div> 
<script>
$(document).ready(function(){ 
	    	  
    $(document).on('click','#register_btn',function(e){  
		var register_fname = $.trim($('#register_fname').val()); 
		var register_emailid = $.trim($('#register_emailid').val()); 
		var register_password = $.trim($('#register_password').val()); 
		var register_mobile = $.trim($('#register_mobile').val()); 
		var emailRegex = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;   
		if (register_fname=='') 
		{
			$("#registration_fail").html("<font color='#FF0000'>Please enter your name</font>");
			$('#register_fname').focus();
			return false;
		} 
		else if ($('#register_emailid').val()=='') 
		{
			$("#registration_fail").html("<font color='#FF0000'>Please enter email id</font>"); 
			$('#register_emailid').focus(); 
			return false; 
		} 
		else if (!emailRegex.test(register_emailid)) 
		{
			$("#registration_fail").html("<font color='#FF0000'>Please enter valid email id</font>");
			$('#register_emailid').focus();
			return false; 
		}	
		else if (register_mobile=='') 
		{
			$("#registration_fail").html("<font color='#FF0000'>Please enter your mobile no</font>");
			$('#register_mobile').focus();
			return false;
		} 
		else if (register_password=='') 
		{
			$("#registration_fail").html("<font color='#FF0000'>Please enter password</font>");
			$('#register_password').focus();
			return false;
		}
		
		else 
		{     
    		$.ajax({ 
    			    type: "POST",   
    			    data: { emailid: register_emailid,password:register_password,fname:register_fname,mobileno:register_mobile }, 
    			    url: "https://localhost/project/shopurneeds/ajax/ajax_inc_register.php", 
    			    success: function(data){   
    			        if(data == '' || data == ' ')
        			    {
            				    //window.parent.location.href = "<?php echo $_SERVER['HTTP_REFERER'];?>";
            			        
        			    }
        			    else
        			    { 
        				    $("#registration_fail").html(data);  
        			    }
    				$("#registration_fail").html(data);  
    			} 
    		}); 
		} 
    });	
	$("#login_btn1").click(function() {  
        var login_emailid1 = $.trim($('#login_emailid1').val()); 
		var login_password1 = $.trim($('#login_password1').val()); 
		if($('#login_emailid1').val()=='') 
		{ 
			$("#login_fail1").html("<font color='#FF0000'>please enter email id</font>"); 
			$('#login_emailid1').focus(); 
			return false; 
		} 
		else if ($('#login_password1').val()=='') 
		{ 
			$("#login_fail1").html("<font color='#FF0000'>please enter password</font>"); 
			$('#login_password1').focus(); 
			return false; 
		}
        else 
        {     
    		$.ajax({ 
    			type: "POST",  
			    data: { sEmail: login_emailid1,sPassword:login_password1 }, 
    			url: "https://localhost/project/shopurneeds/ajax/ajax_inc_login.php",  
    			success: function(data){    
    			    if(data == '' || data == ' ')
    			    {
    				    window.parent.location.href = "<?php echo $_SERVER['HTTP_REFERER'];?>";
    			        
    			    }
    			    else
    			    { 
    				    $("#login_fail1").html(data);  
    			    }
    			} 
    		}); 
		} 
	});   
	
	$(".register").click(function () {
        $("#register").addClass("active"); 
    });
    $("#forgotpassword").click(function() { 
		var forget_email = $.trim($('#forgotemailid').val()); 
		var emailRegex = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/; 
		if (forget_email == "" ) 
		{ 
    		$("#forgot_msg").html("<font color='#FF0000'>Please enter email</font>");  
    		$('#forgotemailid').focus(); 
    		return false; 
	    } 
	    else if(!emailRegex.test(forget_email))
	    { 
    	 	$("#forgot_msg").html("<font color='#FF0000'>Please enter valid email</font>"); 
    		$('#forgotemailid').focus(); 
    		return false; 
	    } 
	    else 
	    { 
    		$(".reset_loaderhide").show(); 
    		$.ajax({ 
    			type: "POST", 
    			data: { emailid: forget_email},
    			url: "https://localhost/project/shopurneeds/ajax/ajax_inc_resetpassword.php", 
    			success: function(data){ 
    			    alert(data);
    				$("#forgot_msg").html("<font color='#003300'>Please check your email to get your password</font>");  
    				$(".reset_loaderhide").hide(); 
    			} 
    		}); 
		} 
	});
	
	$(document).on('click','#otp_submit',function(e){
        var mobileotp11 = $("#mobileotp11").val();
        var otpemailid = $("#otpemailid").val();
        if(mobileotp11=='') { 
        alert("Please enter mobile otp");
        $("#mobileotp11").focus();
        return false;
        } else { 
        $.ajax({
        type: "POST",
         data: {mobileotp: mobileotp11,otpemailid : otpemailid },
        url: "https://localhost/project/shopurneeds/ajax_inc_mobileotp.php",
        success: function(data){
        if(data=='Successfully approved your account please login') {
        $(".mobilehideotp").hide();
        }
        	$(".optmessage").html(data);
        	$(".emailregister").hide();
        }
        });
		}	
	    });
});	
    </script>    