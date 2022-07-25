<style>
.login-modal-footer .btn.btn-danger {



    border: medium none;



    border-radius: 2px;



    color: #fff !important;



    font-size: 12px;



    margin: 10px 0;



    padding: 8px 4px;



    width: 100%;



}
.login-modal-footer .btn.btn-danger i {



 border-right: 1px solid rgba(255, 255, 255, 0.15);



    color: #fff !important;



    float: left;



    font-size: 13px;



    padding-left: 2px;



    padding-right: 6px; color:#fff !important



}

.btn-facebook {



    background-color: #3b5998 !important;



    color: #fff !important;



}

.popLogin li a{
    font-size:12px!important;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #555;
    cursor: default;
    background-color: #fff;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
}

.nav-tabs > a:hover, a.active {
    text-decoration: none;
    color: #fa4251;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
    padding: 10px 15px;
}
.nav-tabs > li > a {
    text-decoration: none; 
    border-bottom-color: transparent;
    padding: 10px 15px;
}
.modal-header { 
    display: block;
}
.nav-tabs {
     border-bottom: none;  
}
.input-group-addon {
    padding: 6px 12px;
    font-size: 14px;
    font-weight: normal; 
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc; 
    border-right: none; 
}
</style>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content login-modal">
      <div class="modal-header login-modal-header" style="background:#84c225;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="loginModalLabel">Login/Signup</h4>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <div role="tabpanel" class="login-tab">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs popLogin" role="tablist">
              <li role="presentation"><a  class="active" id="signin-taba" href="#home" aria-controls="home" role="tab" data-toggle="tab">Sign In</a></li>
              <li role="presentation"><a id="signup-taba" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Sign Up</a></li>
              <li role="presentation"><a id="forgetpass-taba" href="#forget_password" aria-controls="forget_password" role="tab" data-toggle="tab">Forgot Password</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content" style="border: 1px solid #ddd;">
                <div role="tabpanel" class="tab-pane active text-center" id="home"> &nbsp;&nbsp; <span id="login_fail" class="response_error"></span>
                    <div class="clearfix"></div>
                    <form>
                        <span class="login_loaderhide" style="display:none;"><img src="<?php echo IMGURL;?>/loader.gif" style="width:20px;"  /></span>
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                              <input type="text" class="form-control" id="login_emailid" placeholder="Email Id / Mobile no">
                            </div>
                            <span class="help-block has-error" id="email-error"></span> 
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                              <input type="password" class="form-control" id="login_password" placeholder="Password">
                            </div>
                            <span class="help-block has-error" id="password-error"></span> 
                        </div>
                        <button type="button" id="login_btn" class="btn btn-block bt-login" data-loading-text="Signing In...." style="background:#84c225;">Login</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
                
                <div role="tabpanel" class="tab-pane" id="profile">
                    <span class="optmessage"></span> &nbsp;&nbsp; <span id="registration_fail" class="response_error"></span>
                    <form>
                        <span class="registration_loaderhide" style="display:none;"><img src="<?php echo IMGURL;?>/loader.gif" style="width:20px;"  /></span>
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                              <input type="text" class="form-control" id="register_fname" placeholder="First Name">
                            </div>
                            <span class="help-block has-error" data-error='0' id="username-error"></span> 
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-at"></i></div>
                              <input type="text" class="form-control" id="register_emailid" placeholder="Email">
                            </div>
                            <span class="help-block has-error" data-error='0' id="remail-error"></span> 
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-key"></i></div>
                              <input type="password" class="form-control" id="register_password" placeholder="Password">
                            </div>
                            <span class="help-block has-error" data-error='0' id="username-error"></span> 
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                              <input type="text" class="form-control" id="register_mobile" placeholder="Mobile No." onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            </div>
                            <span class="help-block has-error" data-error='0' id="username-error"></span> 
                        </div>
                        <p><small style="display:none;" class="showresend" style="color:#84c225;">Didn't received email <a class="resendmail" href="javascript:void(0);" style="color:blue;">Resend</a></small></p>
                        <p><small style="display:none;" class="resendmsg" ><a href="javascript:void(0);" style="color:green;"> Email sent successfully Please check your mail!</a></small></p>
                        
                        <span class="resend_loaderhide" style="display:none;"><img src="<?php echo IMGURL;?>/loader.gif" style="width:20px;"  /></span>
                        <button type="button" id="register_btn" class="btn btn-block bt-login" data-loading-text="Registering...." style="background:#84c225;">Register</button>
                        <div class="clearfix"></div>
                    </form> 
                </div> 
                
                <div role="tabpanel" class="tab-pane text-center" id="forget_password"> &nbsp;&nbsp; 
                    <span id="reset_fail_forget" class="response_error"></span>
                    <div class="clearfix"></div>
                    <form>
                    <span class="reset_loaderhide" style="display:none;"><img src="<?php echo IMGURL;?>/loader.gif" style="width:20px;"  /></span>
                    <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-user"></i></div>
                          <input type="text" class="form-control" id="forget_email" placeholder="Email">
                        </div>
                        <span class="help-block has-error" data-error='0' id="femail-error"></span> 
                    </div>
                      <button type="button" id="reset_btn" class="btn btn-block bt-login" data-loading-text="Please wait...." style="background:#84c225;">Forget Password</button>
                      <div class="clearfix"></div>
                    </form>
                </div>
              <div class="login-modal-footer">
                <div class="row">
                  <div class="col-sm-12">
                    

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
<style>



	/*.form-inline .form-group{



	margin-bottom: 20px;



	float: right;



}*/



