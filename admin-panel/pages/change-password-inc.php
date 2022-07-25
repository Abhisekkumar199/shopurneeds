<?php   
    	$rows = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."admin where id='".$_SESSION['id']."'")); 
    	$password = $rows['password']; 
    	$username = $rows['username'];
?>
<div id="content" class="flex"> 
    <!-- ############ Main START-->
    <div>
        <div class="page-hero page-container" id="page-hero">
            <div class="padding d-flex">
                <div class="page-title">
                    <h2 class="text-md text-highlight">Change password</h2>
                </div>
                <div class="flex"></div> 
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="change-password-process.php" method="POST" enctype="multipart/form-data">  
            <input type="hidden" name="old_password_1" id="old_password_1"   value="<?php echo $password; ?>">
            <div class="padding"> 
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="card"> 
                            <div class="card-body"> 
                                <div class="col-md-6"> 
                                    <span id="message"> </span>
                                    <?php  
                                        echo $_SESSION['message']; 
            	                        unset($_SESSION['message']); 
            	                    ?> 
                                </div>
                                <div class="col-md-6"> 
                                </div>
                                <div class="clearfix"></div>
 
                                 
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"> New Password</label>
                                    <div class="col-sm-6">
                                        <input type="password" name="new_password" id="new_password"  maxlegth="10" class="form-control" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Confirm New Password</label>
                                    <div class="col-sm-6">
                                        <input type="password" name="c_new_password" id="c_new_password"  maxlegth="10" class="form-control" placeholder="Confirm New Password">
                                    </div>
                                </div>
                                
                                <button type="submit" class="changepassword btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>   
            </form>
        </div> 
    </div> 
</div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('.changepassword').click(function(){ 
         
	var new_password = $('#new_password').val(); 
	var c_new_password = $('#c_new_password').val();   
	
 
	 
	if(new_password == '')
	{  
		$('#new_password').css("border","1px solid red");
		$('#new_password').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter new password</div>");
		return false;
	}
	else
	{ 
		$('#new_password').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	}  
	
	if(c_new_password == '')
	{  
		$('#c_new_password').css("border","1px solid red");
		$('#c_new_password').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter confirm new password</div>");
		return false;
	}
	else
	{ 
		$('#c_new_password').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	}  
    
    if(new_password != c_new_password)
	{  
		$('#c_new_password').css("border","1px solid red");
		$('#c_new_password').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>New password didn't match</div>");
		return false;
	}
	else
	{ 
		$('#c_new_password').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	}  
	 
	 
}); 
</script> 