.title{



    text-decoration:underline;



    padding: 0px !important;



}



.btn-launch,.btn-launch:hover, .btn-launch:active, .btn-launch:focus{



	background-color: #2ecc71;



    border: medium none #2ecc71;



    box-shadow: 0 3px 0 #d35400, 0 5px 2px rgba(0, 0, 0, 0.2);



    color: #fff;



    font-size: 25px;



    font-weight: bold;



    padding: 20px 40px;



    margin-top:10%;



}



.bt-login,.bt-login:hover, .bt-login:active, .bt-login:focus {



    background-color: #ff8627;



    color: #ffffff;



    padding-bottom: 10px;



    padding-top: 10px;



    transition: background-color 300ms linear 0s;



}



.login-tab {



	margin: 0 auto;



	max-width: 380px;



}



.login-modal-header {



	background: #27ae60;



	color: #fff;



}



.login-modal-header .modal-title {



	color: #fff;



}



.login-modal-header .close {



	color: #fff;



}



.login-modal i {



	color: #000;



}



.login-modal form {



	max-width: 340px;



}



.tab-pane form {



	margin: 0 auto;



}



.login-modal-footer{



	margin-top:15px;



	margin-bottom:15px;



}



	</style>
<!------------------------------------------------------------------------------------------->
<script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>  
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
	    $(document).ready(function(){ 
	    	 
	    	
	    	$(".resendmail").click(function() {  
	    	          
    				$(".resendmsg").hide();  
            		$(".resend_loaderhide").show();  
            		$.ajax({ 
            			type: "POST",    
            			url: "https://localhost/project/shopurneeds/ajax/ajax_resend_mail.php",  
            			success: function(data){ 
            			    //console.log(data); 
            		        $(".resend_loaderhide").hide();  
            				$(".resendmsg").show();  
            			} 
            		});  
	    	});   
	    	$("#login_btn").click(function() {  
		        var login_emailid = $.trim($('#login_emailid').val()); 
        		var login_password = $.trim($('#login_password').val()); 
        		if($('#login_emailid').val()=='') 
        		{ 
        			$("#login_fail").html("<font color='#FF0000'>please enter email id</font>"); 
        			$('#login_emailid').focus(); 
        			return false; 
        		} 
        		else if ($('#login_password').val()=='') 
        		{ 
        			$("#login_fail").html("<font color='#FF0000'>please enter password</font>"); 
        			$('#login_password').focus(); 
        			return false; 
        		}
		        else 
		        {    
            		$(".login_loaderhide").show();  
            		$.ajax({ 
            			type: "POST",  
        			    data: { sEmail: login_emailid,sPassword:login_password }, 
            			url: "https://localhost/project/shopurneeds/ajax/ajax_inc_login.php",  
            			success: function(data){  
            			    //console.log(data);
            				$("#login_fail").html(data); 
            				$(".login_loaderhide").hide();  
            			} 
            		}); 
        		} 
	    	});  
	    	
		    $("#register_btn").click(function() {   
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
        		else if (register_password=='') 
        		{
        			$("#registration_fail").html("<font color='#FF0000'>Please enter password</font>");
        			$('#register_password').focus();
        			return false;
        		}
        		else if (register_mobile=='') 
        		{
        			$("#registration_fail").html("<font color='#FF0000'>Please enter your mobileno</font>");
        			$('#register_mobile').focus();
        			return false;
        		} 
        		else 
        		{    
            		$(".registration_loaderhide").show();  
            		$.ajax({ 
            			    type: "POST",   
            			    data: { emailid: register_emailid,password:register_password,fname:register_fname,mobileno:register_mobile }, 
            			    url: "https://localhost/project/shopurneeds/ajax/ajax_inc_register.php", 
            			    success: function(data){   
            				$("#registration_fail").html(data); 
            				$(".registration_loaderhide").hide(); 
            				$(".showresend").show(); 
            			} 
            		}); 
        		} 
	        });		
            $("#reset_btn").click(function() { 
        		var forget_email = $.trim($('#forget_email').val()); 
        		var emailRegex = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/; 
        		if (forget_email == "" ) 
        		{ 
            		$("#reset_fail_forget").html("<font color='#FF0000'>Please enter email</font>");  
            		$('#forget_email').focus(); 
            		return false; 
        	    } 
        	    else if(!emailRegex.test(forget_email))
        	    { 
            	 	$("#reset_fail_forget").html("<font color='#FF0000'>Please enter valid email</font>"); 
            		$('#forget_email').focus(); 
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
            			    if(data == 0)
            			    {
            			        $("#reset_fail_forget").html("<font color='red'>Invalid Email Id</font>");  
            				    $(".reset_loaderhide").hide(); 
            			    }
            			    else
            			    {
                				$("#reset_fail_forget").html("<font color='#003300'>Please check your email to get your password</font>");  
                				$(".reset_loaderhide").hide(); 
            			    }
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
			url: "https://localhost/project/shopurneeds/ajax/ajax_inc_mobileotp.php",
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
    <script>
$(".to_forget").click(function () {
    $("#login").css("display", "none");
    $("#register").css("display", "none");
     $("#forget").css("display", "block");
});
</script>
 <script>
$(".to_register").click(function () {
    $("#forget").css("display", "none");
   
});
</script>
<script>
$(".to_register1").click(function () {
      $("#forget").css("display", "none");
    $("#login").css("display", "block");
     $("#register").css("display", "block");
   
});
</script>
<style>
.current_color { border: 1px solid red !important;}
</style>